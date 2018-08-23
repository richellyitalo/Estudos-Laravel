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

        $user = auth()->user();

        if ($data['new_password'] != null) {
            $data['password'] = bcrypt($data['new_password']);
        }

        $data['image'] = $user->image;
        
        /* ***************************************************
         * Upload de imagens
         * ***************************************************
         */
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($user->image)
                $name = $user->image;
            else
                $name = $user->id . kebab_case($user->name);
            
            $ext = $request->image->extension();
            $nameFile = "{$name}.{$ext}";

            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('users', $nameFile);

            if (!$upload) {
                return redirect()
                    ->back()
                    ->withError('Não foi possível salvar a imagem de perfil.');
            }
        }


        $updated = $user->update($data);

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
