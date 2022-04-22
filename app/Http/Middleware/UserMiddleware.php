<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        if(Auth::check() && Auth::user()->isban)
    {
        $banned = Auth::user()->isban == "1"; // "1"= user is banned / "0"= user is unBanned
        Auth::logout();
        toastr()->success('Inscription éffectuée avec succès, mais votre compte est inactif. Veuillez contacter l\'adminitrateur svp.', 'Succès');

        if ($banned == 1) {
            return redirect()->route('login');
            toastr()->success('Inscription éffectuée avec succès, mais votre compte est inactif. Veuillez contacter l\'adminitrateur svp!', 'Succès');
        }
    }
    return $next($request);
    }
}
