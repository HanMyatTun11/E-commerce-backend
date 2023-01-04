<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Api Route for login
Route::post('/login',[ApiController::class,'login']);
Route::post('/register',[ApiController::class,'register']);

// 1.Get All Categories with it subcats.
// 2.Get All Tags.
// 3.Get Paginated product.
// 4.Get Product by Category id.
// 5.Get Product by SubCategory id.
// 6.Get Product by Tag id.
// 7.Order upload.
// 8.Get my Order.
// 9.Get OrderItems.
// for Admin
// 1.See All orders
// 2.See all OrderItems

Route::get('cats',[ApiController::class,'cats']);
Route::get('subcats',[ApiController::class,'subcat']);
Route::get('subcat/{id}',[ApiController::class,'subcats']);
Route::get('tags',[ApiController::class,'tags']);
Route::get('tag/{id}',[ApiController::class,'productByTag']);
Route::get('products',[ApiController::class,'products']);
Route::get('pbc/{id}',[ApiController::class,'getProductByCategory']);
Route::get('pbs/{id}',[ApiController::class,'getProductBySubcat']);
Route::get('pbt/{id}',[ApiController::class,'getProductByTag']);

//With token
Route::group(['middleware'=>'jwt.auth'],function(){
  Route::get('me',[ApiController::class,'me']);
  Route::post('/order',[ApiController::class,'setOrder']);
  Route::get('/myorder',[ApiController::class,'myorder']);
  Route::get('/orderItems/{id}',[ApiController::class,'myOrderItems']);

});
