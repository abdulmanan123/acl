<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $shifts = Shift::query();
            $user = Auth::user();

            return Datatables::of($shifts)
                ->addColumn('action', function ($shift) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Shifts')) {
                        $action .= '<a href="'. route('shifts.edit', $shift->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Shift').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Shifts')) {
                        $action .= '<a href="'. route('shifts.destroy', $shift->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Shift').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('shifts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Shift'),
            'html'  => view('shifts.create')->render()
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

        Shift::create($request->all());

        return response()->json([
            'message' => __('Shift added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        return response()->json([
            'title' => __('Update Shift'),
            'html'  => view('shifts.edit', compact('shift'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $shift->update($request->all());

        return response()->json([
            'message' => __('Shift updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        if ($shift->delete()) {
            return response()->json([
                'message' => __('Shift deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Shift not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate Shift Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request) {
        $selected = $request->id;
        $rows = Shift::all();
        $options = '<option value="">Select Shift</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $selected) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
