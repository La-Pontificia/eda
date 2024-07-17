<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function assign(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'domain' => ['required'],
            'description' => ['required', 'string', 'max:500'],
        ]);

        $user = User::find($request->id_user);

        if (!$user) {
            return response()->json('Selecciona un usuario valido', 404);
        }

        $email = $request->username . '@' . $request->domain;

        // validate email regex
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json('Correo electronico invalido', 400);
        }

        $alreadyAssigned = Email::where('email', $email)->first();

        if ($alreadyAssigned && $alreadyAssigned->id_user === $request->id_user) {
            return response()->json('El correo electronico ya se encuentra registrado y asignado a este usuario.', 400);
        }

        Email::create([
            'user_id' => $request->id_user,
            'email' => $email,
            'access' => json_encode($request->input('access', [])),
            'description' => $request->description,
            'assigned_by' => auth()->user()->id
        ]);

        return response()->json('Correo asignado correctamente', 200);
    }

    public function discharge(Request $request, $id_email)
    {
        $email = Email::find($id_email);

        if (!$email) {
            return response()->json('Correo no encontrado', 404);
        }

        // find emails by id_user
        $emails = Email::where('id_user', $email->id_user)->get();

        // if user has only one email, return error
        if ($emails->count() === 1) {
            return response()->json('No se puede dar de baja el unico correo electronico asignado a este usuario', 400);
        }

        $email->discharged = now();
        $email->discharged_by = auth()->user()->id;
        $email->save();

        return response()->json('Correo dado de baja correctamente', 200);
    }
}
