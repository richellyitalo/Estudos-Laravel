<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

class OneToManyController extends Controller
{
    public function oneToMany(Country $country)
    {
        // $country = $country->where('name', 'like', '%ap%')->get()->first();

        // $states = $country->states;

        $countries = $country->with('states')->get();

        foreach ($countries as $country) {
            echo "<strong>{$country->name}</strong><hr/>";
            
            foreach ($country->states as $state) {
                echo "{$state->initials} - {$state->name} ==>> {$state->country->name}<br/>";
            }
            echo "<hr/>";
        }
    }

    public function oneToManyTwo(Country $country)
    {
        // $country = $country->where('name', 'like', '%ap%')->get()->first();

        // $states = $country->states;

        $countries = $country->with('states')->get();

        foreach ($countries as $country) {
            echo "<strong>{$country->name}</strong><hr/>";
            foreach ($country->states as $state) {
                echo "{$state->initials} - {$state->name} ==>> {$state->country->name}. Cidades: ";
                foreach ($state->cities as $city) {
                    echo $city->name . ', ';
                }
                echo "<br/>";
            }
            echo "<hr/>";
        }
    }

    public function oneToManyInsert()
    {
        // $dataForm = [
        //     'name' => 'Acre',
        //     'initials' => 'AC',
        //     'country_id' => 2
        // ];

        // $state = State::create($dataForm);


        $dataForm = [
            'name' => 'Belo Horizonte',
            'initials' => 'BH'
        ];

        $country = Country::find(2);

        $state = $country->states()->create($dataForm);

        dd($state->toArray());
    }

    public function hasManyThrough()
    {
        $country = Country::where('name', 'like', '%brasil%')->get()->first();

        echo "<h2>{$country->name}</h2>";
        echo "Cidades: ";

        foreach ($country->cities as $city) {
            echo $city->name . ', ';
        }

        echo "<br/>Total de cidades: {$country->cities->count()}";
    }
}
