<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory; 
    protected $fillable = ['owner_id','name','description','start_date','deadline'];

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }
}
