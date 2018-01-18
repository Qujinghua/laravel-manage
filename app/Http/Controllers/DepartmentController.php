<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class DepartmentController extends Controller {
  public function getDepartment () {
    try {
      $department = DB::select('select * from laravel_manage_department');
      return Response::json($department);
    } catch (Exception $e) {
        report($e);
        return false;
    }
  }
  public function updateDepartment (Request $request) {
    $name = $request->input('name');
    $address = $request->input('address');
    $action = $request->input('action');
    if($action == 'add') {
      $addDepartment = DB::table('laravel_manage_department')->insert(
        ['name' => $name, 'address' => $address]
      );
      if($addDepartment) {
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