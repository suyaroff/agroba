<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Handles API authentication operations including login, logout, and token management.
 *
 * This controller manages user authentication through JWT tokens and provides
 * endpoints for user login, logout, token refresh, and user information retrieval.
 */
class AuthController extends Controller
{

    /**
     * Authenticate a user and generate a JWT token.
     *
     * Validates the provided email and password credentials.
     * Returns a JWT token if authentication is successful.
     *
     * @param Request $request The request containing email and password credentials
     * @return JsonResponse Returns token on success or error message on failure
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the currently authenticated user's information.
     *
     * Retrieves the authenticated user's details from the token.
     * Requires a valid JWT token in the request.
     *
     * @return JsonResponse Returns the authenticated user's data
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out by invalidating their JWT token.
     *
     * Invalidates the current token, effectively logging out the user.
     * Requires a valid JWT token in the request.
     *
     * @return JsonResponse Returns a success message after logout
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Format the token response structure.
     *
     * Creates a standardized response containing the access token,
     * token type, and expiration time.
     *
     * @param string $token The JWT token to be formatted
     * @return JsonResponse Returns the formatted token response
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


}
