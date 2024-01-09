<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function employees() : HasMany
    {
        return $this->hasMany(Employee::class);
    }   

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%');
    }

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    
}
