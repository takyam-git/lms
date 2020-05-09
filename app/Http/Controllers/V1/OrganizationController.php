<?php
namespace App\Http\Controllers\V1;

use App\Http\Resources\Organization as OrganizationResource;
use App\Jobs\Organization\RegisterOrganization;
use App\Models\Organization;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:100',
        ]);

        /** @var User $user */
        $user = Auth::user();
        /** @var Organization $organization */
        $organization = $this->dispatchNow(
            new RegisterOrganization($validated['name'], $user)
        );

        return new OrganizationResource($organization);
    }
}
