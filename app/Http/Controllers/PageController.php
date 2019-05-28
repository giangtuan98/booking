<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Mail;
use DB, Mail, Auth, Hash;
use App\Mail\SendMail;
use App\buses;
use App\route;
use App\place;
use App\ticket_info;
use App\passenger_profile;
use App\buses_detail;
use Carbon\Carbon;
use App\User;
use Session;
use Illuminate\Support\Str;
class PageController extends Controller
{
        

    public function getIndex()
    {
        Session::put('step', 'step1');
        return view('page.index');
    }
    public function getHuongDanMuaVe()
    {
    	return view('page.huong-dan-mua-ve');
    }

    public function getPriceTable()
    {
        $departure_id = 1;
        $date = Carbon::now()->addDays(1)->format('Y-m-d');
        
        $prices = $this->dataPrice($departure_id, $date);
        return view('page.price-table', compact(['prices', 'departure_id', 'date']));
    }

    public function postPriceTable(Request $req)
    {

        $departure_id = $req->departure;
        $date = date('Y-m-d', strtotime($req->date));
        $prices = $this->dataPrice($departure_id, $date);
        return view('page.price-table', compact(['prices', 'departure_id', 'date']));
    }

    public function dataPrice($departure, $date)
    {
        $prices = DB::table('route')
                        ->select('route.*', 'p2.place_name as destination_name', 'buses_departure_date')
                        ->join('place as p2', 'p2.place_id', '=', 'route.destination')
                        ->join('buses', 'buses.route_id', '=', 'route.route_id')
                        ->join('buses_detail as bd', 'bd.buses_id', '=', 'buses.buses_id')
                        ->where([
                            ['route.departure', '=', $departure],
                            ['buses_departure_date', '=', $date],
                        ])
                        ->get();
        $data = array();
        foreach ($prices as $key => $value) {
            $data[$value->destination] = $value;
        }
        return $data;
    }

    public function getBookingTicket()
    {  
        $step = 'step0';
        Session::put('step', 'step1');
        return view('page.booking', compact(['step']));
        // echo ('hello');
    }
    public function postBookingTicket(Request $req)
    {
        if(Session('step') == 'step4'){
            Session::put('step', 'step0');
            $step = 'step0';
            return  view('page.booking', compact(['step']));
        }
        $step = (isset($_POST['step'])) ? $_POST['step'] : 'step1' ;;
        // $destination = 0;
        // $departure = 0;
        // $des_dep = '';
        // $quantity = $req->quantity;
        // $date ;
        if(Session::has('cart') == true && $step != 'step1'){
            $cart = Session::get('cart');
            $destination = $cart['destination']['id'];
            $departure = $cart['departure']['id'];
            $quantity = $cart['quantity'];
            $date = $cart['date'];
        }
        else{
            $destination = $req->destination;
            $departure = $req->departure;
            $quantity = $req->quantity;
            $date = $req->date;
            $des = place::where('place_id',$destination)->get();
            $dep = place::where('place_id',$departure)->get();
            $cart = array('destination' => array('id'=>$destination, 'name'=>$des[0]['place_name']),
                        'departure' => array('id'=>$departure,  'name'=>$dep[0]['place_name']),
                        'quantity' => $quantity,
                        'date' => $date);
            if($step == 1){
                Session::forget('cart');
            }
            Session::put('cart', $cart);   
        }
        $datef = date('Y-m-d', strtotime($date));
        $shiftInfo = DB::table('buses')
                        ->join('route', 'buses.route_id', '=', 'route.route_id')
                        ->join('buses_detail', 'buses.buses_id', '=', 'buses_detail.buses_id')
                        ->where([
                            ['departure', $departure],
                            ['destination', $destination],
                            ['available_seats','>=', $quantity],
                            ['buses_departure_date', '=', $datef],
                        ])
                        ->get(array('buses.buses_id','buses_name','departure','depart_time','destination','duration','arrive_time','available_seats','price',));

        if($step == 'step3'){
            
            $data = array(  'name' => $_POST['customername'], 
                            'phone' => $_POST['phone'], 
                            'address' => $_POST['address'], 
                            'email' => $_POST['email']);  
            $ticket_id = $this->createTicketID();
            $customer_id = $this->saveCustomer($data);
            $detail = array('paymenttype'=>$_POST['paymenttype'],
                            'departure'=>$_POST['departure'],
                            'destination'=>$_POST['destination'],
                            'date'=>$_POST['date'],
                            'customername'=>$_POST['customername'],
                            'price'=>$_POST['price'],
                            'phone'=>$_POST['phone'],
                            'email'=>$_POST['email'],
                            'address'=>$_POST['address'],
                            'quantity'=>$_POST['quantity'],
                            'shift'=>$_POST['shift'],
                            'shift-id'=>$_POST['shift-id'],
                            'starttime'=>$_POST['starttime'],
                            'ticket_id'=>$ticket_id,
                        );
            // Gửi email thông tin vé xe
            $this->sendEmail($detail);

            // Lưu thông tin vé vào database
            $this->saveTicketInfo($ticket_id, $customer_id,$detail);
            // Lưu thông tin khách vào cookie
            $array_json = json_encode($data);
            $customerInfo = cookie('customerInfo', $array_json, 10000);
            Session::put('step', 'step4');
            return response()->view('page.booking', compact(['shiftInfo','step','detail']))->withCookie($customerInfo);
        }
        return view('page.booking', compact(['shiftInfo','step']));
    }

