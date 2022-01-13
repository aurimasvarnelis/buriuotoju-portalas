<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forecast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForecastMessage;
use DateTime;
//use Carbon\Carbon;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function inform()
    {
        return view('user.inform');
    }

    public function informForecast(Request $request)
    {
        //dd($request->all());
        $region = $request->region;
        //return redirect('inform')->with('success',  'Wow '.$request->region.'.');
        $windSpeed1 = $request->windSpeed1;
        
        $windSpeed2 = $request->windSpeed2;
        $windSpeedTrend1 = $request->windSpeedTrend1;
        $windSpeedTrend2 = $request->windSpeedTrend2;

        $validate = null;
        $validate = $request->validate([
            'region' => 'required',
            'windSpeed1' => 'required|numeric',
            'windSpeedTrend1' => 'required' 
        ]);
        
        
        //$found1 = false;
        $forecasts = Forecast::where('name', $region)->get();
        $user = Auth::user();
        $dt = new DateTime();
        
        foreach($forecasts as $forecast)
        {
            
            if($dt->format('Y-m-d H:i:s') <= $forecast->forecastTimeUtc)
            {
                if($windSpeedTrend1 == 'more')
                {
                    if($forecast->windSpeed >= $windSpeed1)
                    {      
                        Mail::to($user->email)->send(new ForecastMessage($forecast)); 
                        return redirect('inform')->with('success', 'Pagal jūsų pageidavimus artimiausiu laikotarpiu prognozuojamas vėjo stiprumas bus '.$forecast->forecastTimeUtc.' laiku. Taip pat buvo išsiųstas pranešimas jums į el. paštą.');
                    }
                }
                
                if($windSpeedTrend1 == 'less')
                {
                    if($forecast->windSpeed <= $windSpeed1)
                    {
                        Mail::to($user->email)->send(new ForecastMessage($forecast)); 
                        return redirect('inform')->with('success', 'Pagal jūsų pageidavimus artimiausiu laikotarpiu prognozuojamas vėjo stiprumas bus '.$forecast->forecastTimeUtc.' laiku. Taip pat buvo išsiųstas pranešimas jums į el. paštą.');
                    }
                }

                if($windSpeedTrend2 == 'more')
                {
                    if($forecast->windSpeed >= $windSpeed1)
                    {      
                        Mail::to($user->email)->send(new ForecastMessage($forecast)); 
                        return redirect('inform')->with('success', 'Pagal jūsų pageidavimus artimiausiu laikotarpiu prognozuojamas vėjo stiprumas bus '.$forecast->forecastTimeUtc.' laiku. Taip pat buvo išsiųstas pranešimas jums į el. paštą.');
                    }
                }
                
                if($windSpeedTrend2 == 'less')
                {
                    if($forecast->windSpeed <= $windSpeed1)
                    {
                        Mail::to($user->email)->send(new ForecastMessage($forecast)); 
                        return redirect('inform')->with('success', 'Pagal jūsų pageidavimus artimiausiu laikotarpiu prognozuojamas vėjo stiprumas bus '.$forecast->forecastTimeUtc.' laiku. Taip pat buvo išsiųstas pranešimas jums į el. paštą.');
                    }
                }



            }




            /*if($windSpeedTrend == 'daugiau')
            {
                if($forecast->windSpeed >= $windSpeed1 || $forecast->windSpeed >= $windSpeed2)
                {      
                    Mail::to($user->email)->send(new ForecastMessage($forecast)); 
                    return redirect('inform')->with('success', 'Pagal jūsų pageidavimus artimiausiu laikotarpiu prognozuojamas vėjo stiprumas bus '.$forecast->forecastTimeUtc.' laiku. Taip pat buvo išsiųstas pranešimas jums į el. paštą.');
                }
            }
            else if($windSpeedTrend == 'maziau')
            {
                if($forecast->windSpeed <= $windSpeed1 || $forecast->windSpeed <= $windSpeed2)
                {
                    Mail::to($user->email)->send(new ForecastMessage($forecast)); 
                    return redirect('inform')->with('success', 'Pagal jūsų pageidavimus artimiausiu laikotarpiu prognozuojamas vėjo stiprumas bus '.$forecast->forecastTimeUtc.' laiku. Taip pat buvo išsiųstas pranešimas jums į el. paštą.');
                }
            }*/
            
        }


        return redirect('inform')->with('error', 'Nebuvo rasta tokių vėjo prognozių artimuoju metu.');
        //return view('user.inform');
    }

    public function report()
    {
        return view('user.report');
    }
    
    public function reportSubmit()
    {
        return view('user.report');
    }

    
}