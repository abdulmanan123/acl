<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $qualifications = Qualification::query();
            $user = Auth::user();

            return Datatables::of($qualifications)
                ->addColumn('action', function ($qualification) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Qualifications')) {
                        $action .= '<a href="'. route('qualifications.edit', $qualification->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Qualification').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Qualifications')) {
                        $action .= '<a href="'. route('qualifications.destroy', $qualification->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Qualification').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('qualifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Qualification'),
            'html'  => view('qualifications.create')->render()
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

        Qualification::create($request->all());

        return response()->json([
            'message' => __('Qualification added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualification)
    {
        return response()->json([
            'title' => __('Update Qualification'),
            'html'  => view('qualifications.edit', compact('qualification'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qualification $qualification)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $qualification->update($request->all());

        return response()->json([
            'message' => __('Qualification updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        if ($qualification->delete()) {
            return response()->json([
                'message' => __('Qualification deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Qualification not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate Qualification Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request)
    {
        $rows = Qualification::all();
        $options = '<option value="">Select Qualification</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
