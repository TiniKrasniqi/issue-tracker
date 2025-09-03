<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory; 
    protected $fillable = ['name','color'];

    public function issues(): BelongsToMany
    {
        return $this->belongsToMany(Issue::class);
    }
}
