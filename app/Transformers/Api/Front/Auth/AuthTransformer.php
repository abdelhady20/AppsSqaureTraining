<?php

namespace App\Transformers\Api\Front\Auth;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class AuthTransformer extends TransformerAbstract
{
    use Settings;
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
   public function transform(User $user) : array
    {
        $array = [
            'name' => (string)$user->name,
            'email' => (string)$user->email,
            'phone' => (string)$user->phone,
            'profile_image' => $user->getFirstMediaUrl('profile_image')  ?? "",
            'count_points' => $user->count_points  ?? 0,
            'redeem_points_count' => $this->settingValue('redeem_points_count')  ?? 0,
            'redeem_points_price' => $this->settingValue('redeem_points_price')  ?? 0,
        ];
        return $array;
    }
}