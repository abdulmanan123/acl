<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

use App\Services\Users\UserService;

use Session;
use DB;

class UserController extends Controller
{

    /**
     * UsersController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->userService->getUserDatatable();
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->role = $user->getRoleNames()->first();

        $roles = Role::pluck('name','name');

        return response()->json([
            'title' => __('Update User'),
            'html'  => view('users.edit', compact('user', 'roles'))->render()
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
        $this->validate($request, [
            'name' => 'required|max:30',
            'role' => 'required',
        ]);

        $requestData = $request->only(['name', 'role']);

        $user = User::uuid($id)->firstOrFail();

        if ($user) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($requestData['role']);
            $user->update($requestData);
            $message = __('User data updated!');
        } else {
            $message = __('User data not update!');
        }

        return response()->json([
            'message' => $message
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
        $user = User::uuid($id)->first();

        if ($user) {
            $user->delete();
            return response()->json([
                'message' => __('User deleted!')
            ], $this->successStatus);
        }

        return response()->json([
            'message' => __('User not exist against this id')
        ], $this->errorStatus);
    }
}
