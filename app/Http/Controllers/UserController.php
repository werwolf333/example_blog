<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController
{
    function index()
    {
        if(Auth::user() && Auth::user()->role_id == 1)
        {
            $users = DB::select(
                'SELECT u.id, name, email, password, u.created_at, u.updated_at, role
                FROM users u
                LEFT JOIN roles r on u.role_id = r.id'
                );
            return view('user/users', ['users' => $users]);
        }
        else
        {
            return redirect('/messages');
        }
    }

    function delete($userId)
    {
        DB::select(
            'DELETE FROM users WHERE id=:userId',
            ['userId' => $userId]
        );
        return redirect('/users');
    }

    function edit($userId)
    {
        $users = DB::select(
            'SELECT * FROM users u WHERE u.id = :userId',
            ['userId' => $userId]
        );

        $roles = DB::select( 'SELECT * FROM roles');

        return view('user/edit', ['user' => $users[0], 'roles' => $roles] );
    }

    function update($userId, Request $request)
    {
        $name = $request->get('name');
        $role_id = $request->get('role_id');
        $email = $request->get('email');

        DB::select(
            'UPDATE users
            SET name = :name, 
            role_id = :role_id,
            email = :email
            WHERE id = :userId',
            [
                'userId' => $userId,
                'name' => $name,
                'role_id' => $role_id,
                'email' => $email
            ]
        );

        return redirect('/users');
    }
}
