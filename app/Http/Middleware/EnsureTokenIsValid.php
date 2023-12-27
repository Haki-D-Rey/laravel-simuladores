<?php

namespace App\Http\Middleware;

use App\Models\PersonalAcessTokens;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class EnsureTokenIsValid
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verificar si hay un token de Sanctum válido presente
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();

            $expirationTime = PersonalAcessTokens::where('tokenable_id', $user->id)
                ->latest('created_at')
                ->first();

            $expirationMinutes = Config::get('sanctum.expiration');

            $expirationTime = $expirationTime->expires_at;
            $currentTime = now()->toDateTimeString();
            $dateTime = Carbon::parse($expirationTime);

            $nuevaFechaHora = $dateTime->addMinutes($expirationMinutes);
            // Verificar si la fecha y hora actual es mayor o igual a la fecha y hora de expiración
            if ($currentTime >= $nuevaFechaHora) {

                // return response()->json(['message' => 'token expiro, No Autorizado'], 401);
                Auth::guard('web')->logout();
                return redirect('/login');
            }
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

}
