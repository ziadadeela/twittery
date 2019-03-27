<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return void
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return UserResource
     */
    public function authUser()
    {
        $user = auth()->user();
        $user = User::first();

        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user = app(UpdateUserAction::class)->update($user, $request->all());

        return response()->json([
            'message' => 'User Updated Successfully',
            'user' => new UserResource($user)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

}
