<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest; // Import the LoginRequest
use Adldap\Laravel\Facades\Adldap;
use Adldap\Auth\BindException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // The validated data is automatically available here
        $credentials = $request->only('email', 'password');

        try {
            // Attempt to authenticate the user against LDAP
            $auth = Adldap::auth()->attempt($credentials['email'], $credentials['password']);

            if ($auth) {
                // User authenticated, redirect or perform your logic
                return redirect()->intended('home'); // Adjust the redirect path as needed
            } else {
                // Authentication failed
                return back()->withErrors(['email' => 'Invalid credentials.']);
            }
        } catch (BindException $e) {
            // Handle LDAP connection error
            return back()->withErrors(['email' => 'Could not connect to LDAP server.']);
        } catch (\Exception $e) {
            // Handle any other exceptions
            return back()->withErrors(['email' => 'An unexpected error occurred.']);
        }
    }
}
