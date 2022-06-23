<?php
  
namespace App\Http\Middleware;
  
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cache;
use App\Models\User;
use Illuminate\Support\Facades\Cache as FacadesCache;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(1); /* keep online for 1 min */
            FacadesCache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
  
            /* last seen */
            User::where('id', Auth::user()->id)->update(['last_seen' => now()]);
        }
  
        return $next($request);
    }
}