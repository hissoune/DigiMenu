<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;

class ClientController extends Controller
{
    public function getRestaurants(){
        $restaurants=Restaurant::all();
   
        return view("client.restaurants",compact("restaurants"));
    }
    public function getMenus($restaurant){
        $menus=Menu::where('restaurant_id',$restaurant);
        return view("client.menus",compact("menus"));
    }
}