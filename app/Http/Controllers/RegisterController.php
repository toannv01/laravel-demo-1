<?php
/**
 * Created by PhpStorm.
 * User: Laptop88
 * Date: 10/18/2017
 * Time: 1:38 AM
 */

namespace App\Http\Controllers;
use Input;
use Validator;
use Redirect;
use App\Register;
use Auth;

class RegisterController extends Controller
{
    public function store(){
        //echo"tesst here";
        $data=Input::except(array('token'));
        //var_dump($data);
        $rule=array(
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'cpassword'=>'required|same:password',
        );
        $message=array(
            'email.requies'=> 'email laf trường bắt buộc',
            'email.email'=> 'không đúng định dạng',
            'pasword.requies'=> 'mật khẩu laf trường bắt buộc',
            'pasword.min'=> 'mật khẩu phải đủ 8 kí tự',
            'cpassword.required'=>'mat khau sai',
        );
        $validator=Validator::make($data,$rule,$message);

        if ($validator->fails()){
           // echo"dang ki ko thanh cong";
            return Redirect::to('register')-> withErrors($validator);
        } else
            //echo "dang ki thanh cong";
            Register::formstore(Input::except(array('_token','cpassword')));

            return Redirect::to('register')->with('success','Dang ki thanh cong');
    }
    public function login(){
       // echo"trang dang nhap";
        $data=Input::except(array('token'));
        //var_dump($data);
        $rule=array(
            'email'=>'required|email',
            'password'=>'required',
        );
        $validator=Validator::make($data,$rule);

        if ($validator->fails()){
            // echo"dang ki ko thanh cong";
            return Redirect::to('login')-> withErrors($validator);
        } else{
            $userdata=array(
                'email'=>Input::get('email'),
                'password'=>Input::get('password'),
            );
            //$data=Input::except(array('token'));
           // var_dump($data);
            if(Auth::attempt($userdata)){
                return Redirect::to('');
               // echo "chinh xac";
            } else{
               // echo"sai";
                return Redirect::to('login');
            }

        }
    }
}