<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function states() : HasMany
    {
        return $this->hasMany(State::class);
    }

    public function employees() : HasMany
    {
        return $this->hasMany(Employee::class);
    }    

    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }

    public function departments()
    {
        return $this->hasManyThrough(Department::class, Employee::class);
    }
    
}
