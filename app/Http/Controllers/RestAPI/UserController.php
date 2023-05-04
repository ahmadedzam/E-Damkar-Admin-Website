<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserListResource;
use App\Models\User;
use App\Models\user_listData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(){
        $userdata = user_listData::all();
        
        return UserListResource::collection($userdata);
    }

    public function checkLogin(){
        $userdata = user_listData::find(1);

        return new UserListResource($userdata);
    }

    public function updatePassword(Request $request)
{
    $request->validate(['id' => 'required' , 'password_lama' => 'required' , 'password_baru' => 'required']);
    $ambilPasswordLama = DB::table('user_list_data')->where('id','=', $request->id)->where('password','=',$request->password_lama)->first();

    if($ambilPasswordLama){

        DB::table('user_list_data')->where('id','=',$request->id)->update([
            'password' => $request->password_baru
           
        ]);
        $data = [
            'status' => 'berhasil',
            'kode' => '200'
        ];
        return json_encode($data);

    }else{ 
        
        $data = [
        'status' => 'gagal',
        'kode' => '400'
    ];
    return json_encode($data);}
}

}
