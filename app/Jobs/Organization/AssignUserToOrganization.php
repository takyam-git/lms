<?php

namespace App\Jobs\Organization;

use App\Jobs\Job;
use App\Models\Organization;
use App\Models\User;
use App\Models\UserOrganization;
use DB;

class AssignUserToOrganization extends Job
{

    /** @var User  */
    private $user;
    /** @var Organization */
    private $organization;

    public function __construct(User $user, Organization $organization)
    {
        $this->user = $user;
        $this->organization = $organization;
    }

    public function handle()
    {
        DB::transaction(function () {
            $userOrganization = new UserOrganization();
            $userOrganization->user()->associate($this->user);
            $userOrganization->organization()->associate($this->organization);
            $userOrganization->save();
        });
    }
}
