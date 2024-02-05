<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


function generateFileName($name)
{
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $hour = Carbon::now()->hour;
    $minute = Carbon::now()->minute;
    $second = Carbon::now()->second;
    $microsecond = Carbon::now()->microsecond;
    return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
}

function listInfoTower($phone){
    $response = Http::get(env('APP_URL_API').'/tokenservice/get_tower_manager/'.$phone);
    $data = $response->json();
    return $data['data'] ? : [];
}


function listInfoAllTower(){
    $response = Http::get(env('APP_URL_API').'/tokenservice/get_all_towers');
    $data = $response->json();
    return $data['data'] ? : [];
}

function searchInfoTower($data){
    $response = Http::get(env('APP_URL_API').'/tokenservice/get_all_towers/?text='.$data);
    $data = $response->json();
    return $data['data'] ? : [];
}
