<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function statuses()
    {
        return $this->hasMany(GroupStatus::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }

}
