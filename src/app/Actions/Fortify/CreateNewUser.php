<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'icon' => ['image', 'max:2048'],
            'wakeup_time' => [
                'required',
                'date_format:H:i',
                'after_or_equal:04:00',
                'before_or_equal:10:00'
            ],
        ])->validate();

        // アイコンをS3に保存
        if (isset($input['icon']) && $input['icon'] instanceof UploadedFile) {
            $icon = $input['icon'];
            $fileName = time() . '_' . $icon->getClientOriginalName();

            $s3 = Storage::disk('s3');

            try {
                $result = $s3->putFileAs('icons', $icon, $fileName);
            } catch (\Throwable $e) {
                logger()->error('エラーだよ:' . $e->getMessage());
                throw $e;
            }

            if ($result) {
                $iconPath = $s3->url($result);
            }
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'icon' => $iconPath,
            'wakeup_time' => $input['wakeup_time']
        ]);
    }
}
