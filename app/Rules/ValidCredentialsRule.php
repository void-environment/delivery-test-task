<?php
declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ValidCredentialsRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $user = User::firstWhere('email', request()->input('email'));
        return $user && Hash::check($value, $user->password);
    }

    public function message(): string
    {
        return 'Неверные учетные данные.';
    }
}
