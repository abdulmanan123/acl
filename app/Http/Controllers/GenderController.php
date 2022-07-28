<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $genders = Gender::query();
            $user = Auth::user();

            return Datatables::of($genders)
                ->addColumn('action', function ($gender) use ($user) {
                    $action = '';
                    if ($user->hasrole('Super Admin') || $user->can('Edit Genders')) {
                        $action .= '<a href="'. route('genders.edit', $gender->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Gender').'"><i class="fa fa-edit"></i> </a>';
                    }
                    if ($user->hasrole('Super Admin') || $user->can('Delete Genders')) {
                        $action .= '<a href="'. route('genders.destroy', $gender->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Gender').'"><i class="fa fa-trash-alt"></i></a>';
                    }

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('genders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Gender'),
            'html'  => view('genders.create')->render()
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

        Gender::create($request->all());

        return response()->json([
            'message' => __('Gender added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function edit(Gender $gender)
    {
        return response()->json([
            'title' => __('Update Gender'),
            'html'  => view('genders.edit', compact('gender'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gender $gender)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);

        $gender->update($request->all());

        return response()->json([
            'message' => __('Gender updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gender $gender)
    {
        if ($gender->delete()) {
            return response()->json([
                'message' => __('Gender deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Gender not exist against this id')
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
        $rows = Gender::all();
        $options = '<option value="">Select Gender</option>';
        foreach ($rows as $row) {
            $selected = ($row->id == $request->id) ? ' selected' : '';
            $options .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return response()->json(['success' => true, 'options' => $options, 'request' => $request->all()]);
    }
}
