<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:App\User,email'],
            'password' => ['required']
        ]);
        
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->all();
        $user['roles'] = $roles;
        $user['roleName'] = array_shift($roles);
        $user['all_notifications'] = $user->notifications;
        $user['unread_notifications'] = $user->unreadNotifications;
        $user['read_notifications'] = $user->readNotifications;
        $user['dru'] = auth()->user()->dru;
        
        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    /**
     * Change the current authenticated user's password.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        request()->validate([
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);
        
        $user = User::find(auth()->user()->id);

        $user->update([
            'password' => bcrypt(request()->get('password')),
        ]);
        
        return response()->json([
            'message' => 'Password changed.'
        ]);
    }
}
