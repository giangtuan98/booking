<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;
use DB;

class AjaxUserController extends Controller
{
	public function postAddUser(UserRequest $request){
    $this->validate($request,
        [
          'inputEmail'=>'unique:users,email'
        ],
        [
          'inputEmail.unique'=>'Email đã có người sử dụng'
        ]
      );
    	User::create([
    		'name' => $request->inputUserName,
    		'email' => $request->inputEmail,
    		'password' => Hash::make($request->inputUserPassword),
    		'role_id' => $request->selectRoleId,
    	]);
    	session()->flash('success_message', 'User successfully created!');
    	return response()->json(['success' => true]);
    }

    public function postDelUser(Request $req)
    {
      $user_id = $req->user_id;
      try{
        DB::table('users')->where('id', $user_id)->delete();
      }
      catch(\Exception $e){
        return response()->json(['success' => false]);
      }
      session()->flash('success_message', 'User successfully deleted!');
      return response()->json(array('success'=> true));
    }

    public function postUpdateUser(UserRequest $request)
    {
      
      DB::table('users')
            ->where([['id', '=', $request->user_id ],])
            ->update(['name' => $request->inputUserName, 
                      'role_id' => $request->selectRoleId,
                      'password' => Hash::make($request->inputUserPassword)
          ]);
      session()->flash('success_message', 'User successfully updated!'.$request->user_id);
      return response()->json(array('success'=> True)); 
    }
   
    public function postChangePassword(Request $request)
    {
      $this->validate($request,
        [
          'inputPassword'=>'required|min:6|max:20',
            'inputConfirmPassword'=>'required|same:inputPassword',
        ],
        [
          'inputPassword.required'=>'Vui lòng nhập mật khẩu',
            'inputConfirmPassword.same'=>'Mật khẩu không giống nhau',
            'inputPassword.min'=>'Mật khẩu phải có độ dài ít nhất 6 ký tự',
        ]
      );
      try{
        DB::table('users')
            ->where([['id', '=', $request->id ],])
            ->update(['password' => Hash::make($request->inputPassword) ]);
      }
      catch (\Exception $e){
        return response()->json(array('success'=> False));
      }
    session()->flash('success_message', 'Đổi mật khẩu thành công!');
    return response()->json(array('success'=> true));
  }
}
