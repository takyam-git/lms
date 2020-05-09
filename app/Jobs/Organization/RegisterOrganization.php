<?php

namespace App\Jobs\Organization;

use App\Helpers\StringHelper;
use App\Jobs\Job;
use App\Models\Organization;
use App\Models\User;
use DB;
use EloquentHelper;

class RegisterOrganization extends Job
{
    /** @var string  */
    private $name;
    /** @var User|null  */
    private $user;

    public function __construct(string $name, ?User $firstUser)
    {
        $this->name = $name;
        $this->user = $firstUser;
    }

    public function handle(): Organization
    {
        return DB::transaction(function () {
            $organization = new Organization();
            $organization->name = $this->name;
            EloquentHelper::saveUnique($organization, function (
                Organization $organization
            ) {
                // アルファベット4文字+数字4文字
                $organization->code =
                    \StringHelper::random(
                        4,
                        StringHelper::UPPER_ALPHA_SYMBOLS
                    ) . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                return $organization;
            });
            $organization->save();

            if ($this->user) {
                $this->dispatchNow(
                    new AssignUserToOrganization($this->user, $organization)
                );
            }

            return $organization;
        });
    }
}
