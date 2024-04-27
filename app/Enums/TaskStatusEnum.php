<?php
namespace App\Enums;

enum RoleEnum: string
{
case PENDING = "pending";
case IN_PROGRESS = "in progress";
case COMPLETED = "completed";
}
