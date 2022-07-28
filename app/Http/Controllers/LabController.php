<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $labs = Lab::query();
            $user = Auth::user();

            return Datatables::of($labs)
                ->addColumn('action', function ($lab) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Labs')) {
                        $action .= '<a href="'. route('labs.edit', $lab->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Lab').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Labs')) {
                        $action .= '<a href="'. route('labs.destroy', $lab->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Lab').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('labs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Lab'),
            'html'  => view('labs.create')->render()
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

        Lab::create($request->all());

        return response()->json([
            'message' => __('Lab added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        return response()->json([
            'title' => __('Update Lab'),
            'html'  => view('labs.edit', compact('lab'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $lab->update($request->all());

        return response()->json([
            'message' => __('Lab updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        if ($lab->delete()) {
            return response()->json([
                'message' => __('Lab deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Lab not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate Lab Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request)
    {
        $rows = Lab::all();
        $options = '<option value="">Select Lab</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
