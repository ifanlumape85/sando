<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string'],
            'telpon' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'email' => ['required', 'stirng'],
            'username' => ['required', 'stirng'],
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $response = [
                'status' => false,
                'message' => $error
            ];
            return response()->json($response, 200);
        }

        try {
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->telpon = $request->telpon;
            $user->alamat = $request->alamat;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->update();

            $response = [
                'status' => true,
                'message' => 'Sukses',
                'user' => $user->toArray()
            ];

            return response()->json($response, 201);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:users,id'],
            'password_lama' => ['required'],
            'password_baru' => ['required']
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $response = [
                'status' => false,
                'message' => $error
            ];
            return response()->json($response, 200);
        }

        try {
            if ($request->password_lama != $request->password_baru) {
                $response = [
                    'status' => false,
                    'message' => 'Password tidak sama'
                ];
                return response()->json($response, 200);
            }

            $user = User::findOrFail($request->id);

            $user->password = bcrypt($request->password_baru);
            $user->update();

            $response = [
                'code' => '1',
                'status' => true,
                'message' => 'Sukses'
            ];

            return response()->json($response, 201);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'code' => '2',
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 200);
        }

        try {
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                $response = [
                    'status' => false,
                    'message' => 'Unauthorized. ' . $request->email
                ];
                return response()->json($response, 200);
            }

            $user = User::where('email', $request->email)
                ->first();

            if (!Hash::check($request->password, $user->password, [])) {
                $response = [
                    'status' => false,
                    'message' => 'Invalid Credentials.'
                ];
                return response()->json($response, 200);
            }

            $response = [
                'message' => 'Sukses',
                'status' => true,
                'user' => $user->toArray()
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'code' => '2',
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }
}
