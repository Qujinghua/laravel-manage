<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
// use Dingo\Api\Routing\Helpers;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
  // use Helpers;
  
  public function getUser()
  {
    try {
      $user = DB::select('select * from laravel_manage_user');
      return Response::json($user);

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
    // if(empty($username)){  
    //   $username=Session::get('username');  
    // }  
    // if(empty($pwd)){  
    //   $pwd=Session::get('pwd');  
    // }  
    // Session::put('username',$username);  
    // Session::put('pwd',$pwd);  
    // Session::save();  
    // $userList = DB::select('select * from laravel_manage_user');

    $isUser = DB::table('laravel_manage_user')
    ->whereRaw('name = ? or phone = ? or email = ?',[$username,$username,$username])
    ->get();
    $isUser = json_decode($isUser, true);
    if (count($isUser)) {
      $isPwd = $isUser[0]["pwd"];
      if ($isPwd==$pwd) {
        $loginResponse = [
          'message' => '登录成功！',
          'status' => 200
        ];
        Session::put('username',$username);
        Session::put('id',$isUser[0]["id"]);  
        Session::save();  
        return Response::json($loginResponse);
      } else {
        $loginResponse = [
          'message' => '密码错误！',
          'status' => 401
        ];
        return Response::json($loginResponse);
      }
    } else {
      $Response = [
        'message' => '用户名错误！',
        'status' => 401
      ];
      return Response::json($Response);
    }
    
  }

  public static  function islogin(){  
    $username=Session::get('username');  
    $id=Session::get('id');  
    return session()->all();
    // if(!empty($username)&&!empty($pwd)){  
    //     if($key != 1234){  
    //         echo "没有权限";  
    //         exit;  
    //     }  
    // }else{  
    //     echo "没有权限";  
    //     exit;  
    // }  
  }  

  // 查询构造器数据库操作
  public function testDB() {
    // 插入返回bool值
    // $bool = DB::table('laravel_manage_user')->insert(
    //   ['name' => 'testDB', 'phone' => '100' ,'email' => '123@qq.com', 'isSuperAdmin' => '1']
    // );
    // var_dump($bool);

    // 插入返回插入自增ID
    // $id = DB::table('laravel_manage_user')->insertGetId(
    //   ['name' => 'testDB2', 'phone' => '100' ,'email' => '123@qq.com', 'isSuperAdmin' => '0']
    // );
    // var_dump($id);

    // 插入多条数据返回bool
    // $bool = DB::table('laravel_manage_user')->insert([
    //   ['name' => 'testDB6', 'phone' => '100' ,'email' => '123@qq.com', 'isSuperAdmin' => '0'],
    //   ['name' => 'testDB7', 'phone' => '100' ,'email' => '123@qq.com', 'isSuperAdmin' => '0']
    // ]);
    // var_dump($bool);


    // 更新数据(返回影响的行数)
    // $num = DB::table('laravel_manage_user')
    // ->where('id',8)
    // ->update(['name' => 'testDB4']);
    // var_dump($num);

    // 自增和自减(返回影响的行数)
    //所有phone字段自增1
    // $num = DB::table('laravel_manage_user')->increment('phone');
    //所有phone字段自增3
    // $num = DB::table('laravel_manage_user')->increment('phone', 3);
    //所有phone字段自减1
    // $num = DB::table('laravel_manage_user')->decrement('phone');
    //所有phone字段自减3
    // $num = DB::table('laravel_manage_user')->decrement('phone', 3);
    // 带条件的自增自减
    // $num = DB::table('laravel_manage_user')
    // ->where('id', 8)
    // ->increment('phone',5);
    // 自增自减的同时修改其他字段
    // $num = DB::table('laravel_manage_user')
    // ->where('id', 8)
    // ->increment('phone',5,['name'=>'testDB11']);
    // var_dump($num);

    // 删除数据
    // $num = DB::table('laravel_manage_user')
    // ->where('id' ,10)
    // ->delete();

    // $num = DB::table('laravel_manage_user')
    // ->where('id', '>=' ,8)
    // ->delete();

    // 删除整个表(不返回任何数据)
    // DB::table('laravel_manage_user')->truncate();


    // 查询
    // get()获取所有数据
    // $user = DB::table('laravel_manage_user')->get();
    // var_dump($user);

    // first()获取第一条数据
    // $user = DB::table('laravel_manage_user')->first();

    // $user = DB::table('laravel_manage_user')
    // ->orderBy('id','desc')
    // ->first();

    // where()按条件获取
    // $user = DB::table('laravel_manage_user')
    // ->where('id','>=',2)
    // ->get();

    // where()多个条件获取
    // $user = DB::table('laravel_manage_user')
    // ->whereRaw('id >= ? and phone > ?', [2, 10000])
    // ->get();

    // pluck()返回结果集中指定字段,也可以连通下标一起返回
    // $user = DB::table('laravel_manage_user')
    // ->whereRaw('id >= ? and phone > ?', [2, 100])
    // ->pluck('name','id');

    // lists()返回结果集中的指定字段，也可以连通下标一起返回(已被弃用)
    // $user = DB::table('laravel_manage_user')
    // ->whereRaw('id >= ? and phone > ?', [2, 100])
    // ->lists('name', 'id');

    // select()
    // $user = DB::table('laravel_manage_user')
    // ->select('id', 'name', 'email')
    // ->get();

    // chunk()分段获取
    // DB::table('laravel_manage_user')
    // ->chunk(2, function($use) {
    //   var_dump($use);
    // });

    //聚合函数
    // count()返回数据条数
    // $user = DB::table('laravel_manage_user')->count();

    // max()返回最大的值
    // $user = DB::table('laravel_manage_user')->max('phone');

    // min()返回最小的值
    // $user = DB::table('laravel_manage_user')->min('phone');

    // avg()返回平均值
    // $user = DB::table('laravel_manage_user')->avg('phone');

    // sum()返回平均值
    // $user = DB::table('laravel_manage_user')->sum('phone');
    // var_dump($user);

  }


}