<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class CityController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cities = City::with('district');
            $user = Auth::user();

            return Datatables::of($cities)
                ->addColumn('action', function ($city) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Cities')) {
                        $action .= '<a href="'. route('cities.edit', $city->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit City').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Cities')) {
                        $action .= '<a href="'. route('cities.destroy', $city->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete City').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::pluck('name', 'id');
        return response()->json([
            'title' => __('Create City'),
            'html'  => view('cities.create', compact('districts'))->render()
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
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|max:50',
        ]);

        City::create($request->all());

        return response()->json([
            'message' => __('City added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $districts = District::pluck('name', 'id');
        return response()->json([
            'title' => __('Update City'),
            'html'  => view('cities.edit', compact('city', 'districts'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request, [
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|max:50'
        ]);

        $city->update($request->all());

        return response()->json([
            'message' => __('City updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if ($city->delete()) {
            return response()->json([
                'message' => __('City deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('City not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate Cities Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getDropDownOptions(Request $request) {
        $options = '<option value="">Select City</option>';
        if ($request->district_id) {
            $selected = $request->id;
            $rows = City::where(['district_id' => $request->district_id])->get();

            foreach ($rows as $row) {
                $selectedAttr = ($row->id == $selected) ? ' selected' : '';
                $options .= '<option value="' . $row->id . '"' . $selectedAttr . '>' . $row->name . '</option>';
            }
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }

}
