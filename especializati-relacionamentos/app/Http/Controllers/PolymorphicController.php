<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class PolymorphicController extends Controller
{
    public function polymorphics()
    {
        $city = City::first();

        $comments = $city->comments;

        foreach ($comments as $comment) {
            echo $comment->description . '<br/>';
        }
    }

    public function polymorphicInsert()
    {
        // Country
        // $country = Country::find(1);

        // $comment = $country->comments()->create([
        //     'description' => 'Novo comentário ' . date('Ymd-his')
        // ]);


        // State
        // $state = State::first();

        // $comment = $state->comments()->create([
        //     'description' => 'Novo Comentário . ' . date('Y-s')
        // ]);

        // City
        $city = City::first();

        $comment = $city->comments()->create([
            'description' => 'Novo comentário . ' . date('Y-s')
        ]);

        echo $comment->description;
    }
}
