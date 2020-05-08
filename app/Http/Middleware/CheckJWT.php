<?php
namespace App\Http\Middleware;

use App;
use App\Models\User;
use Auth;
use Auth0\Login\Contract\Auth0UserRepository;
use Auth0\SDK\API\Authentication;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckJWT
{
    protected $userRepository;

    /**
     * CheckJWT constructor.
     *
     * @param Auth0UserRepository $userRepository
     */
    public function __construct(Auth0UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth0 = App::make('auth0');

        $accessToken = $request->bearerToken();
        if (!$accessToken) {
            return $this->invalid();
        }

        try {
            $tokenInfo = $auth0->decodeJWT($accessToken);
            $auth0User = $this->userRepository->getUserByDecodedJWT($tokenInfo);
            if (!$auth0User) {
                return $this->invalid();
            }
            /** @var User $user */
            $user = User::whereSub($auth0User->getAuthIdentifier())->first();
            if (!$user->isProfileLoaded()) {
                $apiClient = new Authentication(
                    config('laravel-auth0.domain'),
                    config('laravel-auth0.client_id'),
                    config('laravel-auth0.client_secret'),
                    config('laravel-auth0.api_identifier')[0] ?? null,
                    'openid profile email',
                    []
                );
                $userInfo = $apiClient->userinfo($accessToken);
                $user->name = empty($userInfo['name'])
                    ? null
                    : $userInfo['name'];
                $user->email = empty($userInfo['email'])
                    ? null
                    : $userInfo['email'];
                $user->email_verified = $userInfo['email_verified'] ?? false;
                $user->image_url = $userInfo['picture'] ?? null;
                $user->profile_loaded_at = Carbon::now();
                $user->save();
            }
            Auth::login($user);
        } catch (InvalidTokenException $e) {
            return $this->invalid($e->getMessage());
        } catch (CoreException $e) {
            return $this->invalid($e->getMessage());
        }

        return $next($request);
    }

    private function invalid(?string $message = null)
    {
        Auth::logout();
        return response()->json(
            ['message' => $message ?: 'Unauthorized user'],
            401
        );
    }
}
