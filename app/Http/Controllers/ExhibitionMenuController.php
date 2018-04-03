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
  public function getBrandC () {
    try {
      $brand = DB::select('select * from laravel_manage_brand_classify');
      return Response::json($brand);
    } catch (Exception $e) {
        report($e);
        return false;
    }
  }
  public function getSmallC () {
    try {
      $small = DB::select('select * from laravel_manage_small_classify');
      return Response::json($small);
    } catch (Exception $e) {
        report($e);
        return false;
    }
  }
  public function updateMenu (Request $request) {
    $action = $request->input('action');
    
    if($action == 'addBig') {
      $big_name = $request->input('big_name');
      $big_notes = $request->input('big_notes');
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
          'status' => 403
        ];
        return Response::json($response);
      }
    } else if($action == 'editBig') {
      $big_name = $request->input('big_name');
      $big_notes = $request->input('big_notes');
      $big_id = $request->input('big_id');
      $updateBigC = DB::update('update laravel_manage_big_classify set big_name = ?, big_notes = ? where big_id = ?',
      [$big_name, $big_notes, $big_id]);
      if($updateBigC) {
        $response = [
          'message' => '编辑成功',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '编辑失败',
          'status' => 403
        ];
        return Response::json($response);
      }
      
    } else if($action == 'addSmall') {
      $small_name = $request->input('small_name');
      $big_id = $request->input('big_id');
      $small_notes = $request->input('small_notes');
      $addSmallC = DB::table('laravel_manage_small_classify')->insert(
        ['small_name' => $small_name, 'big_id' => $big_id, 'small_notes' => $small_notes]
      );
      if($addSmallC) {
        $response = [
          'message' => '新增成功',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '新增失败',
          'status' => 403
        ];
        return Response::json($response);
      }
    } else if($action == 'editSmall') {
      $small_name = $request->input('small_name');
      $big_id = $request->input('big_id');
      $small_notes = $request->input('small_notes');
      $small_id = $request->input('small_id');
      $updateSmallC = DB::update('update laravel_manage_small_classify set small_name = ?, big_id = ?, small_notes = ? where small_id = ?',
      [$small_name, $big_id, $small_notes, $small_id]);
      if($updateSmallC) {
        $response = [
          'message' => '编辑成功',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '编辑失败',
          'status' => 403
        ];
        return Response::json($response);
      }
      
    } else if($action == 'addBrand') {
      $brand_name = $request->input('brand_name');
      $big_id = $request->input('bigIdArr');
      $small_id = $request->input('smallIdArr');
      $brand_notes = $request->input('brand_notes');
      $addBrandC = DB::table('laravel_manage_brand_classify')->insert(
        ['brand_name' => $brand_name, 'big_id' => $big_id, 'small_id' => $small_id, 'brand_notes' => $brand_notes]
      );
      if($addBrandC) {
        $response = [
          'message' => '新增成功',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '新增失败',
          'status' => 403
        ];
        return Response::json($response);
      }
    }
    
  }
  public function delMenu (Request $request) {
    $action = $request->input('action');
    if($action == 'delBig') {
      $big_id = $request->input('big_id');
      $delBig = DB::delete('delete from laravel_manage_big_classify where big_id = ?',[$big_id]);
      if($delBig) {
        $response = [
          'message' => '删除成功！',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '删除失败！',
          'status' => 403
        ];
        return Response::json($response);
      }
    } else if($action == 'delSmall') {
      $small_id = $request->input('small_id');
      $delSmall = DB::delete('delete from laravel_manage_small_classify where small_id = ?',[$small_id]);
      if($delSmall) {
        $response = [
          'message' => '删除成功！',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '删除失败！',
          'status' => 403
        ];
        return Response::json($response);
      }
    }
  }




}