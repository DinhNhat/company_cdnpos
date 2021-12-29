<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function getAllUserIds() {
        $allUserIds = $this->users->map(function($item, $key) {
            return $item->id;
        });
        return $allUserIds->all();
    }

    public function hasAnyUser($userId) {
        if (!count($this->getAllUserIds()) > 0) return 'false';
        if (in_array($userId, $this->getAllUserIds())) return 'true';
        return 'false';
    }
}
