<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class DistrictController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $districts = District::query();
            $user = Auth::user();

            return Datatables::of($districts)
                ->addColumn('action', function ($district) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit District')) {
                        $action .= '<a href="'. route('districts.edit', $district->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit District').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete District')) {
                        $action .= '<a href="'. route('districts.destroy', $district->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete District').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create District'),
            'html'  => view('districts.create')->render()
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
            'name' => 'required|max:50|unique:districts,name',
        ]);

        District::create($request->all());

        return response()->json([
            'message' => __('District added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        return response()->json([
            'title' => __('Update District'),
            'html'  => view('districts.edit', compact('district'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:districts,name,' . $district->id,
        ]);

        $district->update($request->all());

        return response()->json([
            'message' => __('District updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        if ($district->delete()) {
            return response()->json([
                'message' => __('District deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('District not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate Gender Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request)
    {
        $rows = District::all();
        $options = '<option value="">Select District</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }

}
