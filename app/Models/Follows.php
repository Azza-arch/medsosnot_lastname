<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'followable_type', 'followable_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
