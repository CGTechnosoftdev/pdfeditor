<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    public static function getCountryCodeList(){
    	return self::select(\DB::raw('id,CONCAT("+",phonecode,"(",name,")") as name'))
    		->get()->pluck('name','id')->toArray();

    }
}
