<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Storage;

class GoodsController extends Controller
{

  // 文件上传方法
  public function upload(Request $request)
  {
    if (!$request->hasFile('file')) {
      return response()->json([], 500, '无法获取上传文件');
    }
    $file = $request->file('file');
 
    if ($file->isValid()) {
      // 获取文件相关信息
      $originalName = $file->getClientOriginalName(); // 文件原名
      $ext = $file->getClientOriginalExtension();   // 扩展名
      $realPath = $file->getRealPath();  //临时文件的绝对路径
      $type = $file->getClientMimeType();   // image/jpeg
 
      // 上传文件
      $filename = date('Ymd');
      // 使用我们新建的uploads本地存储空间（目录）
      $path = $file->store($filename, 'uploads');
      return response()->json([
        'status_code' => 200,
        'message' => 'success',
        'photo' => $path,
        'name' => $originalName,
      ]);
 
    } else {
      return response()->json([], 500, '文件未通过验证');
    }

    return view('upload');
  }
  // 删除文件
  public function deleteFile(Request $request)
    {
      // $del_file = $request->get('del_file');
      // $path = $request->get('folder').'/'.$del_file;
      $path = $request->get('file');
      // var_dump($path);
      // return response()->json([
      //   'status_code' => 200,
      //   'message' => 'success',
      //   'photo' => $path
      // ]);
      // $result = $this->$manager->deleteFile($path);
      $result = Storage::disk('uploads')->delete($path);

      if ($result === true) {
          return redirect()
              ->back()
              ->withSuccess("File '$path' deleted.");
      }

      $error = $result ? : "An error occurred deleting file.";
      return redirect()
          ->back()
          ->withErrors([$error]);
    }
}
// class DepartmentController extends Controller {
//   public function getDepartment () {
//     try {
//       $department = DB::select('select * from laravel_manage_department');
//       return Response::json($department);
//     } catch (Exception $e) {
//         report($e);
//         return false;
//     }
//   }
//   public function updateDepartment (Request $request) {
//     $name = $request->input('name');
//     $address = $request->input('address');
//     $action = $request->input('action');
//     if($action == 'add') {
//       $addDepartment = DB::table('laravel_manage_department')->insert(
//         ['name' => $name, 'address' => $address]
//       );
//       if($addDepartment) {
//         $response = [
//           'message' => '新增成功',
//           'status' => 200
//         ];
//         return Response::json($response);
//       } else {
//         $response = [
//           'message' => '新增失败',
//           'status' => 403
//         ];
//         return Response::json($response);
//       }
//     } else if($action == 'edit') {
//       $id = $request->input('id');
//       $updateDepartment = DB::update('update laravel_manage_department set name = ?, address = ? where id = ?',
//       [$name, $address, $id]);
//       if($updateDepartment) {
//         $response = [
//           'message' => '编辑成功',
//           'status' => 200
//         ];
//         return Response::json($response);
//       } else {
//         $response = [
//           'message' => '编辑失败',
//           'status' => 403
//         ];
//         return Response::json($response);
//       }
      
//     }
    
//   }
//   public function delDepartment (Request $request) {
//     $id = $request->input('id');
//     $delDepartment = DB::delete('delete from laravel_manage_department where id = ?',[$id]);
//     if($delDepartment) {
//       $response = [
//         'message' => '删除成功',
//         'status' => 200
//       ];
//       return Response::json($response);
//     } else {
//       $response = [
//         'message' => '删除失败',
//         'status' => 403
//       ];
//       return Response::json($response);
//     }
//   }




// }