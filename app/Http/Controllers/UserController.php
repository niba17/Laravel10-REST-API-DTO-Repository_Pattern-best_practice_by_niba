<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $hash, $messages, $response, $userModel;

    public function __construct(Hash $hash, User $userModel, Response $response)
    {
        $this->hash = $hash;
        $this->response = $response;
        $this->userModel = $userModel;
        $this->messages['user_id'] = [];
    }

    public function index()
    {

        try {

            $user = $this->userModel->get();

            return response()->json([
                'data' => $user
            ], status: $this->response::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(UserRequest $request)
    {

        try {

            $user = $this->userModel->make($request->all());
            $user->password = $this->hash::make($request->password);
            $user->save();

            return response()->json([
                'data' => $user
            ], status: $this->response::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($user_id)
    {

        try {

            $user = $this->userModel->find($user_id);

            if (!$user) {

                array_push($this->messages['user_id'], 'User tidak ditemukan!');

                return response()->json([
                    'message' => $this->messages
                ], status: $this->response::HTTP_BAD_REQUEST);
            } else {

                return response()->json([
                    'data' => $user
                ], status: $this->response::HTTP_OK);
            }
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UserRequest $request, $user_id)
    {

        try {

            $user = $this->userModel->find($user_id);

            if (!$user) {

                array_push($this->messages['user_id'], 'User tidak ditemukan!');

                return response()->json([
                    'message' => $this->messages
                ], status: $this->response::HTTP_BAD_REQUEST);
            } else {

                $request->merge([
                    'nama' => $request->nama ?? $user->nama,
                    'email' => $request->email ?? $user->email,
                    'password' => $request->password ? $this->hash::make($request->password) : $user->password,
                ]);


                $user->update($request->all());

                return response()->json([
                    'data' => $user
                ], status: $this->response::HTTP_OK);
            }
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($user_id)
    {

        try {

            $user = $this->userModel->find($user_id);

            if (!$user) {

                array_push($this->messages['user_id'], 'User tidak ditemukan!');

                return response()->json([
                    'message' => $this->messages
                ], status: $this->response::HTTP_BAD_REQUEST);
            } else {

                $user->delete();

                array_push($this->messages['user_id'], 'User berhasil dihapus!');

                return response()->json([
                    'message' => $this->messages
                ], status: $this->response::HTTP_OK);
            }
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
