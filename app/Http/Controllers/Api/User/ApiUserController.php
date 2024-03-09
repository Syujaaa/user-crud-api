<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends ApiController
{
    // tolong ketikan 'php artisan migrate terlebih dahulu di terminal'
    public function index(Request $request)
    {
        $users = User::all();
        return $this->sendSuccess($users);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendNotFound('User Tidak ditemukan');
        }

        return $this->sendSuccess($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create($request->all());

        return $this->sendSuccess($user, 'Data User berhasil diBuat');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            // Password boleh ganti boleh tidak
        ]);

        $user = User::find($id);

        if (!$user) {
            return $this->sendNotFound('Data User tidak ditemukan');
        }

        $user->update($request->all());

        return $this->sendSuccess($user, 'Data User berhasil diUbah');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendNotFound('Data User tidak ditemukan');
        }

        $user->delete();

        return $this->sendSuccess(null, 'Data User berhasil diHapus');
    }
}
