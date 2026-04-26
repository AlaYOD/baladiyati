<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): mixed
    {
        $redirectTo = $this->redirectTo($request);

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($redirectTo);
    }

    private function redirectTo(Request $request): string
    {
        // Landlord guard users (super admins) go to the admin panel.
        if (auth('landlord')->check()) {
            return '/admin';
        }

        // Tenant users always land on the root of their subdomain panel.
        return '/';
    }
}
