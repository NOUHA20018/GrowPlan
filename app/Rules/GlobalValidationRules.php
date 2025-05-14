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

    public static function courses()
    {
        return [
           'title' => ['required','string','min:2'],
            'description' => ['nullable','string','min:4'],
            'prix' => ['required','integer'],
            'date_creation' => ['nullable','date'],
            'categorie_id'=> ['required'],
            'image' =>['image','nullable','mimes:jpg,bmp,png']
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
