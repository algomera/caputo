<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->role->name;
                switch ($role) {
                    case 'admin':
                        return redirect()->route(auth()->user()->getRedirectRouteName());
                        break;
                    case 'responsabile sede':
                        return redirect()->route(auth()->user()->getRedirectRouteName());
                        break;
                    case 'medico':
                        return redirect()->route(auth()->user()->getRedirectRouteName());
                        break;
                    case 'insegnante':
                        return redirect()->route(auth()->user()->getRedirectRouteName());
                        break;
                    case 'istruttore':
                        return redirect()->route(auth()->user()->getRedirectRouteName());
                        break;
                    case 'segretaria':
                        return redirect()->route(auth()->user()->getRedirectRouteName());
                        break;
                    default:
                        return redirect('/login');
                        break;
                }
            }
        }
        return $next($request);
    }
}
