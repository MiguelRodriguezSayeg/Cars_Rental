<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;
use \App\Car;
use \App\Location;

class CarsController extends Controller
{
    public function index(){
    	$categories=\App\Category::all();
    	return view('Categories.create')->withCategories($categories);
    }
    public function create(Request $request){
    	
    }
    public function available(Request $request){
        #var_dump($request->all());
        $data = [
            'categories'  => \App\Category::all(),
            'validation'   => $request->all()
        ];
        return view('Categories.available')->with($data);
    }
    public function store(Request $request){
    	/*
    	Car::create([
    		"brand"=>$_POST['brand'],
    		"model"=>$_POST['model'],
    		"year"=>$_POST['year'],
    		"category_id"=>$_POST['category_id']
    	]);
    	*/
    	Car::create($request->all());
    	


    }
    public function store_order(Request $request){
        $this->validate(request(), [
            'origin' => 'required',
            'destiny' => 'required',
            'reservation' => 'required',
            'return' => 'required',
        ]);

        return view('Categories.available')->with(request());

    }

    public function store_order2(Request $request){
        $origin=$_POST['origin'];
        $destiny=$_POST['destiny'];
        $reservation=$_POST['reservation'];
        $return=$_POST['return'];

        $condOrigin = isset($origin)&&!empty($origin);
        $condDestiny = isset($destiny)&&!empty($destiny);
        $condReservation = isset($reservation)&&!empty($reservation);
        $condReturn = isset($return)&&!empty($return);

        $data = [
            'categories'  => \App\Category::all(),
            'request'   => $request->all()
        ];

        if($condOrigin && $condDestiny && $condReservation && $condReturn){
            return view('Categories.available')->with($data);
        }
        else{
            $locations=\App\Location::all();
            return redirect('/reservations/')->withLocations($locations);
        }
    }

    public function show(){
    	
    }
    public function delete(){
    	$cars=\App\Car::all();
        return view('Categories.delete')->withCars($cars);
    }
}
