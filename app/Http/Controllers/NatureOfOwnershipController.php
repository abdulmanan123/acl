<?php

namespace App\Http\Controllers;

use App\Models\NatureOfOwnership;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class NatureOfOwnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ownerships = NatureOfOwnership::query();
            $user = Auth::user();

            return Datatables::of($ownerships)
                ->addColumn('action', function ($ownership) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Nature Of Ownerships')) {
                        $action .= '<a href="'. route('nature-of-ownerships.edit', $ownership->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Nature Of Ownership').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Nature Of Ownerships')) {
                        $action .= '<a href="'. route('nature-of-ownerships.destroy', $ownership->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Nature Of Ownership').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('nature-of-ownerships.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Nature Of Ownership'),
            'html'  => view('nature-of-ownerships.create')->render()
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

        NatureOfOwnership::create($request->all());

        return response()->json([
            'message' => __('Nature Of Ownership added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $ownership = NatureOfOwnership::uuid($uuid)->firstOrFail();
        return response()->json([
            'title' => __('Update Nature Of Ownership'),
            'html'  => view('nature-of-ownerships.edit', compact('ownership'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update($uuid, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $ownership = NatureOfOwnership::uuid($uuid)->firstOrFail();
        $ownership->update($request->all());

        return response()->json([
            'message' => __('Nature Of Ownership updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
         $ownership = NatureOfOwnership::uuid($uuid)->firstOrFail();
        if ($ownership->delete()) {
            return response()->json([
                'message' => __('Nature Of Ownership deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Nature Of Ownership not exist against this id')
        ], $this->errorStatus);

    }

    /*
     * Populate NatureOfOwnership Dropdown
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDropDownOptions(Request $request)
    {
        $rows = NatureOfOwnership::all();
        $options = '<option value="">Select Nature of Ownership</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
