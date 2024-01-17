<?php

namespace App\Http\Controllers;

use App\Events\userevent;
use App\Http\Requests\admin_assign_req;
use App\Http\Requests\admin_login_request;
use App\Http\Requests\admin_register_req;
use App\Http\Requests\checkid;
use App\Http\Requests\create_job_role_req;
use App\Models\deletedjobs;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{


    public function admin_register(admin_register_req $request, User $user){

        $user->create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'employee_type'=>1,
            'comfirm_status'=>1,
            'status'=>'hired',
            'password'=>Hash::make($request->password)
        ]);
       if($user){
        $message ='you have succefully registered';
        $code = 200;
        $status = true;
        $user->res($message, $code, $status);
       }else{
        $message ='please enter the correct details';
        $code = 500;
        $status = false;
        $user->res($message, $code, $status);
       }

    }


    public function admin_login(admin_login_request $request, User $user){
      $user->where(['email'=>$request])->first();
      if($user && Hash::check($request->password, $user->password)){
        $token =  $user->createToken('my-app-token')->plainTextToken;
        $user->api_token = $token;
        $user->save();
        $data =['token'=>$token, 'firstname'=>$user->firstname, 'lastname'=>$user->lastname, 'email'=>$user->email, 'role'=>$user->employee_type, 'id'=>$user->id ];
        $message = $data;
        $code = 200;
        $status = true;
        $user->res($message, $code, $status);
      }else{
        $message ='please enter the correct details';
        $code = 500;
        $status = false;
        $user->res($message, $code, $status);
      }
    }


         public function admin_role_assign(User $user, admin_assign_req $request){
            if(Gate::allows("check-admin", auth()->user())){
                $user->create([
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname,
                    'email'=>$request->email,
                    'employee_type'=>2,
                    'status'=>'hired',
                ]);
               event(new userevent($user->firstname, $user->lastname, $user->email));
               $message ='you have create a user and assigned a role';
               $code = 200;
               $status = true;
               $user->res($message, $code, $status);
            }else{
                $message ='you have do not have access to this endpoint';
                $code = 403;
                $status = false;
                $user->res($message, $code, $status);
            }
           }


           public function user_verify($email, Request $request, User $user){
              try {
                $user->where(['email'=>$email])->first();
                if($user && $user->comfirm_status == 0){
                  $user->password = Hash::make($request->password);
                  $user->comfirm_status = 1;
                  $user->save();
                  $message ='you have verified and created your email';
                  $code = 200;
                  $status = true;
                  $user->res($message, $code, $status);
                }else{
                    $message ='your email has been approved before';
                  $code = 200;
                  $status = false;
                }
              } catch (\Throwable $th) {
                $message ='you did something wrong';
                $code = 200;
                $status = false;
                $user->res($message, $code, $status);
              }
           }


           public function employee_search(user $user, Request $request){
            if(Gate::allows("check-admin", auth()->user())){
            $data = $user->where('employee_type', '!=', 1)->search($request->get('search'))->take(5)->get();
            $message = $data;
            $code = 200;
            $status = true;
            $user->res($message, $code, $status);
            }else{
                $message ='you have do not have access to this endpoint';
                $code = 403;
                $status = false;
                $user->res($message, $code, $status);
            }
           }


           public function create_job_role(create_job_role_req $request, Role $role){
            if(Gate::allows("check-admin", auth()->user())){
           $role->create([
                'role'=>$request->role
            ]);

            $message = 'you just created a role';
            $code = 200;
            $status = true;
            $role->res($message, $code, $status);
            }else{
                $message ='you have do not have access to this endpoint';
                $code = 403;
                $status = false;
                $role->res($message, $code, $status);
            }
           }

           public function delete_job_role(checkid $request, Role $role){
            if(Gate::allows("check-admin", auth()->user())){
               $role->where(['id'=>$request->id])->delete();
               $message = 'job role has been deleted';
               $code = 200;
               $status = true;
               $role->res($message, $code, $status);
            }else{
                $message ='you have do not have access to this endpoint';
                $code = 403;
                $status = false;
                $role->res($message, $code, $status);
            }
           }


           public function retrieve_total_roles(Role $role){
            if(Gate::allows("check-admin", auth()->user())){
                $message = count($role->all());
               $code = 200;
               $status = true;
               $role->res($message, $code, $status);
            }else{
                $message ='you have do not have access to this endpoint';
                $code = 403;
                $status = false;
                $role->res($message, $code, $status);
            }
           }


           public function retrieve_total_employee(User $user){
            if(Gate::allows("check-admin", auth()->user())){
                $message = count($user->all());
                $code = 200;
                $status = true;
                $user->res($message, $code, $status);
            }else{
                $message ='you have do not have access to this endpoint';
                $code = 403;
                $status = false;
                $user->res($message, $code, $status);
            }
           }



           public function fire_employee(checkid $request, User $user){

            if(Gate::allows("check-admin", auth()->user())){
              $user->where([ 'employee_type' => '!=', 1,
              'id' => $request->id,
              'status' => 'fired'])->delete();
              $message = 'the employee has been fired';
              $code = 200;
              $status = true;
              $user->res($message, $code, $status);
            }else{
                $message ='you have do not have access to this endpoint';
                $code = 403;
                $status = false;
                $user->res($message, $code, $status);
            }

           }

             public function fetch_all_employee(User $user){
                if(Gate::allows("check-admin", auth()->user())){
                    $message =count($user->all());
                    $code = 200;
                    $status = true;
                    $user->res($message, $code, $status);
                }else{
                    $message ='you have do not have access to this endpoint';
                    $code = 403;
                    $status = false;
                    $user->res($message, $code, $status);
                }
             }


             public function fetch_all_roles(Role $role){
                if(Gate::allows("check-admin", auth()->user())){
                    $message =$role->all();
                    $code = 200;
                    $status = true;
                    $role->res($message, $code, $status);
                }else{
                    $message ='you have do not have access to this endpoint';
                    $code = 403;
                    $status = false;
                    $role->res($message, $code, $status);
                }
             }







}
