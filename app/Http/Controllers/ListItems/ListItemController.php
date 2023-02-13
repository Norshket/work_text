<?php

namespace App\Http\Controllers\ListItems;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListItems\ListItemDataTableRequest;
use App\Http\Requests\ListItems\ListItemRequest;
use App\Models\ListItems\ListItem;
use App\Services\ListItems\ListItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ListItemController extends Controller
{

    protected $service;

    function __construct(ListItemService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $data = $this->service->index();
        return view('list_items.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *           
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $data = $this->service->create();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ListItemRequest $request
     * 
     * @return JsonResponse
     */
    public function store(ListItemRequest $request): JsonResponse
    {
        $data = $this->service->store($request->validated());
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ListItem $listItem
     * 
     * @return JsonResponse
     */
    public function edit(ListItem $listItem): JsonResponse
    {
        $data = $this->service->edit($listItem);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ListItemRequest $request
     * @param ListItem $listItem
     * 
     * @return JsonResponse
     */
    public function update(ListItemRequest $request, ListItem $listItem): JsonResponse
    {
        $data = $this->service->edit($request->validated(), $listItem);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ListItem $listItem
     * 
     * @return JsonResponse
     */
    public function destroy(ListItem $listItem): JsonResponse
    {
        $data = $this->service->delete($listItem);
        return response()->json($data);
    }

    /**
     * @param ListItemDataTableRequest $request
     * 
     * @return JsonResponse
     */
    public function datatable(ListItemDataTableRequest $request): JsonResponse
    {
        return $this->service->datatable($request->validated());
    }
}
