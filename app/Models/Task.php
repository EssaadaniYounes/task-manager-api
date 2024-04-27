<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatusEnum;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "due_date",
        "status",
        "created_by"
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class
    ];
}
