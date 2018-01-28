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


class CustomerController extends Controller
{
  public function getCustomer()
  {
    try {
      $page = input::get('page');
      $size = input::get('size');
      $keyword = input::get('keyword');
      $dataStart = ($page-1)*$size;
      // $user = DB::select("select name,phone,email,department,isSuperAdmin from laravel_manage_customer limit {$dataStart},{$size}");
      $customer = DB::table('laravel_manage_customer')
      ->select('*')
      ->where('customer_name', 'like', $keyword.'%')
      ->orWhere('customer_contacts', 'like', $keyword.'%')
      ->offset($dataStart)
      ->limit($size)
      ->get();
      $count = DB::table('laravel_manage_customer')
      ->select('*')
      ->where('customer_name', 'like', $keyword.'%')
      ->orWhere('customer_name', 'like', $keyword.'%')
      ->count();
      $response = [
        'data' => $customer,
        'total' => $count
      ];
      return Response::json($response);
    } catch (Exception $e) {
        report($e);
        return false;
    }

  }
  public function updateCustomer (Request $request) {
    $inputDate = $request->input('inputDate');
    $user_name = $request->input('user_name');
    $customer_resources = $request->input('customer_resources');
    $customer_name = $request->input('customer_name');
    $customer_companynature = $request->input('customer_companynature');
    $customer_contacts = $request->input('customer_contacts');
    
    $customer_placenature = $request->input('customer_placenature');
    $customer_phone = $request->input('customer_phone');
    $customer_area = $request->input('customer_area');
    $customer_website = $request->input('customer_website');
    $customer_email = $request->input('customer_email');

    $moveDate = $request->input('moveDate');
    $company_tax_num = $request->input('company_tax_num');
    $company_open_bank = $request->input('company_open_bank');
    $company_open_account = $request->input('company_open_account');
    $company_address = $request->input('company_address');

    $receive_people = $request->input('receive_people');
    $project_leader = $request->input('project_leader');
    $project_leader_phone = $request->input('project_leader_phone');
    $project_leader_email = $request->input('project_leader_email');
    $design_company_name = $request->input('design_company_name');

    $design_people = $request->input('design_people');
    $design_people_phone = $request->input('design_people_phone');
    $design_people_email = $request->input('design_people_email');
    $project_address = $request->input('project_address');
    $demand_survey = $request->input('demand_survey');

    $action = $request->input('action');
    if($action == 'add') {
      $addCustomer = DB::table('laravel_manage_customer')->insert(
        ['inputDate' => $inputDate, 'user_name' => $user_name, 'customer_resources' => $customer_resources, 
        'customer_name' => $customer_name,         'customer_companynature' => $customer_companynature, 
        'customer_contacts' => $customer_contacts, 'customer_placenature' => $customer_placenature, 

        'customer_phone' => $customer_phone,       'customer_area' => $customer_area, 
        'customer_website' => $customer_website,   'customer_email' => $customer_email, 
        'moveDate' => $moveDate,                   'company_tax_num' => $company_tax_num, 

        'company_open_bank' => $company_open_bank, 'company_open_account' => $company_open_account, 
        'company_address' => $company_address,     'receive_people' => $receive_people, 
        'project_leader' => $project_leader,       'project_leader_phone' => $project_leader_phone, 

        'project_leader_email' => $project_leader_email, 'design_company_name' => $design_company_name, 
        'design_people' => $design_people, 'design_people_phone' => $design_people_phone, 
        'design_people_email' => $design_people_email, 'project_address' => $project_address, 
        'demand_survey' => $demand_survey
         ]
      );
      if($addCustomer) {
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
      $customer_id = $request->input('customer_id');
      $updateCustomer = DB::update('update laravel_manage_customer set 
      inputDate = ?,            user_name = ?,     customer_resources = ?, 
      customer_name = ?,        customer_companynature = ?, 
      customer_contacts = ?,    customer_placenature = ?, 
      customer_phone = ?,       customer_area = ?, 
      customer_website = ?,     customer_email = ?, 
      moveDate = ?,             company_tax_num = ?, 
      company_open_bank = ?,    company_open_account = ?, 
      company_address = ?,      receive_people = ?, 
      project_leader = ?,       project_leader_phone = ?, 
      project_leader_email = ?, design_company_name = ?, 
      design_people = ?,        design_people_phone = ?, 
      design_people_email = ?,  project_address = ?, 
      demand_survey = ? where customer_id = ?',
      [$inputDate, $user_name,  $customer_resources, 
      $customer_name,        $customer_companynature, 
      $customer_contacts,    $customer_placenature, 
      $customer_phone,       $customer_area, 
      $customer_website,     $customer_email, 
      $moveDate,             $company_tax_num,
      $company_open_bank,    $company_open_account, 
      $company_address,      $receive_people, 
      $project_leader,       $project_leader_phone, 
      $project_leader_email, $design_company_name, 
      $design_people,        $design_people_phone, 
      $design_people_email,  $project_address, 
      $demand_survey,        $customer_id]);
      if($updateCustomer) {
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
  public function delCustomer (Request $request) {
    $customer_id = $request->input('customer_id');
    $delCustomer = DB::delete('delete from laravel_manage_customer where customer_id = ?',[$customer_id]);
    if($delCustomer) {
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