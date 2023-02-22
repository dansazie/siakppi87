<?php

use App\Models\Setting;
use App\Models\TahunAkademiks;

function setting($key){

    if($key=='tahunakademik'){
        $settings=TahunAkademiks::where('status','Aktif')->first();
        return $settings->{$key};
    }elseif($key=='tahunakademik_id' ){
        $settings=TahunAkademiks::where('status','Aktif')->first();
        return $settings->id;
    }else{
        $settings=Setting::first();
        return $settings->{$key};
    }    

}