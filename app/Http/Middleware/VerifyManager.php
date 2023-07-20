<?php

namespace App\Http\Middleware;

use Closure;

class VerifyManager
{
    public function handle($request, Closure $next)
    {
        // Check if manager ID is entered correctly
        $managerId = $request->input('manager_id');
        if ($managerId !== 'manager_id') {
            // Manager ID is incorrect, you can redirect or show an error message
            return redirect()->back()->with('error', 'Incorrect Manager ID');
        }

        return $next($request);
    }
}
