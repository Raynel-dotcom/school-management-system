<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    // Gives every controller $this->authorize(), which the registration
    // controllers use to enforce record ownership.
    use AuthorizesRequests;
}
