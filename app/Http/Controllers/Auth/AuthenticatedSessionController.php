<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\PersonalAcessTokens;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = $request->user();

        $user->tokens()->delete();

        // Crear un nuevo token y obtener el plainTextToken
        $token = $user->createToken('api-token');
        info($token->accessToken);
        info($token);
        PersonalAcessTokens::find($token->accessToken->id)->update([
            'expires_at' => $token->accessToken->created_at
        ]);
        // Guardar el plainTextToken en el campo específico (por ejemplo, plain_token)
        $user->update([
            'plain_token' => $token->plainTextToken,
        ]);

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function getToken(LoginRequest $request): JsonResponse
    {
        $request->authenticate();
        $user = $request->user();

        info($user);

        $expirateToken = $this->tiempoRestanteParaExpirar($user);
        info($expirateToken ." segundos");
        return response()->json([
            "user" => $user->makeHidden(['plain_token', 'email_verified_at', 'created_at', "updated_at"]),
            "token" => $user->plain_token,
            "expirate" => $expirateToken ." segundos",
        ], 200);
    }


    public function tiempoRestanteParaExpirar($user)
    {
        if ($user) {
            // Obtener el último token de acceso del usuario
            $personalTokenId = PersonalAcessTokens::where('tokenable_id', $user->id)
                ->latest('created_at')
                ->first();

            $expirationMinutes = Config::get('sanctum.expiration');

            $expirationTime = $personalTokenId->expires_at;
            $dateTime = Carbon::parse($expirationTime);

            $dateTimeValidateToken = $dateTime->addMinutes($expirationMinutes);

            if ($personalTokenId) {
                // Calcular el tiempo restante antes de que expire
                $tiempoRestante = Carbon::now()->diffInSeconds($dateTimeValidateToken);
                return $tiempoRestante;
            } else {
                return '0';
            }
        } else {
            return '0';
        }
    }
}
