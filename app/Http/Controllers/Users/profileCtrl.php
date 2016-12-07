<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Users\usersCtrl;
// use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;

class profileCtrl extends usersCtrl {
    function index(){
        $id = Auth::guard('web_users')->user()->id;
        $query = DB::table('m_user');
        $query->join('m_city', 'm_city.id', '=', 'm_user.city');
        $query->where('m_user.id', $id);
        $profile = $query->first();

        $act="";
        $msg="";
        if(!Auth::guard('web_users')->guest()){
            $cekactivation = DB::table('m_user')
                ->select('statusconfirm')
                ->where('id', Auth::guard('web_users')->user()->id)
                ->first();
            $act=$cekactivation->statusconfirm;
        }

        if($act == 'need confirm') $msg="Your account hasn't been verified. Please check your email to verify your account.";

        $data = [];
        $data['city'] = $this->getCity(1);

        return view('users/login/profile2/view',compact('data','profile','msg'));
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Mengambil data dari tabel m_city
    * Tipe         : Edit
    */
    function getCity($id=null){
        $query = DB::table('m_city');
        if($id!=null){
            $query->where('country', $id);
        }
        $query->orderBy('id', 'asc');
        $data = $query->get();
        return $data;
    }

    function do_Simpan(Request $request){
        $id = ($request->input("id") != "") ? $request->input("id") : "";
        $name = ($request->input("name") != "") ? $request->input("name") : "";
        $address = ($request->input("address") != "") ? $request->input("address") : "";
        $email = ($request->input("email") != "") ? $request->input("email") : "";
        $birthdate = ($request->input("birthdate") != "") ? $request->input("birthdate") : "";
        $phone = ($request->input("phone") != "") ? $request->input("phone") : "";
        $password = ($request->input("password") != "") ? $request->input("password") : "";
        $newsletter=$request->input('newsletter');
        $city=$request->input('city');
        $postcode=$request->input('postcode');


        if($newsletter!=""){
                $statusnya='TRUE';
            }
            else{
                $statusnya='FALSE';
            }

        if ($this->Chek_Data($id) > 0) {
            DB::beginTransaction();
            try {
                $this->update($id, $name, $email, $phone, $city, $postcode, $address, $birthdate, $statusnya);
                DB::commit();
                $return["msgServer"] = "Update profile success.";
                $return["success"] = TRUE;
            } catch (Exception $e) {                    
                DB::rollback();
                $return["msgServer"] = "Update profile failed. !!!";
                $return["success"] = FALSE;
            }
        } else {
            $return["msgServer"] = "Sorry, profile not found. !!!";
            $return["success"] = FALSE;
        }

        echo json_encode($return);
    }

    function Chek_Data($id = "", $name = ""){
        $query = DB::table('m_user');

        if ($id) {
            $query->where('id', $id);
        } else {
            $query->where('name', $name);
        }

        $data = $query->get();

        return count($data);
    }

    function update($id = "", $name = "", $email = "", $phone = "", $city = "", $postcode = "", $address = "", $birthdate = "", $statusnya = ""){
        $data = [];
        $data = array(
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "city" => $city,
            "postcode" => $postcode,
            "address" => $address,
            "birthdate" => $birthdate,
            "status_newsletter" => $statusnya,
            );
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        if ($name != "" || $name != null) {
            $data["name"] = $name;
        }
        if ($email != "" || $email != null) {
            $data["email"] = $email;
        }
        if ($phone != "" || $phone != null) {
            $data["phone"] = $phone;
        }
        if ($city != "" || $city != null) {
            $data["city"] = $city;
        }
        if ($postcode != "" || $postcode != null) {
            $data["postcode"] = $postcode;
        }
        if ($address != "" || $address != null) {
            $data["address"] = $address;
        }
        if ($birthdate != "" || $birthdate != null) {
            $data["birthdate"] = $birthdate;
        }
        if ($statusnya != "" || $statusnya != null) {
            $data["status_newsletter"] = $statusnya;
        }

        DB::table('m_user')->where('id', $id)->update($data);
        
    }
}