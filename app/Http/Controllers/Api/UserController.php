<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class UserController extends Controller
{
  use Helpers;
  
  public function getUser()
  {
    try {
      $user = DB::select('select * from laravel_manage_user');
      return Response::json($user);
      // return is_array($user);

    } catch (Exception $e) {
        report($e);
        return false;
    }



    // $bool = DB::insert('insert into laravel_manage_user(name, phone, email, pwd, isSuperAdmin) values(?, ?, ?, ?, 0)',
    // ['周', 10000, 'wanger@qq.com', '12345678']);
    //  var_dump($bool);

    // $update = DB::update('update laravel_manage_user set name = ?, phone = ?, email = ?, pwd = ?, isSuperAdmin = ? where id = ?',
    // ['张三', 10086, 'zhangsan@qq.com', '12345678', 1, 1]);
    // var_dump($update);

    // $delete = DB::delete('delete from laravel_manage_user where id = ?',[4]);
    // var_dump($delete);

  }
  public function userLogin(Request $request)
  {
    $username = $request->input('username');
    $pwd = $request->input('pwd');
    $userList = DB::select('select * from laravel_manage_user');
    $isUser = DB::table('laravel_manage_user')->whereRaw('name = ? or phone = ? or email = ?',[$username,$username,$username])->get();
    return $isUser;
    // foreach($userList as $el) {
    //   if ($el['name'] == $username || $el['phone'] == $username || $el['email'] == $username) {
    //     $userData = [
    //       'id' => $el['id'],
    //       'name' => $el['name'],
    //       'phone' => $el['phone'],
    //       'email' => $el['email'],
    //       'isSuperAdmin' => $el['isSuperAdmin'],
    //     ];
    //     return Response::json($userData);
    //   } else {
    //     return false;
    //   }

    // }
    // if ($thisUser['pwd'] == $pwd) {
    //   $thisUserData = [
    //     'id' => $thisUser['id'],
    //     'name' => $thisUser['name'],
    //     'phone' => $thisUser['phone'],
    //     'email' => $thisUser['email'],
    //     'isSuperAdmin' => $thisUser['isSuperAdmin'],
    //   ];
    //   return Response::json($thisUserData);
    // } else {
    //   $thisUserData = [
    //     'message' => "用户名或密码错误！"
    //   ];
    //   return Response::json($thisUserData);
    // }
    
  }


}