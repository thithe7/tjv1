<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\adminCtrl;
use DB;
use Auth;

class useradminCtrl extends adminCtrl {
    
    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan halaman admin dengan membawa beberapa variabel
    * Tipe         : Edit
    */
    public function index(){
        $data = [];
        $data['title'] = 'Admin';
        $data['subtitle'] = '';
        $data['url_do_action'] = '/admin/admin';
        $menu = $this->generateMenu();
        return view('admin/admin/view', compact('data','menu'));
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Menampilkan data admin ke datatable
    * Tipe         : Edit
    */
    function do_Tabel(Request $request){
        $records["aaData"] = array();
        $aColumns = array('', 'name', 'username', 'email', 'created_at', 'status');
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
        $iTotalRecords = $this->getCountAdmin($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getAdmin($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    $no,
                    $Fields->name,
                    $Fields->username,
                    $Fields->email,
                    $Fields->created_at,
                    $Fields->status,
                    '<center><!--<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name . '" class="btn btn-xs btn-success btn-flat btn-detailable"><i class="fa fa-file-text-o"></i> Detail </a>--> '
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name . '" class="btn btn-xs btn-info btn-flat btn-editable" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-pencil"></i> Edit</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name . '" class="btn btn-xs btn-danger btn-flat btn-removable"><i class="fa fa-times"></i> Delete</a>
                    </center>'
                );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi edit data admin
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
                "status" => $Fields->status
            );
            $itemList[] = $item;

            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Sorry, Admin not found.";
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi simpan data admin baru
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

        if ($mode_form == "tambah") {
            if ($this->Chek_Data($id) == 0) {
                DB::beginTransaction();
                try {
                    $this->insert($name, $username, $email, $password, $status);
                    DB::commit();
                    $return["msgServer"] = "Save admin success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {                    
                    DB::rollback();
                    $return["msgServer"] = "Save admin failed. !!!";
                    $return["success"] = FALSE;
                }
            } else {
                $error = "Sorry, Admin already exists. !!!";
            }
        } else if ($mode_form == "ubah") {
            if ($this->Chek_Data($id) > 0) {
                DB::beginTransaction();
                try {
                    $this->update($id, $name, $username, $email, $password, $status);
                    DB::commit();
                    $return["msgServer"] = "Update admin success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {                    
                    DB::rollback();
                    $return["msgServer"] = "Update admin failed. !!!";
                    $return["success"] = FALSE;
                }
            } else {
                $return["msgServer"] = "Sorry, Admin not found. !!!";
                $return["success"] = FALSE;
            }
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi cek data admin sudah ada atau tidak
    * Tipe         : Edit
    */
    function Chek_Data($id = "", $name = "") {
        $query = DB::table('m_admin');

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
    * Fungsi       : Menampilkan halaman detail data admin
    * Tipe         : Edit
    */
    function List_Data($id = "") {
        $query = DB::table('m_admin');
        $query->select('id', 'm_admin.name', 'username', 'email', 'status');
        $query->where('id', $id);
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi hapus data admin
    * Tipe         : Edit
    */
    function do_Hapus(Request $request){
        $id = ($request->input("id") != "") ? $request->input("id") : "";

        DB::beginTransaction();
        try {
            $this->delete($id);
            DB::commit();
            $return["msgServer"] = "Delete Admin Success.";
            $return["success"] = true;
        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Sorry, Delete Admin Failed.";
            $return["success"] = false;
        }
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi hapus data admin
    * Tipe         : Edit
    */
    function delete($id = ""){
        if ($id) {
            DB::table('m_admin')->where('id', $id)->delete();
        }
    }

    function getCountAdmin($criteria = "", $keyword = ""){
        $query = DB::table('m_admin');

        if ($criteria && $keyword) {
            $query->where('m_admin.'.$criteria, 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_admin.username', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_admin.email', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_admin.status', 'ilike', '%'.$keyword.'%');
        }
        $data = $query->get();
        return count($data);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi menampilkan data admin
    * Tipe         : Edit
    */
    function getAdmin($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = ""){
        $data = "";
        $query = DB::table('m_admin');
        $query->select('id', 'm_admin.name', 'username', 'email', 'created_at', 'status');

        if ($criteria && $keyword) {
            $query->where('m_admin.'.$criteria, 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_admin.username', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_admin.email', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_admin.status', 'ilike', '%'.$keyword.'%');
        }

        if ($sort && $dir) {
            $query->orderBy("m_admin.".$sort, $dir);
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
    * Fungsi       : Fungsi menyimpan data admin baru
    * Tipe         : Edit
    */
    public function insert($name = "", $username = "", $email = "", $password = "", $status = "")
    {
        $data = array(
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "password" => bcrypt($password),
            "status" => $status,
            "created_at" => date("Y-m-d H:i:s")
        );
        DB::table('m_admin')->insert($data);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 05-12-2016
    * Fungsi       : Fungsi edit data admin
    * Tipe         : Edit
    */
    public function update($id = "", $name = "", $username = "", $email = "", $password = "", $status = "")
    {
        if ($password == "") {
            $data = array(
                "name" => $name,
                "username" => $username,
                "email" => $email,
                "status" => $status,
                "updated_at" => date("Y-m-d H:i:s")
            );
        }else{
            $data = array(
                "name" => $name,
                "username" => $username,
                "email" => $email,
                "password" => bcrypt($password),
                "status" => $status,
                "updated_at" => date("Y-m-d H:i:s")
            );
        }
        DB::table('m_admin')->where('id', $id)->update($data);
    }
}
