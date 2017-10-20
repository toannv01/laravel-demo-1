<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Register extends Authenticatable
{

//class Register extends Model
//{
//    //
    protected $table="register_users";



    public static function formstore($data){
//        echo"day la model";
//
//        var_dump($data);
        $username=Input::get('username');
        //echo $username." ";
        $email=Input::get('email');
       // echo $email." ";
        $pass=Hash::make(Input::get('password'));
       // echo $password;
        $users=new Register();

        $users->name=$username;
        $users->email=$email;
        $users->password=$pass;
        $users->save();
    }
}
