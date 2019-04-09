<?php

use App\User;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

Route::get('exploit-query-builder', function() {
    $users = QueryBuilder::for(User::class)
        ->get();

    return response()->json($users);
});
