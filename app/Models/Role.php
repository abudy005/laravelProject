<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Fields that can be mass assigned (e.g. Role::create([...]))
    protected $fillable = [
        'name',
        'description',
    ];

    // A role may belong to many users (many-to-many via the role_user pivot)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
