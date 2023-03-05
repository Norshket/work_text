<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserDataTableRequest;
use App\Http\Requests\Users\UserPermissionRequest;
use App\Http\Requests\Users\UserRequest;
use App\Models\User;
use App\Services\Users\UserPermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{

    protected $service;

    function __construct(UserPermissionService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $data = $this->service->edit($user);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param UserRequest $request
     * 
     * @return JsonResponse
     */
    public function update(User $user, UserPermissionRequest $request): JsonResponse
    {
        $this->authorize('update', $user);
        $data = $this->service->update($user, $request->validated());
        return response()->json($data);
    }
}
