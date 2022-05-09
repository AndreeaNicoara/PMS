<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['user_id','first_name','last_name','username','password','status'];
    public $timestamps = false;

    function get_all_users(){
        return DB::table('users')->select('*')
        ->orderBy("users.user_id", "desc")
        ->get();

    }

    function get_user_by_user_id($user_id){
        return DB::table('users')->select("*")->where('user_id', $user_id)->first();

    }

    function get_all_active_users(){
        return DB::table('users')->select('*')
        ->where('status',"0")
        ->orderBy("users.user_id", "desc")
        ->get();

    }

    function get_users_by_user_ids($user_ids){
        return DB::table('users')->select("*")->whereIn('user_id', $user_ids)->get();

    }
}
