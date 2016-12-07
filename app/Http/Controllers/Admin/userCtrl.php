<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\adminCtrl;
use App\Http\Controllers\Admin\menuCtrl;
use DB;
use Auth;

class userCtrl extends adminCtrl {
    use menuCtrl;
    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan halaman user dengan membawa beberapa variabel
    * Tipe         : Edit
    */
    public function index(){
        $data = [];
        $data['title'] = 'User';
        $data['subtitle'] = '';
        $data['url_do_action'] = '/admin/user';
        $data['city'] = $this->getCity(1);
        $menu = $this->generateMenu();
        return view('admin/user/view', compact('data','menu'));
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

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan data user ke datatable
    * Tipe         : Edit
    */
    function do_Tabel(Request $request){
        $records["aaData"] = array();
        $aColumns = array('', 'name', 'username', 'email', 'status');
        $sort = "name";
        $dir = "desc";
        $criteria = "username";

        $sSearch = ($request->input("sSearch") != "") ? $request->input("sSearch") : "";
        $iDisplayLength = ($request->input("iDisplayLength") != "") ? $request->input("iDisplayLength") : "";
        $iDisplayStart = ($request->input("iDisplayStart") != "") ? $request->input("iDisplayStart") : "";
        $sEcho = ($request->input("sEcho") != "") ? $request->input("sEcho") : "";

        // Shorting
        $iSortCol_0 = ($request->input("iSortCol_0") != "") ? $request->input("iSortCol_0") : "";
        $iSortingCols = ($request->input("iSortingCols") != "") ? $request->input("iSortingCols") : "";
        if ($iSortCol_0) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $sort = $aColumns[intval($request->input('iSortCol_' . $i))];
                $dir = ($request->input('sSortDir_' . $i) != "") ? $request->input('sSortDir_' . $i) : "";
            }
        }
        $iTotalRecords = $this->getCountUser($criteria, $sSearch);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getUser($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    $no,
                    $Fields->name,
                    $Fields->username,
                    $Fields->email,
                    $Fields->status,
                    '<center><!--<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name . '" class="btn btn-xs btn-success btn-flat btn-detailable"><i class="fa fa-file-text-o"></i> Detail </a>--> '
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name . '" class="btn btn-xs btn-info btn-flat btn-editable" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-pencil"></i> Edit</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name . '" class="btn btn-xs btn-danger btn-flat btn-removable"><i class="fa fa-times"></i> Delete</a></center>'
                );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi edit data user
    * Tipe         : Edit
    */
    function do_Ubah(Request $request) {
        $return = array();
        $itemList = array();

        $id = ($request->input("id") != "") ? $request->input("id") : "";

        if ($this->Chek_Data($id) > 0) {
            $Fields = $this->List_Data($id);

            $item = array(
                "id" => $Fields->id,
                "name" => $Fields->name,
                "username" => $Fields->username,
                "email" => $Fields->email,
                "status" => $Fields->status,
                "phone" => $Fields->phone,
                "city" => $Fields->city,
                "postcode" => $Fields->postcode,
                "address" => $Fields->address,
                "birthdate" => $Fields->birthdate,
                "status_newsletter" => $Fields->status_newsletter
            );
            $itemList[] = $item;

            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Sorry, User not found.";
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi menyimpan data user baru
    * Tipe         : Edit
    */
    function do_Simpan(Request $request) {
        $return = array();
        $error = "";

        $mode_form = ($request->input("mode_form") != "") ? $request->input("mode_form") : "";
        $id = ($request->input("id") != "") ? $request->input("id") : "";
        $name = ($request->input("name") != "") ? $request->input("name") : "";
        $username = ($request->input("username") != "") ? $request->input("username") : "";
        $email = ($request->input("email") != "") ? $request->input("email") : "";
        $password = ($request->input("password") != "") ? $request->input("password") : "";
        $status = ($request->input("status") != "") ? $request->input("status") : "";
        $phone = ($request->input("phone") != "") ? $request->input("phone") : "";
        $city = ($request->input("city") != "") ? $request->input("city") : "";
        $postcode = ($request->input("postcode") != "") ? $request->input("postcode") : "";
        $address = ($request->input("address") != "") ? $request->input("address") : "";
        $birthdate = ($request->input("birthdate") != "") ? $request->input("birthdate") : "";
        $status_newsletter = ($request->input("status_newsletter") != "") ? $request->input("status_newsletter") : "";

        if ($mode_form == "tambah") {
            if ($this->Chek_Data($id) == 0) {
                DB::beginTransaction();
                try {
                    $this->insert($name, $username, $email, $password, $status, $phone, $city, $postcode, $address, $birthdate, $status_newsletter);
                    DB::commit();
                    $return["msgServer"] = "Save user success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {                    
                    DB::rollback();
                    $return["msgServer"] = "Save user failed. !!!";
                    $return["success"] = FALSE;
                }
            } else {
                $error = "Sorry, User already exists. !!!";
            }
        } else if ($mode_form == "ubah") {
            if ($this->Chek_Data($id) > 0) {
                DB::beginTransaction();
                try {
                    $this->update($id, $name, $username, $email, $password, $status, $phone, $city, $postcode, $address, $birthdate, $status_newsletter);
                    DB::commit();
                    $return["msgServer"] = "Update user success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {                    
                    DB::rollback();
                    $return["msgServer"] = "Update user failed. !!!";
                    $return["success"] = FALSE;
                }
            } else {
                $error = "Sorry, User not found. !!!";
            }
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Cek data user baru sudah ada atau belum
    * Tipe         : Edit
    */
    function Chek_Data($id = "", $name = "") {
        $query = DB::table('m_user');

        if ($id) {
            $query->where('id', $id);
        } else {
            $query->where('name', $name);
        }

        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan detail user ketika edit
    * Tipe         : Edit
    */
    function List_Data($id = "") {
        $query = DB::table('m_user');
        $query->select('id', 'm_user.name', 'username', 'email', 'status', 'phone', 'city', 'postcode', 'address', 'birthdate', 'status_newsletter');
        $query->where('id', $id);
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi hapus data user
    * Tipe         : Edit
    */
    function do_Hapus(Request $request){
        $id = ($request->input("id") != "") ? $request->input("id") : "";

        DB::beginTransaction();
        try {
            $this->delete($id);
            DB::commit();
            $return["msgServer"] = "Delete User Success.";
            $return["success"] = true;
        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Sorry, Delete User Failed.";
            $return["success"] = false;
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi hapus data user
    * Tipe         : Edit
    */
    function delete($id = ""){
        if ($id) {
            DB::table('m_user')->where('id', $id)->delete();
        }
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi menampilkan jumlah user
    * Tipe         : Edit
    */
    function getCountUser($criteria = "", $keyword = ""){

        $query = DB::table('m_user');

        if ($criteria && $keyword) {
            $query->where('m_user.'.$criteria, 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_user.username', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_user.email', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_user.status', 'ilike', '%'.$keyword.'%');
        }

        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi menampilkan data user
    * Tipe         : Edit
    */
    function getUser($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = ""){
        $data = "";
        $query = DB::table('m_user');
        $query->select('id', 'm_user.name', 'username', 'email', 'status');

        if ($criteria && $keyword) {
            $query->where('m_user.'.$criteria, 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_user.username', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_user.email', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_user.status', 'ilike', '%'.$keyword.'%');
        }

        if ($sort && $dir) {
            $query->orderBy("m_user.".$sort, $dir);
        }

        if ($start != "" && $limit != "") {
            $query->take($limit)->skip($start);
        }

        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi menyimpan data user baru
    * Tipe         : Edit
    */
    public function insert($name = "", $username = "", $email = "", $password = "", $status = "", $phone = "", $city = "", $postcode = "", $address = "", $birthdate = "", $status_newsletter = "")
    {
        $data = array(
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "password" => bcrypt($password),
            "status" => $status,
            "phone" => $phone,
            "city" => $city,
            "postcode" => $postcode,
            "address" => $address,
            "birthdate" => $birthdate,
            "status_newsletter" => $status_newsletter,
            "created_at" => date("Y-m-d H:i:s")
        );
        DB::table('m_user')->insert($data);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi edit data user
    * Tipe         : Edit
    */
    public function update($id = "", $name = "", $username = "", $email = "", $password = "", $status = "", $phone = "", $city = "", $postcode = "", $address = "", $birthdate = "", $status_newsletter = "")
    {
        if ($password == "") {
            $data = array(
                "name" => $name,
                "username" => $username,
                "email" => $email,
                "status" => $status,
                "phone" => $phone,
                "city" => $city,
                "postcode" => $postcode,
                "address" => $address,
                "birthdate" => $birthdate,
                "status_newsletter" => $status_newsletter,
                "updated_at" => date("Y-m-d H:i:s")
            );
        }else{
            $data = array(
                "name" => $name,
                "username" => $username,
                "email" => $email,
                "password" => bcrypt($password),
                "status" => $status,
                "phone" => $phone,
                "city" => $city,
                "postcode" => $postcode,
                "address" => $address,
                "birthdate" => $birthdate,
                "status_newsletter" => $status_newsletter,
                "updated_at" => date("Y-m-d H:i:s")
            );
        }
        DB::table('m_user')->where('id', $id)->update($data);
    }
}
