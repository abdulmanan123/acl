<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Session;
use DataTables;
use DB;
use Auth;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::query();
            $user = Auth::user();

            return Datatables::of($roles)
                ->addColumn('action', function ($role) use ($user) {
                    $action = '';
                    if($user->hasrole('Super Admin') || $user->can('Role Permissions'))
                        $action .= '<a href="'. route('roles.getPermissions', $role->uuid) . '" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Change Permission').'"><i class="fa fa-key"></i> </a>';
                    if($user->hasrole('Super Admin') || $user->can('Edit Roles'))
                        $action .= '<a href="'. route('roles.edit', $role->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="'.__('Edit Role').'"><i class="fa fa-edit"></i> </a>';
                    if(($user->hasrole('Super Admin') || $user->can('Delete Roles')) && $role->name != 'Super Admin')
                        $action .= '<a href="'. route('roles.destroy', $role->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="'.__('Delete Role').'"><i class="fa fa-trash-alt"></i></a>';

                    return $action;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }

        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'title' => __('Create Role'),
            'html'  => view('roles.create')->render()
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
            'name' => 'required|max:50|unique:roles,name',
            'route' => 'required|max:50',
        ]);

        Role::create($request->all());

        return response()->json([
            'message' => __('Role added!')
        ], $this->successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return response()->json([
            'title' => __('Update Role'),
            'html'  => view('roles.edit', compact('role'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $role = Role::uuid($id)->firstOrFail();
        
        $this->validate($request, [
            'name' => 'required|max:50|unique:roles,name,' . $role->id,
            'route' => 'required|max:50',
        ]);

        
        $role->update($request->all());

        return response()->json([
            'message' => __('Role updated!')
        ], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::uuid($id)->first();

        if ($role) {
            $role->delete();
            return response()->json([
                'message' => __('Role deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('Role not exist against this id')
        ], $this->errorStatus);
    }

    /**
     * Get all permissions.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
     public function getRolePermissions($id)
     {

        $role = Role::uuid($id)->firstOrFail();

        $permissions = Permission::all();

        return response()->json([
            'title' => $role->name . ' ' . __('Permissions'),
            'html'  => view('roles.permissions', compact('role', 'permissions'))->render()
        ], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRolePermission($id, Request $request)
    {
        $permissions = $request->permissions;
        $role = Role::uuid($id)->firstOrFail();

        DB::table('role_has_permissions')->where('role_id', $role->id)->delete();

        $role->syncPermissions($permissions);

        return response()->json([
            'message' => __('Permission updated!')
        ], $this->successStatus);
    }
}
