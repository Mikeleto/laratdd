<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Tests\Feature\Admin\RestoreUsersTest;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function profession()
    {
        return $this->belongsTo(Profession::class)
            ->withDefault([
                'title' => '(Sin profesion)',
            ]);
    }

    public function restore()
    {
        DB::transaction(function () {
            if (parent::delete()) {
                $this->profile()->delete();

                DB::table('skill_user')
                    ->where('user_id', $this->id)
                    ->update(['deleted_at' => now()]);
                return $this->belongsTo(RestoreUsersTest::class)
                    ->withDefault([
                        'title' => '(Sin profesion)',
                    ]);
            }
        });
    }
}
