<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forecast;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use DateTime;
//use Sunra\PhpSimple\HtmlDomParser;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function loadForecastSettingsView()
    {
        return view('moderator.forecastdatasettings');
    }

    public function loadForecastData(Request $request)
    {
        if($request->website == "meteo")
        {
            Forecast::query()->delete();

            $urlArray = array(
                'https://api.meteo.lt/v1/places/vilnius/forecasts/long-term',
                'https://api.meteo.lt/v1/places/kaunas/forecasts/long-term',
                'https://api.meteo.lt/v1/places/klaipeda/forecasts/long-term',
                'https://api.meteo.lt/v1/places/siauliai/forecasts/long-term',
                'https://api.meteo.lt/v1/places/panevezys/forecasts/long-term'
            );
            foreach($urlArray as $url)
            {
                $json = file_get_contents($url);
                $data = json_decode($json, true);
                $forecast = new Forecast();
                $name = $data['place']['name'];
                foreach ($data['forecastTimestamps'] as $row)
                {
                    $forecast = Forecast::firstOrCreate([
                        'name' => $name,
                        'windSpeed'=> $row['windSpeed'],
                        'forecastTimeUtc'=> $row['forecastTimeUtc'],
                    ], $row, $name);
                }
                $forecast->save();        
            }
        }
        else if($request->website == "gismeteo")
        {
            Forecast::query()->delete();
            //$client = new Client(HttpClient::create(['timeout' => 100]));
            $client = new Client();

            /*$config = [
                'proxy' => [
                    'http' => 'xx.xx.xx.xx:8080'
                    ]
                ];
            $client = new \Goutte\Client;
            $client->setClient(new \GuzzleHttp\Client($config));*/
            
            //$client->setHeader('Accept', 'text/html');


         
            //$client = new Client(HttpClient::create(['proxy' => 'http://xx.xx.xx.xx:80']));
            //$crawler = $client->request('GET', 'https://eu13.proxysite.com/process.php?d=uzWxbtITQONZEIOBK%2Fb%2Fnb57s65GmJPz840XLcJ1mr%2BcH4SUnYunVfY%3D&b=1&f=norefer');
            //dd($crawler);
            //$status_code = $client->getResponse()->getStatus();

            

            $urlArray = array(
                'https://www.gismeteo.lt/weather-vilnius-4230/',
                'https://www.gismeteo.lt/weather-kaunas-4202/',
                'https://www.gismeteo.lt/weather-klaip%C4%97da-4157/',
                'https://www.gismeteo.lt/weather-%C5%A1iauliai-4170/',
                'https://www.gismeteo.lt/weather-panev%C4%97%C5%BEys-4175/'
            );
            $cache = 'http://webcache.googleusercontent.com/search?q=cache:';
            //$url = 'https://www.gismeteo.lt';
            $daysArray = array(
                '',
                'tomorrow',
                '3-day',
                '4-day',
                '5-day',
                '6-day',
                '7-day',
                '8-day',
                '9-day',
                '10-day'
            );
            $citiesArray = array(
                'Vilnius',
                'Kaunas',
                'Klaipdėda',
                'Šiauliai',
                'Panevėžys'
            );
            $timeArray = array(
                '02:00:00',
                '05:00:00',
                '08:00:00',
                '11:00:00',
                '14:00:00',
                '17:00:00',
                '20:00:00',
                '23:00:00'
            );
            $date = new DateTime();
            $dateArray = array();
            for ($i = 0; $i < 10; $i++)
            {  
                $dateArray[$i] = $date->format('Y-m-d');
                $date->modify('+1 day');
            }
        
            for ($i = 0; $i < 5; $i++)
            {

                for ($j = 0; $j < 10; $j++)
                {
                    //$html = HtmlDomParser::file_get_html('https://www.gismeteo.lt/weather-kaunas-4202/');
                    //$wind = $html->find('div.nowinfo__value')[0]->innertext;

                    $crawler = $client->request('GET', $cache.$urlArray[$i].$daysArray[$j]);
                    sleep(15);
                    dump($crawler); 
                    $result = array();
                    

                    $result = $crawler->filter('span.unit.unit_wind_m_s')->each(function ($node) {
                        return $node->text();
                    });
                    $windSpeedArray = array();
                    $windSpeedArray = array_slice($result, 10, 8);
                    //dump($windSpeedArray);
                     
                    
                   /*for ($k = 0; $k < 8; $k++)
                    {  
                        $forecast = new Forecast();

                        $forecast = Forecast::firstOrCreate([
                            'name' => $citiesArray[$i],
                            'windSpeed' => $windSpeedArray[$k],
                            'forecastTimeUtc' => $dateArray[$j].' '.$timeArray[$k],
                            ], $citiesArray, $windSpeedArray, $timeArray, $dateArray, $i, $j, $k);
                    }*/

                     
                }   
                           
            }
            $forecast->save(); 

        }
        else
        {
            return redirect('loadforecast')->with('error', 'Klaida: nepasirinkote svetaines!');
        }

        //return redirect('loadforecast')->with('success', 'Atnaujinti prognozių duomenys!');
    }

    public function loadForecastDataMeteo()
    {
        //$res = request('GET','https://api.meteo.lt/v1/places/vilnius/forecasts/long-term');
        $urlArray = array(
            'https://api.meteo.lt/v1/places/vilnius/forecasts/long-term',
            'https://api.meteo.lt/v1/places/kaunas/forecasts/long-term',
            'https://api.meteo.lt/v1/places/klaipeda/forecasts/long-term',
            'https://api.meteo.lt/v1/places/siauliai/forecasts/long-term',
            'https://api.meteo.lt/v1/places/panevezys/forecasts/long-term'
        );
        foreach($urlArray as $url)
        {
            $json = file_get_contents($url);
            $data = json_decode($json, true);
            $forecast = new Forecast();
            $name = $data['place']['name'];
            foreach ($data['forecastTimestamps'] as $row)
            {
                $forecast = Forecast::firstOrCreate([
                    'name' => $name,
                    'windSpeed'=> $row['windSpeed'],
                    'forecastTimeUtc'=> $row['forecastTimeUtc'],
                ], $row, $name);
            }
            $forecast->save();        
        }
        
        //return response()->json($data);
        //return view('moderator.loadweather');
    }

    public function loadForecastDataGismeteo()
    {
           
    }

    
}