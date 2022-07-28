<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Session;
use DataTables;
use Auth;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permissions = Permission::query();
            $user = Auth::user();

            return Datatables::of($permissions)
                ->addColumn('action', function ($permission) use ($user) {
                    $action = '';
                    if($user->hasrole('Super Admin') || $user->can('Edit Permissions'))
                        $action .= '<a href="'. route('permissions.edit', $permission->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Permission').'"><i class="fa fa-edit"></i> </a>';
                    if($user->hasrole('Super Admin') || $user->can('Delete Permissions'))
                        $action .= '<a href="'. route('permissions.destroy', $permission->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Permission').'"><i class="fa fa-trash-alt"></i></a>';

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Permission'),
            'html'  => view('permissions.create')->render()
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
            'name' => 'required|max:50|unique:permissions,name',
        ]);

        Permission::create($request->all());

        return response()->json([
            'message' => __('Permission added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return response()->json([
            'title' => __('Update Permission'),
            'html'  => view('permissions.edit', compact('permission'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($request->all());

        return response()->json([
            'message' => __('Permission updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if ($permission->delete()) {
            return response()->json([
                'message' => __('Permission deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Permission not exist against this id')
        ], $this->errorStatus);

    }
}
