<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationEnrollment;
use App\Models\ApplicationTeacher;
use App\Models\ApplicationLab;
use App\Models\Qualification;
use App\Models\Lab;
use App\Models\Program;
use App\Models\ApplicationType;
use App\Models\Application;
use DataTables;
use Auth;

class ApplicationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $applications = Application::with('city');
            $user = Auth::user();

            return Datatables::of($applications)
                ->addColumn('action', function ($application) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Applications')) {
                        $action .= '<a href="'. route('applications.edit', $application->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Application').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Applications')) {
                        $action .= '<a href="'. route('applications.destroy', $application->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Application').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('applications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $labs = Lab::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('applications.create', compact('labs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'application_type_id' => 'required|exists:application_types,id',
            'college_name'     => 'required|max:50',
            'district_id'      => 'required|exists:districts,id',
            'tehsil_id'        => 'required|exists:tehsils,id',
            'city_id'          => 'required|exists:cities,id',
            'uc_no'            => 'nullable|numeric',
            'na_no'            => 'nullable|numeric',
            'pp_no'            => 'nullable|numeric',
            'education_level_id' => 'required|exists:education_levels,id',
            'gender_id'        => 'required|exists:genders,id',
            'location_id'      => 'required|exists:locations,id',
            'gender_registered_id' => 'required|exists:genders,id',
            'shift_id'         => 'required|exists:shifts,id',
            'college_address' => 'required|max:500',
            'college_email'   => 'required|email',
            'college_phone_no' => 'required|numeric|digits_between:11,20',
            'owner_name'      => 'required|max:50',
            'owner_principal_manager_phone_no'      => 'required|numeric|digits_between:11,20',
            'principal_cnic'  => 'required|max:15',
            'nature_of_ownership_id'      => 'required|exists:nature_of_ownerships,id',
            'establishment_year' => 'required|digits:4',
            'registration_status' => 'required|in:registered,not-registered',
            'registration_date' => 'required|date',
            'last_renewal_date' => 'required|date',
            'affiliation'       => 'required|in:yes,no',
            'affiliated_university_name' => 'required|max:125',
            'total_male_teachers' => 'required|numeric|min:0',
            'total_female_teachers' => 'required|numeric|min:0',
            'total_classrooms' => 'required|numeric|min:0',
            'total_rooms_other_than_classrooms' => 'required|numeric|min:0',
            'area_type_id'     => 'required|exists:area_types,id',
            'area_value'     => 'required|numeric|min:0',
            'has_library'    => 'required|in:yes,no',
            'total_books'    => 'required|numeric|min:0',
            'lab_id'    => 'required',
        ];
        $messages = [];
        if ($request->filled('qualification')) {
            $rules['qualification.qualification_id.*'] = 'required||exists:qualifications,id';
            $rules['qualification.male_count.*'] = 'required|numeric';
            $rules['qualification.female_count.*'] = 'required|numeric';

            $messages['qualification.qualification_id.*.required'] = 'The qualification id field is required.';
            $messages['qualification.qualification_id.*.exists'] = 'The selected qualification id is invalid.';
            $messages['qualification.male_count.*.required'] = 'The male count field is required.';
            $messages['qualification.female_count.*.required'] = 'The female count field is required.';
        }
        if ($request->filled('enrollment')) {
            $rules['enrollment.program_id.*'] = 'required||exists:programs,id';
            $rules['enrollment.male_students.*'] = 'required|numeric';
            $rules['enrollment.female_students.*'] = 'required|numeric';

            $messages['enrollment.program_id.*.required'] = 'The program id field is required.';
            $messages['enrollment.program_id.*.exists'] = 'The selected program id is invalid.';
            $messages['enrollment.male_students.*.required'] = 'The male students field is required.';
            $messages['enrollment.female_students.*.required'] = 'The female students field is required.';
        }
        $this->validate($request, $rules, $messages);

        $requestData = $request->all();
        $requestData['principal_cnic'] = str_replace('-', '', $requestData['principal_cnic']);
        $requestData['registration_date'] = date('Y-m-d', strtotime($requestData['registration_date']));
        $requestData['last_renewal_date'] = date('Y-m-d', strtotime($requestData['last_renewal_date']));

        if ($request->hasFile('last_fee_receipt')) {
            $image = $request->file('last_fee_receipt');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $newName = md5(rand(0, 100000) . strtotime(date('Y-m-d H:i:s') . microtime())) . $name;
            $destinationPath = get_nfs_path('/uploads');
            $image->move($destinationPath, $newName);
            $requestData['last_fee_receipt'] = $newName;
        }
        if ($request->hasFile('ownership_rent_deed')) {
            $image = $request->file('ownership_rent_deed');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $newName = md5(rand(0, 100000) . strtotime(date('Y-m-d H:i:s') . microtime())) . $name;
            $destinationPath = get_nfs_path('/uploads');
            $image->move($destinationPath, $newName);
            $requestData['ownership_rent_deed'] = $newName;
        }
        if ($request->hasFile('hygiene_certificate')) {
            $image = $request->file('hygiene_certificate');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $newName = md5(rand(0, 100000) . strtotime(date('Y-m-d H:i:s') . microtime())) . $name;
            $destinationPath = get_nfs_path('/uploads');
            $image->move($destinationPath, $newName);
            $requestData['hygiene_certificate'] = $newName;
        }
        if ($request->hasFile('building_fitness_certificate')) {
            $image = $request->file('building_fitness_certificate');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $newName = md5(rand(0, 100000) . strtotime(date('Y-m-d H:i:s') . microtime())) . $name;
            $destinationPath = get_nfs_path('/uploads');
            $image->move($destinationPath, $newName);
            $requestData['building_fitness_certificate'] = $newName;
        }
        if ($request->hasFile('map_of_college_building')) {
            $image = $request->file('map_of_college_building');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $newName = md5(rand(0, 100000) . strtotime(date('Y-m-d H:i:s') . microtime())) . $name;
            $destinationPath = get_nfs_path('/uploads');
            $image->move($destinationPath, $newName);
            $requestData['map_of_college_building'] = $newName;
        }

        $application = Application::create($requestData);
        if ($application) {

            // Save application teachers
            if ($request->filled('qualification')) {
                foreach($request->qualification['qualification_id'] as $key => $qualification_id) {
                    $application->application_teachers()->create([
                        'qualification_id' => $request->qualification['qualification_id'][$key],
                        'male_count' => $request->qualification['male_count'][$key],
                        'female_count' => $request->qualification['female_count'][$key],
                    ]);
                }
            }

            // Save application enrollment
            if ($request->filled('enrollment')) {
                foreach($request->enrollment['program_id'] as $key => $program_id) {
                    $application->application_enrollments()->create([
                        'program_id' => $request->enrollment['program_id'][$key],
                        'male_students' => $request->enrollment['male_students'][$key],
                        'female_students' => $request->enrollment['female_students'][$key],
                    ]);
                }
            }

            // Save application labs
            if ($request->filled('lab_id')) {
                foreach ($request->lab_id as $lab_id) {
                    $application->labs()->create([
                        'lab_id' => $lab_id
                    ]);
                }
            }

            return response()->json([
                'message' => __('Application created!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Application not created!')
        ], $this->errorStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /*
     * Applications Dashboard
     */
    public function dashboard(){
        $totalApplications = Application::count();
        $totalPendingApplications = $totalApplications;
        $totalReturnedApplications = $totalApprovedApplications = 0;
        $applicationTypes = ApplicationType::orderBy('name', 'ASC')->get();
        return view('dashboard', compact('totalApplications', 'totalPendingApplications','totalReturnedApplications', 'totalApprovedApplications', 'applicationTypes'));
    }

    /**
     * Append new teacher qualification stat on Application
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function addNewQualificationStat(){
        $qualifications = Qualification::orderBy('name', 'ASC')->get();
        return response()->json(['success' => true, 'stat_row' => view('applications.form.create.stat_rows.add_new_qualification_stat', compact('qualifications'))->render()]);
    }

    /**
     * Append new enrollment stat on Application
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function addNewEnrollmentStat(){
        $programs = Program::orderBy('name', 'ASC')->get();
         return response()->json(['success' => true, 'stat_row' => view('applications.form.create.stat_rows.add_new_enrollment_stat', compact('programs'))->render()]);
    }

}
