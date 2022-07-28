<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $locations = Location::query();
            $user = Auth::user();

            return Datatables::of($locations)
                ->addColumn('action', function ($location) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Location')) {
                        $action .= '<a href="'. route('locations.edit', $location->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Location').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Location')) {
                        $action .= '<a href="'. route('locations.destroy', $location->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Location').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Location'),
            'html'  => view('locations.create')->render()
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

        Location::create($request->all());

        return response()->json([
            'message' => __('Location added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return response()->json([
            'title' => __('Update Location'),
            'html'  => view('locations.edit', compact('location'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $location->update($request->all());

        return response()->json([
            'message' => __('Location updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if ($location->delete()) {
            return response()->json([
                'message' => __('Location deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Location not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate Location Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request)
    {
        $rows = Location::all();
        $options = '<option value="">Select Location</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
