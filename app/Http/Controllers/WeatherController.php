<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Http\Factory\Guzzle\RequestFactory;
use Rawaby88\OpenWeatherMap\Services\CWByZipCode;



class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($zip_code)
    {

        $weather=Weather::latest()->where('zip_code',$zip_code)->first();

        if($weather==null || strtotime(now())-strtotime($weather->updated_at)>900){
            $cw = (new CWByZipCode($zip_code, config('app.language')))->get();
            $weather=new Weather();
            $weather->zip_code=$zip_code;
            $weather->min_temperature=$cw->temperature->tempMin;
            $weather->max_temperature=$cw->temperature->tempMax;
            $weather->actual_temperature=$cw->temperature->temp;
            $weather->weather=$cw->weather->description;
            $weather->save();

            dump($weather->toJson(JSON_PRETTY_PRINT));
        } elseif(strtotime(now())-strtotime($weather->updated_at)<900){
            echo('vous avez regardez la météo il ya moins de 15 minutes');
            dump($weather->toJson(JSON_PRETTY_PRINT));
        }







    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
