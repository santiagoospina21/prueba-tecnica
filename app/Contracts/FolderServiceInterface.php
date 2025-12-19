<?php

namespace App\Contracts;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Collection;

interface FolderServiceInterface
{
    public function getAllFolders(): Collection;
    public function createFolder(Folder $folder): Folder;
    public function updateFolder(int $id, array $data): Folder;
    public function deleteFolder(int $id): Folder;

}
