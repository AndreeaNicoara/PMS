<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class LeadersModel extends Model
{
    protected $table = 'leaders';
    protected $allowedFields = ['leader_id','user_id','status'];
    public $timestamps = false;

    function get_all_leaders(){
        return DB::table('leaders')->select('leaders.*','users.first_name','users.last_name')
        ->leftJoin('users', 'users.user_id', '=', 'leaders.user_id')
        ->orderBy("leaders.leader_id", "desc")
        ->get();

    }

    function get_all_not_assign_leaders($leader_ids){
        return DB::table('users')->select('users.*')
        ->whereNotIn('user_id', $leader_ids)
        ->orderBy("users.user_id", "desc")
        ->get();

    }

    function get_leader_by_leader_id($leader_id){
        return DB::table('leaders')
        ->select("users.*")
        ->leftJoin('users', 'users.user_id', '=', 'leaders.user_id')
        ->where('leader_id', $leader_id)->first();

    }

    function get_leader_count_by_user_id($user_id){
        return DB::table('leaders')
        ->select("users.*")
        ->leftJoin('users', 'users.user_id', '=', 'leaders.user_id')
        ->where('users.user_id', $user_id)->get()->count();

    }
}
