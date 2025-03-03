<?php

namespace App\Http\Middleware\Camaba;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAFormIsFulfilled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $message = 'Mohon untuk melengkapi formulir tipe A terlebih dahulu';
        if (auth()->user()->register?->formulir == null) {
            if ($request->expectsJson()) {
                return \ResponseFormatter::error('Mohon untuk melakukan pembayaran terlebih dahulu');
            } else {
                return redirect()->route('dashboard')->with('error', 'Mohon untuk melakukan pembayaran terlebih dahulu');
            }
        }

        if (! auth()->user()->register?->cekFormulirALengkap()) {
            if ($request->expectsJson()) {
                return \ResponseFormatter::error($message);
            } else {
                return redirect()->route('dashboard')->with('error', $message);
            }
        }

        return $next($request);
    }
}
