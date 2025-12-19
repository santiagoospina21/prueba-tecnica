<?php

namespace App\Http\Controllers;

use App\Contracts\FolderServiceInterface;
use App\Models\Folder;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Log;

class FolderController extends Controller
{
    protected FolderServiceInterface $folderService;

    public function __construct(FolderServiceInterface $folderService)
    {
        $this->folderService = $folderService;
    }

    public function index(): JsonResponse
    {
        try {
            $folders = $this->folderService->getAllFolders();
            return response()->json(["message" => "Folders retrieved successfully", "data" => $folders], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreFolderRequest $request): JsonResponse
    {
        try {
            $folder = new Folder($request->validated());
            $createdFolder = $this->folderService->createFolder($folder);
            return response()->json(["message" => "Folder created successfully", "data" => $createdFolder], 201);
        } catch (Exception $e) {
            return response()->json(["message" => "Error creating folder", "error" => $e->getMessage()], 500);
        }
    }

    public function update(UpdateFolderRequest $request,  int $id): JsonResponse
    {
        try {
            $updatedFolder = $this->folderService->updateFolder($id, $request->validated());
            return response()->json(["message" => "Folder updated successfully", "data" => $updatedFolder], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $deletedFolder = $this->folderService->deleteFolder($id);
            return response()->json(["message" => "Folder deleted successfully", "data" => $deletedFolder], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}