<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizeToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {        
        if ($request->session()->has('credential')){
            $credential = $request->session()->get('credential');
            foreach ($credential->user_data->roles as $role) {
                if (in_array($role->name, $roles)) {
                    return $next($request);
                }
            }            
        }
        return redirect()->route('welcome');
    }
}
