<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserDataTableRequest;
use App\Http\Requests\Users\UserRequest;
use App\Models\User;
use App\Services\Users\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    protected $service;

    function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $data = $this->service->index();
        return view('users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $this->authorize('create', User::class);
        $data = $this->service->create();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * 
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $this->authorize('create', User::class);
        $data = $this->service->store($request->validated());
        return response()->json($data);
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
    public function update(User $user, UserRequest $request): JsonResponse
    {
        $this->authorize('update', $user);
        $data = $this->service->update($user, $request->validated());
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * 
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete',  $user);
        $data = $this->service->delete($user);
        return response()->json($data);
    }

    /**
     * @param UserDataTableRequest $request
     * 
     * @return JsonResponse
     */
    public function datatable(UserDataTableRequest $request): JsonResponse
    {
        $this->authorize('viewAny', User::class);
        return $this->service->datatable($request->validated());
    }
}
