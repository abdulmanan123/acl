<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationType;
use DataTables;
use Auth;

class ApplicationTypeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $applicationTypes = ApplicationType::query();
            $user = Auth::user();

            return Datatables::of($applicationTypes)
                            ->addColumn('action', function ($applicationType) use ($user) {
                                $action = '';
                                if ($user->hasrole('Super Admin') || $user->can('Edit Application Types')) {
                                    $action .= '<a href="' . route('application-types.edit', $applicationType->uuid) . '" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="' . __('Edit Application Type') . '"><i class="fa fa-edit"></i> </a>';
                                }
                                if ($user->hasrole('Super Admin') || $user->can('Delete Application Types')) {
                                    $action .= '<a href="' . route('application-types.destroy', $applicationType->uuid) . '" class="text-danger btn-delete" data-toggle="tooltip" title="' . __('Delete Application Type') . '"><i class="fa fa-trash-alt"></i></a>';
                                }

                                return $action;
                            })
                            ->editColumn('id', 'ID: {{$id}}')
                            ->make(true);
        }

        return view('application-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return response()->json([
                    'title' => __('Create Application Type'),
                    'html' => view('application-types.create')->render()
                        ], $this->successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50|unique:application_types,name',
        ]);

        ApplicationType::create($request->all());

        return response()->json([
                    'message' => __('Application type added!')
                        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ApplicationType  $applicationType
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationType $applicationType) {
        return response()->json([
                    'title' => __('Update Application Type'),
                    'html' => view('application-types.edit', compact('applicationType'))->render()
                        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ApplicationType  $applicationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationType $applicationType) {
        $this->validate($request, [
            'name' => 'required|max:50|unique:application_types,name,' . $applicationType->id,
        ]);

        $applicationType->update($request->all());

        return response()->json([
                    'message' => __('Application type updated!')
                        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ApplicationType  $applicationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationType $applicationType) {
        if ($applicationType->delete()) {
            return response()->json([
                        'message' => __('Application type deleted!')
                            ], $this->successStatus);
        }

        return response()->json([
                    'message' => __('Application type not exist against this id')
                        ], $this->errorStatus);
    }

    /*
     * Populate ApplicationType Dropdown
     */

    public function getDropDownOptions(Request $request) {
        $selected = $request->id;
        $rows = ApplicationType::orderBy('name', 'ASC')->get();
        $options = '<option value="">Select Application Type</option>';
        foreach ($rows as $row) {
            $selectedAttr = ($row->id == $selected) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selectedAttr . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }

}
