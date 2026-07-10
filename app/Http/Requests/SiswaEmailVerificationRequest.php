<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SiswaEmailVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = Auth::guard('siswa')->user();

        if (!$user) return false;

        if (!hash_equals((string) $user->getKey(), (string) $this->route('id'))) {
            return false;
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }

    public function fulfill(): void
    {
        $user = Auth::guard('siswa')->user();

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    }

    public function rules(): array
    {
        return [];
    }
}
