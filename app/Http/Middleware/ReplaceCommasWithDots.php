<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReplaceCommasWithDots
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        foreach ($request->all() as $key => $value) {
            if (is_string($value) && strpos($value, ',') !== false) {
                $value = str_replace(',', '.', $value);
            }
            if (is_numeric($value)) {
                $request->merge([$key => $value]);
            }
        }

        return $next($request);
    }
}