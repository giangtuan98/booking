<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlaceRequest;
use App\Http\Requests\RouteRequest;
use App\Http\Requests\BusesRequest;
use App\Http\Requests\InfoRequest;
use App\place;
use App\route;
use App\buses;
use Validator;
use Auth;
use DB;

class AjaxController extends Controller
{


  public function postDelBuses(Request $request)
  {
    if(Auth::check() && Auth::user()->role_id != 1){
      return response()->json(array('success'=> false, 'msg' => 'Bạn cần đăng nhập với quyền admin'));
    }
    else{


    try{
      DB::table('buses')->where('buses_id', $request->buses_id)->delete();
    }
    catch (\Exception $e){
      return response()->json(array('success'=> false, 'msg' => 'Dữ liệu này đang được ràng buộc.'));
    }

    session()->flash('success_message', 'Route successfully deleted!');
    return response()->json(array('success'=> true));
  }
  }

  public function postUpdateBuses(BusesRequest $request)
  {
    try{
      DB::table('buses')
      ->where([['buses_id', '=', $request->buses_id ],])
      ->update(['buses_name' => $request->buses_name, 'depart_time' => $request->depart_time,
        'arrive_time'=> $request->arrive_time, 'route_id'=> $request->route_id, 'car_id'=>$request->car_id
      ]);
    }
    catch (\Exception $e){
      return response()->json(array('success'=> false));
    }
    session()->flash('success_message', 'Route successfully updated!');
    return response()->json(array('success'=> true));

  }

  public function postAddBuses(BusesRequest $request){
    $this->validate($request,[
      'buses_id' => 'unique:buses,buses_id',
      'buses_name' => 'unique:buses,buses_name'
    ],
    [
      'buses_id.unique' => 'Mã tuyến đã tồn tại',
      'buses_name.unique' => 'Tên tuyến đã tồn tại',
    ]);
    try{
      buses::create([
        'buses_id' => $request->buses_id,
        'buses_name' => $request->buses_name,
        'depart_time' => $request->depart_time,
        'arrive_time' => $request->arrive_time,
        'route_id' => $request->route_id,
        'car_id' => $request->car_id
      ]);
    }
    catch(\Exception $e){
      return response()->json(array('success'=> false));
    }
    session()->flash('success_message', 'Buses successfully created!');
    return response()->json(array('success'=> true)); 

  }

  public function postDelRoute(Request $request)
  {
    try{
      DB::table('route')->where('route_id', $request->route_id)->delete();
    }
    catch (\Exception $e){
      return response()->json(array('success'=> false));
    }
    session()->flash('success_message', 'Route successfully deleted!');
    return response()->json(array('success'=> true));
  }

  public function postUpdateRoute(RouteRequest $request)
  {
    try{
      DB::table('route')
      ->where([['route_id', '=', $request->route_id ],])
      ->update(['route_name' => $request->route_name, 'departure' => $request->departure,
        'destination'=> $request->destination, 'duration'=> $request->duration, 'price'=>$request->price
      ]);
    }
    catch(\Exception $e){
      return response()->json(array('success'=> false));
    }
    session()->flash('success_message', 'Route successfully updated!');
    return response()->json(array('success'=> true));
  }

  public function postAddRoute(RouteRequest $request){
    $this->validate($request,[
      'route_id' => 'unique:route,route_id',
      'route_name' => 'unique:route,route_name'
    ],
    [
      'route_id.unique' => 'Mã tuyến đã tồn tại',
      'route_name.unique' => 'Tên tuyến đã tồn tại',
    ]);
    route::create([
      'route_id' => $request->route_id,
      'route_name' => $request->route_name,
      'departure' => $request->departure,
      'destination' => $request->destination,
      'duration' => $request->duration,
      'price' => $request->price
    ]);
    session()->flash('success_message', 'Route successfully created!');
    return response()->json(array('success'=> true)); 
  }

  public function postAddPlace(PlaceRequest $request){
    $this->validate($request,[
      'place_id' => 'unique:place,place_id'
    ],
    [
      'place_id.unique' => 'Mã điểm đã tồn tại',
    ]);
    place::create([
      'place_id' => $request->place_id,
      'place_name' => $request->place_name,
    ]);
    session()->flash('success_message', 'Place successfully created!');
    return response()->json(['success' => true]);
  }

  public function postDelPlace(Request $req)
  {
    try{
      DB::table('place')->where('place_id', $req->place_id)->delete();
    }catch(\Exception $e){
      return response()->json(['success' => false]);
    }
    session()->flash('success_message', 'Place successfully deleted!');
    return response()->json(['success' => true]);
  }

  public function postUpdatePlace(PlaceRequest $request)
  {
    DB::table('place')
    ->where([['place_id', '=', $request->place_id ],])
    ->update(['place_name' => $request->place_name]);
    session()->flash('success_message', 'Place successfully updated!');
    return response()->json(['success' => true]);
  }
}
