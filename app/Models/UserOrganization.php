<?php

namespace App\Models;

/**
 * App\Models\UserOrganization
 *
 * @property string $id
 * @property string $user_id
 * @property string $organization_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Organization $organization
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereUserId($value)
 * @mixin \Eloquent
 */
class UserOrganization extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
