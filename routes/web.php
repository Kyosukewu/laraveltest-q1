<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MvimController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\BottomController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//路由越確定之規則放置越上面


// Route::get('/', function () {
//     return view('welcome');
// });
//Route::view('/','welcome',['name'=>'Yuan']);//傳遞資料至視圖寫法
Route::view('/','home'); //回傳一個靜態頁面 view只傳視圖
// Route::view('/admin','backend/title');
// Route::view('admin','backend.module',['header'=>'網站標題管理','module'=>'Title']);

Route::redirect('/admin','admin/title');//redirect 重新導向至...

// Route::view('/admin/title','backend.title'); 

//Route::get('{dest}',['homeController::class','doSomething']); //傳遞一個參數至 homeController 的 doSomething 方法

//群組路由 宣告prefix 所有prefix開頭的文件將引導至...
// Route::prefix('admin')->group(function(){
    //     Route::view('/','backend.title');
    //     Route::view('/title','backend.title');
    //     Route::view('/ad','backend.ad');
    // });
    
// Route::get('/admin/{module}',function($module){
//     switch($module){
//         case "title":
//             return view('backend.module',['header'=>'網站標題管理','module'=>'Title']);
//         break;
//         case "ad":
//             return view('backend.module',['header'=>'動態文字廣告管理','module'=>'Ad']);
//         break;
//         case "image":
//             return view('backend.module',['header'=>'校園映像圖片管理','module'=>'Image']);
//         break;
//         case "mvim":
//             return view('backend.module',['header'=>'動畫圖片管理','module'=>'Mvim']);
//         break;
//         case "total":
//             return view('backend.module',['header'=>'進站人數管理','module'=>'Total']);
//         break;
//         case "bottom":
//             return view('backend.module',['header'=>'頁尾版權管理','module'=>'Bottom']);
//         break;
//         case "news":
//             return view('backend.module',['header'=>'最新消息管理','module'=>'News']);
//         break;
//         case "admin":
//             return view('backend.module',['header'=>'管理者管理','module'=>'Admin']);
//         break;
//         case "menu":
//             return view('backend.module',['header'=>'選單管理','module'=>'Menu']);
//         break;
//     }
// }); 

//Route::get('admin',[TitleController::class,'index']);//寫死方式,上方先use此controller路徑,執行TitleController中的index方法

Route::prefix('admin')->group(function(){
    Route::get('/ad',[AdController::class,'index']);
    Route::get('/title',[TitleController::class,'index']);
    Route::get('/image',[ImageController::class,'index']);
    Route::get('/mvim',[MvimController::class,'index']);
    Route::get('/total',[TotalController::class,'index']);
    Route::get('/bottom',[BottomController::class,'index']);
    Route::get('/news',[NewsController::class,'index']);
    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/menu',[MenuController::class,'index']);
});


//modal
Route::view('/modals/addTitle','modals.base_modal',['modal_header'=>'新增網站標題']);
Route::view('/modals/addAd','modals.base_modal',['modal_header'=>'新增動態廣告文字']);
Route::view('/modals/addImage','modals.base_modal',['modal_header'=>'新增校園映像圖片']);
Route::view('/modals/addMvim','modals.base_modal',['modal_header'=>'新增動畫圖片']);
Route::view('/modals/addNews','modals.base_modal',['modal_header'=>'新增最新消息']);
Route::view('/modals/addAdmin','modals.base_modal',['modal_header'=>'新增管理者帳號']);
Route::view('/modals/addMenu','modals.base_modal',['modal_header'=>'新增主選單']);
