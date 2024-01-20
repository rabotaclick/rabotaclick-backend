<?php

namespace App\Http\Requests\Resume\Enums;

enum ResumeBusinessTripsEnum: string
{
    case Never = 'never';
    case Ready = 'ready';
    case Sometimes = 'sometimes';
}
