<?php
namespace App\Auth;

use App\Models\Organization;
use App\Models\User;
use App\Models\UserOrganization;

class OrganizationAuth
{
    public function id(): ?string
    {
        return $this->organization()->id ?? null;
    }

    public function organization(): ?Organization
    {
        return $this->userOrganization()->organization ?? null;
    }

    public function userOrganization(): ?UserOrganization
    {
        /** @var User $user */
        $user = \Auth::user();
        if (!$user || $user->userOrganizations->isEmpty()) {
            return null;
        }
        $expect = request()->header('X-App-Organization');
        if ($expect) {
            /** @var UserOrganization|null $matched */
            $matched = $user->userOrganizations->first(function (
                UserOrganization $userOrganization
            ) use ($expect) {
                return $userOrganization->id === $expect;
            });
            if ($matched) {
                return $matched;
            }
        }
        return $user->userOrganizations->first();
    }
}
