<?php
namespace App\Http\Controllers\V1;

use App\Http\Resources\User as UserResource;
use Auth;
use stdClass;

class OrganizationController extends Controller
{
    public function getList()
    {
        $user = Auth::user();

        \Log::debug($user);

        return $user
            ? UserResource::make($user)
            : response()->json(new stdClass());
    }
}
