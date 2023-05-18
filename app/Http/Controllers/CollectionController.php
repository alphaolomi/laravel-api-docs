<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function __invoke()
    {
        // Collection::macro('toUpper', function () {
        //     return $this->map(function ($value) {
        //         return Str::upper($value);
        //     });
        // });

        // $collection = collect(['first', 'second']);

        // $upper = $collection->toUpper();

        // return $upper;
        $data =[
            ['name' => 'Desk', 'price' => 200],
            ['name' => 'Chair', 'price' => 100],
            ['name' => 'Bookcase', 'price' => 150],
            ['name' => 'Door', 'price' => 100],
        ];
        $collection = collect($data);

        $filtered = $collection->where('price', 100);

        return response()->json($filtered->toArray());
        // return response()->json($data);
    }
}
