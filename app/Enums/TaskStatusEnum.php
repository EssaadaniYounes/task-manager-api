<?php
namespace App\Enums;

enum TaskStatusEnum: string
{
case PENDING = "pending";
case IN_PROGRESS = "in progress";
case COMPLETED = "completed";
}
