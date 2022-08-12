<?php

namespace App\Controllers;
use App\Models\WeatherAsset;
use App\View;

class WeatherController
{
    public function show():View
    {
        $report = file_get_contents('https://api.weatherapi.com/v1/forecast.json?key=91fa6cc482034a77b8285330222107&q=Riga&days=1&aqi=no&alerts=no');
        $report = json_decode($report);

        $weatherReport=[];
        foreach ($report->forecast->forecastday[0]->hour as $hourlyReport){
            $weatherReport[] = new WeatherAsset(
                $hourlyReport->time,
                $hourlyReport->temp_c
            );
        }
        return new View('hourly-report.twig', [
       'weatherReport'=>$weatherReport
    ]);
    }
}
