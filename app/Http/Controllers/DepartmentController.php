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
    try {
      $addDepartment = DB::table('laravel_manage_department')->insert(
        ['name' => $name, 'address' => $address]
      );
      $response = [
        'message' => '新增成功',
        'status' => 200
      ];
      return Response::json($response);
    } catch (Exception $e) {
      report($e);
      return false;
    }
  }




}