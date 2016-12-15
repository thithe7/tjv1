<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\adminCtrl;

use DB;
use Auth;

class faqCatCtrl extends adminCtrl {
    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Update category page
    * Tipe         : create
    */
    public function index() {
        $data = [];
        $menu = $this->generateMenu();

        $data['title'] = 'Category FAQ';
        $data['subtitle'] = '';
        $data['url_do_action'] = '/admin/faqcat';
        $data['parent'] = $this->getParent();

        return view('admin/faq/category/view', compact('data', 'menu'));
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Get category parent
    * Tipe         : create
    */
    function getParent(){
        $query = DB::table('m_kategori_faq');
        $query->where('parent', '=', null);
        $data = $query->get();

        return $data;
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Show category faq on datatable
    * Tipe         : create
    */
    function do_Tabel(Request $request){

        $records["aaData"] = array();

        $aColumns = array('', 'name_id', 'name_en', 'parent');
        //default
        $sort = "id";
        $dir = "desc";
        $criteria = "name_id";

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
        $iTotalRecords = $this->getCountFaqCat($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getFaqCat($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    $no,
                    // $Fields->id,
                    $Fields->name_id,
                    $Fields->name_en,
                    $Fields->parent,
                    '<center>'
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name_en . '" data-parent="' . $Fields->parent . '" class="btn btn-xs btn-info btn-flat btn-editable" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-pencil"></i> Edit</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->name_en . '" data-parent="' . $Fields->parent . '" class="btn btn-xs btn-danger btn-flat btn-removable"><i class="fa fa-times"></i> Delete</a></center>'
                    );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Edit category faq
    * Tipe         : create
    */
    function do_Ubah(Request $request) {
        $return = array();
        $itemList = array();

        $id = ($request->input("id") != "") ? $request->input("id") : "";

        if ($this->Chek_Data($id) > 0) {
            $Fields = $this->List_Data($id);

            $item = array(
                "id"        => $Fields->id,
                "name_id"   => $Fields->name_id,
                "name_en"   => $Fields->name_en,
                "parent"    => $Fields->parent
                );
            $itemList[] = $item;

            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Sorry, Category not found.";
        }

        echo json_encode($return);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Save category faq
    * Tipe         : create
    */
    function do_Simpan(Request $request) {
        $return = array();
        $error = "";

        $mode_form = ($request->input("mode_form") != "") ? $request->input("mode_form") : "";
        $id = ($request->input("id") != "") ? $request->input("id") : "";
        $name_id = ($request->input("name_id") != "") ? $request->input("name_id") : "";
        $name_en = ($request->input("name_en") != "") ? $request->input("name_en") : "";
        $parent = ($request->input("parent") != null) ? $request->input("parent") : null;

        //  Check kondisi inputan
        if ($mode_form == "" || $mode_form == null || $name_id == "" || $name_id == null || $name_en == "" || $name_en == null) {
            $return["msgServer"] = "Please fill the blank field.";
            $return["success"] = FALSE;
        } else {
            if ($mode_form == "tambah") {
                if ($this->Chek_Data($id) == 0) {
                    DB::beginTransaction();
                    try {
                        $this->insert($name_id, $name_en, $parent);
                        DB::commit();
                        $return["msgServer"] = "Save category success.";
                        $return["success"] = TRUE;
                    } catch (Exception $e) {                    
                        DB::rollback();
                        $return["msgServer"] = "Save category failed. !!!";
                        $return["success"] = FALSE;
                    }
                } else {
                    $return["msgServer"] = "Sorry, category already exists. !!!";
                    $return["success"] = FALSE;
                }
            } else if ($mode_form == "ubah") {
                if ($this->Chek_Data($id) > 0) {
                    DB::beginTransaction();
                    try {
                        $this->update($id, $name_id, $name_en, $parent);
                        DB::commit();
                        $return["msgServer"] = "Update category success.";
                        $return["success"] = TRUE;
                    } catch (Exception $e) {                    
                        DB::rollback();
                        $return["msgServer"] = "Update category failed. !!!";
                        $return["success"] = FALSE;
                    }
                } else {
                    $error = "Sorry, category not found. !!!";
                }
            }
        }

        echo json_encode($return);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Check category faq
    * Tipe         : create
    */
    function Chek_Data($id = "", $name = "") {
        $query = DB::table('m_kategori_faq');

        if ($id) {
            $query->where('id', $id);
        } else {
            $query->where('name_id', $name);
            $query->orWhere('name_en', $name);
        }

        $data = $query->get();

        return count($data);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : category faq
    * Tipe         : create
    */
    function List_Data($id = "") {
        $query = DB::table('m_kategori_faq');
        $query->where('id', $id);
        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Delete category faq
    * Tipe         : create
    */
    function do_Hapus(Request $request){
        $id = ($request->input("id") != "") ? $request->input("id") : "";
        $parent = ($request->input("parent") != null) ? $request->input("parent") : null;

        $cp = $this->Chek_Parent($id);

        if ($cp > 0) {
            $return["msgServer"] = "Sorry, Category already have child.";
            $return["success"] = false;
        }else{
            DB::beginTransaction();
            try {
                $this->delete($id);
                DB::commit();
                $return["msgServer"] = "Delete category Success.";
                $return["success"] = true;
            } catch (Exception $e) {
                DB::rollback();
                $return["msgServer"] = "Sorry, Delete category Failed.";
                $return["success"] = false;
            }
        }

        echo json_encode($return);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Delete category faq
    * Tipe         : create
    */
    function delete($id = ""){
        if ($id) {
            DB::table('m_kategori_faq')->where('id', $id)->delete();
        }
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Get length of category faq
    * Tipe         : create
    */
    function getCountFaqCat($criteria = "", $keyword = ""){

        $query = DB::table('m_kategori_faq');

        if ($criteria && $keyword) {
            $query->where($criteria, 'ilike', '%'.$keyword.'%');
            $query->orWhere('name_en', 'ilike', '%'.$keyword.'%');
        }

        $data = $query->get();

        return count($data);

    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Get Category faq
    * Tipe         : create
    */
    function getFaqCat($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = ""){
        $data = "";

        $query = DB::table('m_kategori_faq');

        if ($criteria && $keyword) {
            $query->where($criteria, 'ilike', '%'.$keyword.'%');
            $query->orWhere('name_en', 'ilike', '%'.$keyword.'%');
        }

        if ($sort && $dir) {
            $query->orderBy($sort, $dir);
        }

        if ($start != "" && $limit != "") {
            $query->take($limit)->skip($start);
        }

        $data = $query->get();

        return $data;
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Create category faq
    * Tipe         : create
    */
    public function insert($name_id = "", $name_en = "", $parent = "") {
        $data = array(
            "name_id" => $name_id,
            "name_en" => $name_en,
            "parent"  => $parent,
            "created_at" => date("Y-m-d H:i:s"),
            "created_by" => Auth::guard('web_admin')->user()->id
            );

        DB::table('m_kategori_faq')->insert($data);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Update Category faq
    * Tipe         : create
    */
    public function update($id = "", $name_id = "", $name_en = "", $parent = "") {
        $data = array(
            "name_id" => $name_id,
            "name_en" => $name_en,
            "parent"  => $parent,
            "updated_at"    => date("Y-m-d H:i:s"),
            "updated_by"    => Auth::guard('web_admin')->user()->id
            );

        DB::table('m_kategori_faq')->where('id', $id)->update($data);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Check parent category faq
    * Tipe         : create
    */
    function Chek_Parent($parent = ""){

        $query = DB::table('m_kategori_faq');
        $query->selectRaw('count(*)');
        $query->where('parent', $parent);
        $data = $query->first();

        return $data->count;
    }
}
