<?php

use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;


Route::middleware("api.key")->group(function () {
    Route::prefix("folder")->group(function () {
        Route::get("/", [FolderController::class, "index"]);
        Route::post("/", [FolderController::class, "store"]);
        Route::put("/{id}", [FolderController::class, "update"]);
        Route::delete("/{id}", [FolderController::class, "destroy"]);
    });
});