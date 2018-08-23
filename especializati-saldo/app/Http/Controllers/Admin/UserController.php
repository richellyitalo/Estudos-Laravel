<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        return view('site.profile.profile');
    }

    public function profileUpdate(Request $request)
    {
        $data = $request->all();

        if ($data['new_password'] != null) {
            $data['password'] = bcrypt($data['new_password']);
        }

        $updated = auth()->user()->update($data);

        if ($updated) {
            return redirect()
                ->route('profile')
                ->withSuccess('Perfil atualizado com sucesso!');
        }

        return redirect()
            ->back()
            ->withError('Não foi possível atualizar o perfil');
    }
}
