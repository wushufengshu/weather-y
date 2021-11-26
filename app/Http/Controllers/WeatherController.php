<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function fetch(Request $request){ 
        $city_name = request()->city_name ? request()->city_name : 'Tokyo'; 

        $weather = $this->get_weather_details($city_name, config('services.openweather.key'));
        $site_list = $this->get_site_details($city_name, config('services.foursquare.key'));
        
        return view('weathery', [
            'currentWeather' => $weather[0],
            'weatherForecast' => $weather[1],
            'siteList' => $site_list
        ]);
          
    } 
    public function get_weather_details($city_name, $openwether_key){
        //current weather data
        $current_weather = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city_name}&appid={$openwether_key}&units=metric")->json();
        
        //get 5day 3hr forecast
        $weather_forecast = Http::get("https://api.openweathermap.org/data/2.5/forecast?q={$city_name}&appid={$openwether_key}&cnt=5&units=metric")->json();
        
        return [$current_weather, $weather_forecast];
    }

    public function get_site_details($city_name, $foursquare_key){
        $places = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $foursquare_key,
        ])->get('https://api.foursquare.com/v3/places/search', [
            'near' => $city_name,
            'limit' => 5,
            'categories' => 16020
        ])->json();  
        
        $sites = collect([]);
        foreach($places['results'] as $place){ 
            
            $photos = $this->foursquare_http_get_request(
                "https://api.foursquare.com/v3/places/{$place['fsq_id']}/photos",
                $foursquare_key
            );

            $tips = $this->foursquare_http_get_request(
                "https://api.foursquare.com/v3/places/{$place['fsq_id']}/tips", 
                $foursquare_key
            );

            $sites->push([$place, $photos, $tips]);
        }
        return $sites;
    }

    public function foursquare_http_get_request($request, $foursquare_key){
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $foursquare_key,
        ])->get($request, [ 
            'limit' => 1, 
        ])->json();
    }
}
