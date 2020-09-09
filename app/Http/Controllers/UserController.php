<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function singup(Request $request)
    {
        try {
            $email = (empty($request->login)) ? null : $request->login;
            $password = (empty($request->password)) ? null : $request->password;
            $passwordCheck = (empty($request->passwordCheck)) ? null : $request->passwordCheck;
            $name = (empty($request->name)) ? null : $request->name;
            $lastname = (empty($request->lastname)) ? null : $request->lastname;

            if ($password != $passwordCheck) {
                throw new \Exception("Senha e Confirmação de Senha não são iguais");
            }

            $usuarioEntity = User::create([
                'name' => $name,
                'lastname' => $lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'api_token' => Str::random(60),
            ]);

            return ['success' => true, 'data' => $usuarioEntity];
        } catch (\Exception $e) {
            http_response_code(400);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function singin(Request $request)
    {
        try {
            $email = (empty($request->login)) ? null : $request->login;
            $password = (empty($request->password)) ? null : $request->password;

            if (empty($email) || empty($password))  {
                throw new \Exception("Login ou senha não informados corretamente");
            }

            $userEntity = User::where([
                ['email', $email]
            ])->first();

            if (!$userEntity) {
                throw new \Exception("Combinação de E-mail e Senha não encontrados");
            }

            if (!Hash::check($password, $userEntity->password)) {
                throw new \Exception("Senha inválida.");
            }

            return ['success' => true, 'data' => $userEntity];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
