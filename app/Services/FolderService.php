<?php

namespace App\Services;

use App\Contracts\FolderServiceInterface;
use App\Models\Folder;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class FolderService implements FolderServiceInterface
{
    public function getAllFolders(): Collection
    {
       try {
        $folders = Folder::all();
        return $folders;

       }catch (Exception $e) {
            throw new Exception("Error fetching folders: " . $e->getMessage());
       }
    }

    public function createFolder(Folder $folder): Folder
    {
        try {
            $folder->save();
            return $folder;
        } catch (Exception $e) {
            throw new Exception("Error creating folder: " . $e->getMessage());
        }
    }

    public function updateFolder(int $id, array $data): Folder
    {
        try {
            $folder = Folder::findOrFail($id);
            $folder->update($data);   
            return $folder;
        } catch (Exception $e) {
            throw new Exception("Error updating folder: " . $e->getMessage());
        }
    }

    public function deleteFolder(int $id): Folder
    {
        try {
            $folder = Folder::findOrFail($id);
            $folder->delete();
            return $folder;
        } catch (Exception $e) {
            throw new Exception("Error deleting folder: " . $e->getMessage());
        }
    }

}