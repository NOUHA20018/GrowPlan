<?php
namespace App\Rules;

class GlobalValidationRules
{
    public static function user()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public static function product()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }

    public static function order()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'total' => ['required', 'numeric', 'min:0'],
        ];
    }
}
