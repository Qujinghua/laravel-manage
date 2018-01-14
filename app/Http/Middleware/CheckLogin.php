<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Response;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,Closure $next)
    {
        if (empty(session("id"))){
          $response = [
            'message' => "请登录",
            'status' => "401"
          ];
          return Response::json($response);
            // $user = session('username');
            // $openid = $user['id'];
            // $result = WxStudent::check_boundwechat($openid);
            // if ($result=='200'){
            //     return $next($request);
            // }else{
            //     return response("请登录", 403)->header("X-CSRF-TOKEN", csrf_token());
            // }
        } else if(!empty(session("id"))) {
          // return '存在';
          return $next($request);
        }
    }
}