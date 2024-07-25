<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerSetting extends Model
{    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
 