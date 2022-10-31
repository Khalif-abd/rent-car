<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreResource;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/users",
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }


    /**
     * @throws HttpClientException
     */
    public function store(UserStoreResource $request): Response
    {
        try {
            $user = User::create($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось создать пользователя.');
        }

        return response([
            'status' => true,
            'user' => $user,
            'message' => 'Пользователь успешно добавлен.',
        ], 200);
    }


    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }


    /**
     * @throws HttpClientException
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $user->update($request->all());
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось обновить данные пользователя.');
        }

        return response([
            'status' => true,
            'user' => $user,
            'message' => 'Данные успешно сохранены.',
        ], 200);
    }


    /**
     * @throws HttpClientException
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (QueryException $e) {
            throw new HttpClientException('Не удалось удалить пользователя.');
        }

        return response([
            'status' => true,
            'message' => "Пользователь успешно удален.",
        ], 200);
    }
}