    function sendEmail($data){
        $data['viewName'] = 'email.blanks';
        $data['subject'] = 'Đặt vé thành công!';
        Mail::to($data['email'])->send(new SendMail($data));
    }

    public function saveCustomer($data)
    {
        $cus_id = DB::table('passenger_profile')
                    ->where([
                        ['name', $data['name']],
                        ['phone', $data['phone']],
                        ['address', $data['address']],
                        ['email', $data['email']],
                    ])
                    ->value('passenger_id');
        if(is_null($cus_id)){
            $cus_id = Str::random(6);
            $customer = new passenger_profile();
            $customer->passenger_id = $cus_id;
            $customer->name = $data['name'];
            $customer->address = $data['address'];
            $customer->phone = $data['phone'];
            $customer->email = $data['email'];
            $customer->save();
        }
        return $cus_id;
    }
    public function createTicketID()
    {
        $ticket_id = '';
        do{
            $ticket_id = Str::random(6);
            $count = DB::table('ticket_info')->where('ticket_id', $ticket_id)->count();
        }while($count > 0);
        return $ticket_id;
    }

    public function saveTicketInfo($ticket_id, $customer_id ,$detail){
        // Dinh dang lai ngay
        $datef = date('Y-m-d', strtotime($detail['date']));
        // Cap nhat thong tin so ghe trong cua chuyen xe

        $available_seats = buses_detail::where([
                                            ['buses_departure_date', $datef ],
                                            ['buses_id', '=', $detail['shift-id'] ],
                                                ])
                                        ->value('available_seats');
        DB::table('buses_detail')
            ->where([
                ['buses_departure_date', '=', $datef ],
                ['buses_id', '=', $detail['shift-id'] ],

            ])
            ->update(['available_seats' => $available_seats - $detail['quantity']]);                                    
        $ticket = new ticket_info();
        $ticket->ticket_id = $ticket_id;
        $ticket->passenger_id = $customer_id;
        $ticket->buses_id = $detail['shift-id'];
        $ticket->buses_departure_date = $datef;
        $ticket->quantity = $detail['quantity'];

        $ticket->save();
        
        Session::put('flag', false);
        Session::forget('cart');
    }
    // function setCookie($data){
    //     $response = new Response();
    //     if(\Cookie::has('customerInfo')){
    //         \Cookie::forget('customerInfo');
    //     }
    //     $array_json = json_encode($data);
    //     $response->withCookie('customerInfo', $array_json, 10000);
    //     return $response;
    // }
    // function getCookie(){
    //     if(\Cookie::has('customerInfo')){
    //         $name=\Cookie::get('customerInfo');
    //         $name = json_decode($name);
    //         print_r($name);
    //     }
    //     else{
    //         echo("don't");
    //     }
    // }
}
