<?php

namespace App\Http\Controllers;

use App\Models\Tehsil;
use App\Models\District;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class TehsilController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $tehsils = Tehsil::with('district');
            $user = Auth::user();

            return Datatables::of($tehsils)
                            ->addColumn('action', function ($tehsil) use ($user) {
                                $action = '';
                                if ($user->hasrole('Super Admin') || $user->can('Edit Tehsils')) {
                                    $action .= '<a href="' . route('tehsils.edit', $tehsil->uuid) . '" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="' . __('Edit Tehsil') . '"><i class="fa fa-edit"></i> </a>';
                                }
                                if ($user->hasrole('Super Admin') || $user->can('Delete Tehsils')) {
                                    $action .= '<a href="' . route('tehsils.destroy', $tehsil->uuid) . '" class="text-danger btn-delete" data-toggle="tooltip" title="' . __('Delete Tehsil') . '"><i class="fa fa-trash-alt"></i></a>';
                                }

                                return $action;
                            })
                            ->editColumn('id', 'ID: {{$id}}')
                            ->make(true);
        }

        return view('tehsils.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $districts = District::pluck('name', 'id');
        return response()->json([
                    'title' => __('Create Tehsil'),
                    'html' => view('tehsils.create', compact('districts'))->render()
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
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|max:50',
        ]);

        Tehsil::create($request->all());

        return response()->json([
                    'message' => __('Tehsil added!')
                        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tehsil  $tehsil
     * @return \Illuminate\Http\Response
     */
    public function edit(Tehsil $tehsil) {
        $districts = District::pluck('name', 'id');
        return response()->json([
                    'title' => __('Update Tehsil'),
                    'html' => view('tehsils.edit', compact('tehsil', 'districts'))->render()
                        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tehsil  $tehsil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tehsil $tehsil) {
        $this->validate($request, [
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|max:50'
        ]);

        $tehsil->update($request->all());

        return response()->json([
                    'message' => __('Tehsil updated!')
                        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tehsil  $tehsil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tehsil $tehsil) {
        if ($tehsil->delete()) {
            return response()->json([
                        'message' => __('Tehsil deleted!')
                            ], $this->successStatus);
        }

        return response()->json([
                    'message' => __('Tehsil not exist against this id')
                        ], $this->errorStatus);
    }

    /*
     * Populate Tehsil Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getDropDownOptions(Request $request) {
        $options = '<option value="">Select Tehsil</option>';
        if ($request->district_id) {

            $selected = $request->id;
            $rows = Tehsil::where(['district_id' => $request->district_id])->get();
            foreach ($rows as $row) {
                $selectedAttr = ($row->id == $selected) ? ' selected' : '';
                $options .= '<option value="' . $row->id . '"' . $selectedAttr . '>' . $row->name . '</option>';
            }
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }

}
