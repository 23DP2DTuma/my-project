<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with(['car.carModel.manufacturer', 'car.mainImage'])
            ->latest() 
            ->get();

        return response()->json($favorites);
    }

    /*
    Toogle - add/remove car from favorites*/

    public function toggle($carId)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('car_id', $carId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Noņemts no izlases',
            ]);
        }

        Favorite::create([
            'user_id' => Auth::id(),
            'car_id' => $carId,
        ]);

        return response()->json([
            'status' => 'added',
            'message' => 'Pievienots izlasei',
        ]);
    }
}
