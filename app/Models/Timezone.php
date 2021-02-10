<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{

    public static function getTimezoneList()
    {
        return self::select(\DB::raw('id,caption'))
            ->get()->pluck('caption', 'id')->toArray();
    }
}
