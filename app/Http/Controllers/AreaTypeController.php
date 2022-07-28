<?php

namespace App\Http\Controllers;

use App\Models\AreaType;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class AreaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $areaTypes = AreaType::query();
            $user = Auth::user();

            return Datatables::of($areaTypes)
                ->addColumn('action', function ($areaType) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Area Types')) {
                        $action .= '<a href="'. route('area-types.edit', $areaType->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Area Type').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Area Types')) {
                        $action .= '<a href="'. route('area-types.destroy', $areaType->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Area Type').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('area-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Area Type'),
            'html'  => view('area-types.create')->render()
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
            'name' => 'required|max:50|unique:area_types,name',
        ]);

        AreaType::create($request->all());

        return response()->json([
            'message' => __('Area type added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AreaType  $areaType
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaType $areaType)
    {
        return response()->json([
            'title' => __('Update Area Type'),
            'html'  => view('area-types.edit', compact('areaType'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  AreaType  $areaType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AreaType $areaType)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:area_types,name,' . $areaType->id,
        ]);

        $areaType->update($request->all());

        return response()->json([
            'message' => __('Area type updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AreaType  $areaType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaType $areaType)
    {
        if ($areaType->delete()) {
            return response()->json([
                'message' => __('Area type deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Area type not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate AreaType Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request)
    {
        $rows = AreaType::all();
        $options = '<option value="">Select Area Type</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
