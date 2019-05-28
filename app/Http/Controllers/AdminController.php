<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\buses;
use App\buses_detail;
use App\place;
use App\ticket_info;
use App\passenger_profile;
use App\car;
use App\route;
use App\role;
use Carbon\Carbon;

use Auth;
use Hash;
use App\User;
use Session;

class AdminController extends Controller
{
    //
  public function createDataNext()
  {
    $month =  date ('m') + 1;
    if($this->checkCreateData($month) == false){
      session()->flash('success_message', 'Dữ liệu tháng sau đã có sẵn!');
      return redirect()->back();
    }
    createData($month);
    session()->flash('success_message', 'Tạo dữ liệu thành công');
    return redirect()->back();
  }

  public function checkCreateData($month)
  {
    $strmonth = ($month < 10) ? '0'.$month : $month;
    $check = DB::table('buses_detail')
                ->whereRaw("buses_detail.buses_departure_date like '%-".$strmonth."-%'")
                ->first();
    if(isset($check)){
      return false;
    }
    return true;
  }
  public function createDataThis()
  {
    $month =  date ('m')+0;

    if($this->checkCreateData($month) == false){
      session()->flash('success_message', 'Dữ liệu tháng này đã có sẵn!');
      return redirect()->back();
    }
    $this->createData($month);
    session()->flash('success_message', 'Tạo dữ liệu thành công');
    return redirect()->back();
  }
  public function createData($month)
  {
    $year = ($month == 13) ? date('Y')+1 : date('Y');
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    
    $listBuses = DB::table('buses')
    ->join('car', 'car.car_id', '=', 'buses.car_id')
    ->get();
    $arrayBuses = array();
    foreach ($listBuses as $buses) {
      $arrayBuses[$buses->buses_id] = $buses->total_seats;
    }
    $insert_data = array();
    for ($i=1; $i <= $days; $i++) { 
      foreach ($arrayBuses as $key => $value) {
        $data = [
                  'buses_departure_date' => $year . '-' . $month . '-' . $i,
                  'buses_id' => $key,
                  'available_seats' => $value
        ];
        $insert_data[] = $data;
      }
    }
    $insert_data = collect($insert_data);
    $chunks = $insert_data->chunk(200);
    foreach ($chunks as $chunk) {
      \DB::table('buses_detail')->insert($chunk->toArray());
    }
  }



  public function postLogin(Request $req){
    $this->validate($req,
      [
        'email'=>'required|email',
        'password'=>'required|min:4|max:20'
      ],
      [
        'email.required'=>'Vui lòng nhập email',
        'email.email'=>'Email không đúng định dạng',
        'password.required'=>'Vui lòng nhập password',
        'password.min'=>'Mật khẩu phải có độ dài ít nhất 6 ký tự',
        'password.max'=>'Mật khẩu phải có độ dài không quá 20 ký tự'
      ]);

    $credentials = array('email'=>$req->email,'password'=>$req->password);
    if(Auth::attempt($credentials)){
      return redirect()->route('admin');
    }
    else{
      return redirect()->back()->with(['warn'=>'Email hoặc mật khẩu không chính xác']);
    }
  }

  public function getBusesDetail($value='')
  {
    $tbl_buses_detail = buses_detail::all();
    return view('admin-page.buses-detail', compact('tbl_buses_detail'));
  }

  public function getLogin(){
    // User::create([
    //     'name' => 'giang tuấn',
    //     'email' => 'giangtuan6199@gmail.com',
    //     'password' => Hash::make('admin'),
    //     'role_id' => 1,
    //   ]);
    return view('admin-page.login');
  }

  public function getLogout()
  {
    Auth::logout();
    return redirect()->route('login');
  }

  public function getAdmin(){
   $tbl_ticket = ticket_info::all();
   $tbl_ticket_detail = DB::table('ticket_info')
   ->select('ticket_info.*', 'p1.place_name as departure_name', 'p2.place_name as destination_name', 'pp.*', 'b.*', 'r.price')
   ->leftjoin('passenger_profile as pp', 'ticket_info.passenger_id', '=', 'pp.passenger_id')
   ->leftjoin('buses as b','ticket_info.buses_id', '=', 'b.buses_id')
   ->leftjoin('route as r', 'r.route_id', '=', 'b.route_id')
   ->leftjoin('place as p1', 'r.departure', '=', 'p1.place_id')
   ->leftjoin('place as p2', 'r.destination', '=', 'p2.place_id')
   ->get();
   // print_r($tbl_ticket_detail);
   // exit();
   if (Auth::check()){
    return view('admin-page.dashboard', compact('tbl_ticket_detail'));
  }
  else{
    return redirect()->route('login');
  }
}

public function getTicketTable()
{
 $tbl_ticket = ticket_info::all();
 return view('admin-page.ticket-table', compact('tbl_ticket'));
}

public function getrouteTable()
{
 $tbl_route = route::all();
 return view('admin-page.route', compact('tbl_route'));
}

public function getbusesTable()
{
 $tbl_buses = buses::all();
 $tbl_car = car::all();
 $tbl_route = route::all();
 return view('admin-page.buses-table', compact('tbl_buses', 'tbl_route', 'tbl_car'));
}

public function getplaceTable()
{
  if(Auth::check()){
 $tbl_place = place::all();
 return view('admin-page.place-table', compact('tbl_place'));
}
   return view('admin-page.login');
}

public function getPassengerTable()
{
  if(Auth::check()){
    $tbl_passenger = passenger_profile::all();
    return view('admin-page.passenger-table', compact('tbl_passenger'));
  }
  return view('admin-page.login');
}
public function getUser()
{
  if(Auth::check() && Auth::user()->role_id == 1){
    $tbl_user = DB::table('users')->join('role', 'role.role_id', '=', 'users.role_id')->get();
    $tbl_role = DB::table('role')->get();
    return view('admin-page.user-table', compact('tbl_user', 'tbl_role'));
  }
  return redirect()->back();
}
}
