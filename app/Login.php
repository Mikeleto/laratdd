<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public function register(Request $request)
    {
        $request->validate([
            'profession_select' => 'required_without:profession_text',
            'profession_text' => 'required_without:profession_select'
        ]);


    }

}
