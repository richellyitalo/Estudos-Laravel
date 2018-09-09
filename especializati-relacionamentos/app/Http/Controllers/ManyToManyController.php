<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Company;

class ManyToManyController extends Controller
{
    public function manyToMany()
    {
        $termSearch = 'tibau';
        $city = City::where('name', 'like', "%{$termSearch}%")->get()->first();

        echo "{$city->name} <hr />";

        $companies = $city->companies;

        foreach ($companies as $company) {
            echo $company->name . ' | ';
        }
    }

    public function manyToManyInverse()
    {
        $company = Company::find(1);

        echo "{$company->name} <hr />";

        $cities = $company->cities;

        foreach ($cities as $city) {
            echo $city->name . ' | ';
        }
    }

    public function manyToManyInsert()
    {
        $formData = [1, 2, 3];

        $company = Company::find(1);

        // $company->cities()->attach($formData);
        // $company->cities()->detach([1, 2, 3]);
        $company->cities()->sync($formData);

        $cities = $company->cities;
        foreach ($cities as $city) {
            echo $city->name . ' | ';
        }
    }
}
