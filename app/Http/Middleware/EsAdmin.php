<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EsAdmin
{
    // Este método se ejecuta antes de que el usuario llegue a la página
    public function handle(Request $request, Closure $next)
    {
        // Comprobamos si el usuario tiene rol de admin
        if (auth()->user()->rol !== 'admin') {
            // Si no es admin lo mandamos al dashboard
            return redirect()->route('dashboard');
        }

        // Si es admin dejamos pasar la petición
        return $next($request);
    }
}