<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::post("/user/{email}",[PostController::class, 'user_verify']);//done


 Route::controller(PostController::class)->prefix('admin')->group(function(){
   Route::post('/admin_register', 'admin_register'); //done
   Route::post('/admin_login', 'admin_login'); // done
   Route::post('/user_verify', 'user_verify');//done
 });

 Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    // 'create_job_role'

       Route::controller(PostController::class)->group(function(){
        Route::post('/admin_role_assign', 'admin_role_assign'); //done

        Route::get('/employee_search', 'employee_search')->where("search", "[a-zA-Z0-9- ]+"); //done
        Route::post('/create_job_role', 'create_job_role'); //done
        Route::delete('/delete_job_role', 'delete_job_role'); //done
        Route::get('/retrieve_total_roles', 'retrieve_total_roles'); //done
        Route::get('/retrieve_total_employee', 'retrieve_total_employee');//done
        Route::put('/fire_employee', 'fire_employee'); // done
        Route::get('/fetch_all_employee', 'fetch_all_employee');
        Route::get('/fetch_all_roles', 'fetch_all_roles');
       });
 });

