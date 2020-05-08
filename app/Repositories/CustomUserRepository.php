<?php
namespace App\Repositories;

use App\Models\User;

use Auth0;
use Auth0\Login\Auth0User;
use Auth0\Login\Auth0JWTUser;
use Auth0\Login\Repository\Auth0UserRepository;
use Auth0\SDK\API\Authentication;
use Illuminate\Contracts\Auth\Authenticatable;
use Log;

class CustomUserRepository extends Auth0UserRepository
{
    protected function upsertUser($profile): User
    {
        $user = User::whereSub($profile['sub'])->first();
        if (!$user) {
            $user = new User();
            $user->sub = $profile['sub'];
        }
        if (!$user->name) {
            $user->name = $profile['name'] ?? '';
        }
        if (!$user->email) {
            $user->email = $profile['email'] ?? '';
        }
        if (!$user->email_verified) {
            $user->email_verified = $profile['email_verified'] ?? false;
        }
        if (!$user->image_url) {
            $user->image_url = $profile['picture'] ?? null;
        }
        if (!$user->exists || $user->isDirty()) {
            $user->save();
        }
        return $user;
    }

    public function getUserByDecodedJWT(array $decodedJwt): Authenticatable
    {
        $user = $this->upsertUser((array) $decodedJwt);
        return new Auth0JWTUser($user->getAttributes());
    }

    public function getUserByUserInfo(array $userInfo): Authenticatable
    {
        $user = $this->upsertUser($userInfo['profile']);
        return new Auth0User($user->getAttributes(), $userInfo['accessToken']);
    }
}
