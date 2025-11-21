<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasPoints
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $min
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $min = 150)
    {
        $user = $request->user();
        if (! $user || ($user->points ?? 0) < (int) $min) {
            if ($request->expectsJson()) {
                return response()->json(['message' => "Anda memerlukan minimal {$min} poin untuk melakukan aksi ini."], 403);
            }
            return redirect()->route('pustakawarisan')->with('error', "Anda memerlukan minimal {$min} poin untuk mengunggah artikel.");
        }
        return $next($request);
    }
}
