<?php

namespace App\Repositories\Users;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    protected $model = User::class;
}