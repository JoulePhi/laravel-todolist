<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todolist extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_id',
        'user_id',
        'todo',
        'checked'
    ];


    public function todolist(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
