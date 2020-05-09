<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OrganizationAuth;

/**
 * Class User
 * @package App\Http\Resources
 *
 * @property-read \App\Models\User $resource
 */
class User extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $this->resource->userOrganizations->load('organization');
        $organization = OrganizationAuth::organization();
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'image_url' => $this->resource->image_url,
            'organizations' => Organization::collection(
                $this->resource->userOrganizations->pluck('organization')
            )->toArray($request),
            'organization' => $organization
                ? Organization::make($organization)->toArray($request)
                : null,
        ];
    }
}
