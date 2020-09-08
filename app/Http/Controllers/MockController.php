<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MockController extends Controller
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
            $password = (empty($request->password)) ? null : Hash::make($request->password);

            if (empty($email) || empty($password))  {
                throw new \Exception("Login ou senha não informados corretamente");
            }

            return [$email, $password];

            $userEntity = User::where([
                ['email', $email],
                ['password', $password]
            ])->toSql();

            return $userEntity;

            if (!$userEntity) {
                throw new \Exception("Combinação de E-mail e Senha não encontrados");
            }
            return ['success' => true, 'data' => $userEntity];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
