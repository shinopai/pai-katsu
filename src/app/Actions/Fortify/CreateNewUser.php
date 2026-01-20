<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
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

        // 開発環境での処理
        if (App::environment('local')) {

            $iconPath = null;

            if (isset($input['icon']) && $input['icon'] instanceof UploadedFile) {
                $iconPath = $input['icon']->store('icons', 'public');
            }
        }

        // 本番環境での処理
        if (App::environment('production')) {

            $iconPath = null;

            if (isset($input['icon']) && $input['icon'] instanceof UploadedFile) {
                $iconPath = $input['icon']->store('icons', 's3');
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
