<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $programs = Program::query();
            $user = Auth::user();

            return Datatables::of($programs)
                ->addColumn('action', function ($program) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Programs')) {
                        $action .= '<a href="'. route('programs.edit', $program->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Program').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Programs')) {
                        $action .= '<a href="'. route('programs.destroy', $program->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Program').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('programs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Program'),
            'html'  => view('programs.create')->render()
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

        Program::create($request->all());

        return response()->json([
            'message' => __('Program added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        return response()->json([
            'title' => __('Update Program'),
            'html'  => view('programs.edit', compact('program'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $program->update($request->all());

        return response()->json([
            'message' => __('Program updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        if ($program->delete()) {
            return response()->json([
                'message' => __('Program deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Program not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate Program Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request)
    {
        $rows = Program::all();
        $options = '<option value="">Select Program</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
