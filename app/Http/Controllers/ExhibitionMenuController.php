<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ExhibitionMenuController extends Controller {
  public function getBigC () {
    try {
      $big = DB::select('select * from laravel_manage_big_classify');
      return Response::json($big);
    } catch (Exception $e) {
        report($e);
        return false;
    }
  }
  public function updateMenu (Request $request) {
    $action = $request->input('action');
    $big_name = $request->input('big_name');
    $big_notes = $request->input('big_notes');
    if($action == 'addBig') {
      $addBigC = DB::table('laravel_manage_big_classify')->insert(
        ['big_name' => $big_name, 'big_notes' => $big_notes]
      );
      if($addBigC) {
        $response = [
          'message' => '新增成功',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '新增失败',
          'status' => 401
        ];
        return Response::json($response);
      }
    } else if($action == 'edit') {
      $id = $request->input('id');
      $updateDepartment = DB::update('update laravel_manage_department set name = ?, address = ? where id = ?',
      [$name, $address, $id]);
      if($updateDepartment) {
        $response = [
          'message' => '编辑成功',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '编辑失败',
          'status' => 401
        ];
        return Response::json($response);
      }
      
    }
    
  }
  public function delDepartment (Request $request) {
    $id = $request->input('id');
    $delDepartment = DB::delete('delete from laravel_manage_department where id = ?',[$id]);
    if($delDepartment) {
      $response = [
        'message' => '删除成功',
        'status' => 200
      ];
      return Response::json($response);
    } else {
      $response = [
        'message' => '删除失败',
        'status' => 401
      ];
      return Response::json($response);
    }
  }




}