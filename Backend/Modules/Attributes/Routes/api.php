<?php

use Illuminate\Support\Facades\Route;
use Modules\Attributes\Http\Controllers\AttributesController;

Route::apiResource('attributes', AttributesController::class);