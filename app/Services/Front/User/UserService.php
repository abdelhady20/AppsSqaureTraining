<?php

namespace App\Services\Front\User;

use App\Exceptions\ValidationException;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserService
{
    public function register(array $data): ?User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
        ]);

        // user verification
        $otpCode = OtpCode::create([
            'code' => OtpCode::generateCode(),
            'type' => 'phone',
            'user_id' => $user->id,
            'usage' => 'verify',
            'expires_at' => Carbon::now()->addMinute(10)
        ]);

        $resetCodeMsg = 'send_code_msg_verify code' . $otpCode->code ;
        return $user;
    }

    public function sendCode(array $data): ?User
    {
        $user = User::wherePhone($data['phone'])
            ->whereNull('deleted_at')->first();

        if (!$user) {
            throw new ValidationException('incorrect_phone');
        }

        $otpCode = OtpCode::create([
            'code' => OtpCode::generateCode(),
            'type' => 'phone',
            'user_id' => $user->id,
            'usage' => $data['usage'],
            'expires_at' => Carbon::now()->addMinute()
        ]);
        return $user;
    }

    public function verify(array $data): array
    {
        $user = User::wherePhone($data['phone'])
            ->whereNull('deleted_at')->first();
        if (!$user) {
            throw new ValidationException(__('messages.incorrect_phone'));
        }
        $data['user_id'] = $user->id;
        $data['usage'] = 'verify';
        $otp = $this->getOtp($data);
        if (!$otp) {
            throw new ValidationException(__('messages.not_valid_otp_code'));
        }
        if ($user->is_phone_verified) {
            throw new ValidationException(__('messages.verified_before'));
        }
        $user->is_phone_verified = 1;
        $user->save();
        $otp->delete();
        $token = $this->createTokenForUser($user);
        return ['user' => $user, 'token' => $token];
    }

    public function verifyCode(array $data): ?bool
    {
        $user = User::wherePhone($data['phone'])->whereNull('deleted_at')->first();
        throw_if(!$user, new ValidationException(__('messages.incorrect_phone')));
        $otp = OtpCode::where([
            'user_id' => $user->id,
            'code' => $data['code'],
            'type' => 'phone'
        ])->whereDate('expires_at', '>=', now())->first();

        throw_if(!$otp, new ValidationException(__('messages.not_valid_otp_code')));
        return true;
    }

    public function getOtp(array $data): ?OtpCode
    {
        return OtpCode::where([
            'user_id' => $data['user_id'],
            'code' => $data['code'],
            'type' => 'phone',
            'usage' => $data['usage'],
        ])->whereDate('expires_at', '>=', now())->first();
    }

    private function createTokenForUser(User $user): string
    {
        $device = substr(request()->userAgent() ?? '', 0, 255);
        return $user->createToken($device)->plainTextToken;
    }
}
