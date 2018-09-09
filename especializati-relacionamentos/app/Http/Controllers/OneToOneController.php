<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Location;

class OneToOneController extends Controller
{
    public function oneToOne(Country $country)
    {
        // Consulta direta ou indireta
        // $country = $country->find(1);
        $countryChina = $country->where('name', 'like', '%bra%')->get()->first();

        echo $countryChina->name;

        // 2 maneiras de recuperar o relacionamento
        // #1
        // $location = $countryChina->location;

        // #2
        $location = $countryChina->location()->get()->first();

        echo "<hr/>Lat: {$location->latitude}";
        echo "<br/>Lon: {$location->longitude}";
    }

    public function oneToOneInverse(Location $location)
    {
        $lat = '123';
        $lon = '321';

        $location = $location->where('latitude', $lat)
            ->where('longitude', $lon)
            ->get()
            ->first();
        
        echo "ID: {$location->id}";

        echo "<hr/>País: {$location->country->name}";
    }

    public function oneToOneInsert(Location $location, Country $country)
    {
        $dataForm = [
            'name' => 'Jamaica',
            'latitude' => '422',
            'longitude' => '224'
        ];

        $country = $country->create($dataForm);
        

        // Maneiras de salvar com associação
        // 1 via create
        $dataForm['country_id'] = $country->id;
        $location = $location->create($dataForm);

        // 2 via new
        // $location = new Location();
        // $location->latitude = $dataForm['latitude'];
        // $location->longitude = $dataForm['longitude'];
        // $location->country_id = $country->id;
        // $savedLocation = $location->save();

        // 3 create da tabela relacionada
        // $location = $country->location()->create($dataForm);
    }
}
