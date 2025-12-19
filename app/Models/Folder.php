<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Folder extends Model
{
    use SoftDeletes;
    protected $fillable = ["name", "container", "owner"];


    public function children(): HasMany
    {
        return $this->hasMany(Folder::class, 'container');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'container');
    }

    protected static function booted(): void
    {
        static::deleting(function (Folder $folder) {
            $folder->children()->get()->each->delete();
        });

        static::restoring(function (Folder $folder) {
            $folder->children()->withTrashed()->get()->each->restore();
        });
    }
}
