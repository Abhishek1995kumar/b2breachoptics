<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UnderConstruction
{
    public function handle(Request $request, Closure $next)
    {
        throw new HttpException(503);
    }
}