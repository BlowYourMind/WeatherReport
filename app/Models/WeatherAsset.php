<?php

namespace App\Models;


class WeatherAsset
{


    private string $date;
    private float $temperature;

    public function __construct(string $date, float $temperature)
    {


        $this->date = $date;
        $this->temperature = $temperature;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

}