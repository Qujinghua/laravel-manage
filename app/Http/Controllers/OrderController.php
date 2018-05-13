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


class OrderController extends Controller
{
  public function getOrder()
  {
    try {
      $page = input::get('page');
      $signed = input::get('signed');
      if($page != '' && $signed == '') {
        $size = input::get('size');
        $keyword = input::get('keyword');
        $dataStart = ($page-1)*$size;
        // $user = DB::select("select name,phone,email,department,isSuperAdmin from laravel_manage_order limit {$dataStart},{$size}");
        $order = DB::table('laravel_manage_order')
        ->select('*')
        ->where('bill_order_num', 'like', '%'.$keyword.'%')
        ->offset($dataStart)
        ->limit($size)
        ->get();
        $customer = DB::table('laravel_manage_customer')
        ->get();
        $count = DB::table('laravel_manage_order')
        ->select('*')
        ->where('bill_order_num', 'like', '%'.$keyword.'%')
        // ->where('customer_name', 'like', '%'.$keyword.'%')
        // ->orWhere('customer_contacts', 'like', '%'.$keyword.'%')
        // ->orWhere('user_name', 'like', '%'.$keyword.'%')
        ->count();
      } else if($page != '' && $signed == 'yes') {
        $size = input::get('size');
        $keyword = input::get('keyword');
        $dataStart = ($page-1)*$size;
        $order = DB::table('laravel_manage_order')
        ->select('*')
        ->where('bill_order_num', 'like', '%'.$keyword.'%')
        ->offset($dataStart)
        ->limit($size)
        ->get();
        $customer = DB::table('laravel_manage_customer')
        ->get();
        $count = count($order);
      } else if($page == '' && $signed == 'yes') {
        $order = DB::table('laravel_manage_order')
        ->get();
        // $customer = json_decode($customer2,true);
        // $customer = array_filter($customer, function($el) {
        //   return $el['bill_order_num'] != null;
        // });
        $customer = DB::table('laravel_manage_customer')
        ->get();
        $count = count($customer);
      } else if($page == '' && $signed == '') {
        $order = DB::table('laravel_manage_order')
        ->get();
        $customer = DB::table('laravel_manage_customer')
        ->get();
        $count = DB::table('laravel_manage_order')
        ->count();
      }
      
      $response = [
        'order' => $order,
        'customer' => $customer,
        'total' => $count
      ];
      return Response::json($response);
    } catch (Exception $e) {
        report($e);
        return false;
    }

  }
  public function updateOrder (Request $request) {
    $action = $request->input('action');
    if($action=='bill' || $action == 'edit') {
      $customer_id = $request->input('customer_id');
      $bill_order_num = $request->input('bill_order_num');
      $bill_sale_date = $request->input('bill_sale_date');
      $bill_sale_money = $request->input('bill_sale_money');

      $bill_deliery_date = $request->input('bill_deliery_date');
      $bill_status = $request->input('bill_status');
    } else {
      $invoice_raise = $request->input('invoice_raise');
      $invoice_num = $request->input('invoice_num');
      $invoice_money = $request->input('invoice_money');
      $invoice_type = $request->input('invoice_type');
      $invoice_desc = $request->input('invoice_desc');
    }
    if($action == 'bill') {
      $addOrder = DB::table('laravel_manage_order')->insert(
        ['customer_id' => $customer_id,
        'bill_order_num' => $bill_order_num,         
        'bill_sale_date' => $bill_sale_date, 
        'bill_sale_money' => $bill_sale_money, 
        'bill_deliery_date' => $bill_deliery_date, 
        'bill_status' => $bill_status
         ]
      );
      if($addOrder) {
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
    } else if($action == 'edit') {
      $order_id = $request->input('order_id');
      $updateCustomer = DB::update('update laravel_manage_order set 
      order_id = ?, 
      bill_order_num = ?,        
      bill_sale_date = ?,    
      bill_sale_money = ?, 
      bill_deliery_date = ?, 
      bill_status = ?,              
      where order_id = ?',
      [$order_id,
      $bill_order_num,         
      $bill_sale_date,    
      $bill_sale_money,
      $bill_deliery_date, 
      $bill_status,             
      $order_id]);
      if($updateOrder) {
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
      
    } else if ($action == 'invoice') {
      $order_id = $request->input('order_id');
      $updateOrderInvoice = DB::update('update laravel_manage_order set 
      invoice_raise = ?,   invoice_num = ?,      
      invoice_money = ?,   invoice_type = ?, 
      invoice_desc = ? where order_id = ?',
      [$invoice_raise,     $invoice_num, 
      $invoice_money,      $invoice_type, 
      $invoice_desc,     $order_id]);
      if($updateOrderInvoice) {
        $response = [
          'message' => '保存成功',
          'status' => 200
        ];
        return Response::json($response);
      } else {
        $response = [
          'message' => '保存失败',
          'status' => 403
        ];
        return Response::json($response);
      }
    }
    
  }
  public function delOrder (Request $request) {
    $order_id = $request->input('order_id');
    $delOrder = DB::delete('delete from laravel_manage_order where order_id = ?',[$order_id]);
    if($delOrder) {
      $response = [
        'message' => '删除成功',
        'status' => 200
      ];
      return Response::json($response);
    } else {
      $response = [
        'message' => '删除失败',
        'status' => 403
      ];
      return Response::json($response);
    }
  }



}