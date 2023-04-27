<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function getUser(Request $req){
        $latitude = $req->input('latitude');
        $longitude = $req->input('longitude');
        $distance = $req->input('distance');

        $distance = DB::table('users')
                ->select('id','name',DB::raw('( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance'))
                ->having('distance', '<=', $distance)
                ->orderBy('distance')
                ->setBindings([$latitude, $longitude, $latitude])
                ->get();

        return response()->json(["data"=>$distance]);
    }
}
