<?php

namespace App\Services\Users;

use App\Repositories\Users\UserRepository;
use App\Models\User;
use DataTables;
use Auth;

class UserService
{
    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all users data.
     *
     * @return void
     */
    public function getUsers()
    {
        return $this->repository->all();
    }

    /**
     * Get all users data.
     *
     * @return void
     */
    public function getUserDatatable()
    {
        $users = $this->repository->query();

        return Datatables::of($users)
            ->addColumn('role', function ($user) {
                return $user->getRoleNames()->first();
            })
            ->addColumn('action', function ($user) {
                $action = '';
                $authUser = Auth::user();
                if($authUser->hasrole('Super Admin') || $authUser->can('Edit Users')) {
                    $action .= '<a href="'. route('users.edit', $user->uuid) .'" data-edit="true" class="text-primary p-form" data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i> </a>';
                }
                if($authUser->hasrole('Super Admin') || $authUser->can('Delete Users')) {
                    $action .= '<a href="'. route('users.destroy', $user->uuid) .'" class="text-danger btn-delete" data-toggle="tooltip" title="Delete User"><i class="fa fa-trash-alt"></i></a>';
                }

                return $action;
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
}