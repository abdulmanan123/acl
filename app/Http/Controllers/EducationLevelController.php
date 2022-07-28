<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class EducationLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $educationLevels = EducationLevel::query();
            $user = Auth::user();

            return Datatables::of($educationLevels)
                ->addColumn('action', function ($educationLevel) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Education Levels')) {
                        $action .= '<a href="'. route('education-levels.edit', $educationLevel->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Institute Level').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Education Levels')) {
                        $action .= '<a href="'. route('education-levels.destroy', $educationLevel->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Institute Level').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('education-levels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Institute Level'),
            'html'  => view('education-levels.create')->render()
        ], $this->successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50',
        ]);

        EducationLevel::create($request->all());

        return response()->json([
            'message' => __('Institute Level added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  EducationLevel  $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationLevel $educationLevel)
    {
        return response()->json([
            'title' => __('Update Institute Level'),
            'html'  => view('education-levels.edit', compact('educationLevel'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  EducationLevel  $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationLevel $educationLevel)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $educationLevel->update($request->all());

        return response()->json([
            'message' => __('Institute Level updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  EducationLevel  $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationLevel $educationLevel)
    {
        if ($educationLevel->delete()) {
            return response()->json([
                'message' => __('Institute Level deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Education Level not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate EducationLevel Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request) {
        $selected = $request->id;
        $rows = EducationLevel::all();
        $options = '<option value="">Select Institute Level</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $selected) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
