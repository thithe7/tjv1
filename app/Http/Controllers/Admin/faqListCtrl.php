<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\adminCtrl;

use DB;
use Auth;

class faqListCtrl extends adminCtrl {
    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Show list page
    * Tipe         : create
    */
    public function index() {
        $data = [];
        $menu = $this->generateMenu();

        $data['title'] = 'List FAQ';
        $data['subtitle'] = '';
        $data['url_do_action'] = '/admin/faqlist';
        $data['category'] = $this->getCategoryFaq();

        return view('admin/faq/list/view', compact('data', 'menu'));
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Get category faq
    * Tipe         : create
    */
    public function getCategoryFaq() {
        $query = DB::table('m_kategori_faq');
        $query->whereRaw('parent notnull');
        $data = $query->get();

        return $data;
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Show list faq on datatable
    * Tipe         : create
    */
    function do_Tabel(Request $request){

        $records["aaData"] = array();

        $aColumns = array('', 'category', 'question_id', 'question_en');
        //default
        $sort = "id";
        $dir = "desc";
        $criteria = "question_id";

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
        $iTotalRecords = $this->getCountFaq($criteria, $sSearch);

        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        $query = $this->getFaq($criteria, $sSearch, $sort, $dir, $iDisplayStart, $iDisplayLength);

        if (count($query) > 0) {
            $no = $iDisplayStart;
            foreach ($query as $Fields) {
                $no++;
                $records["aaData"][] = array(
                    $no,
                    $Fields->category_id,
                    $Fields->question_id,
                    $Fields->question_en,
                    '<center>'
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->id . '" class="btn btn-xs btn-info btn-flat btn-editable" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-pencil"></i> Edit</a> '
                    . '<a href="javascript:;" data-id="' . $Fields->id . '" data-name="' . $Fields->id . '" class="btn btn-xs btn-danger btn-flat btn-removable"><i class="fa fa-times"></i> Delete</a></center>'
                );
            }
        }
        echo json_encode($records);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Edit list faq
    * Tipe         : create
    */
    function do_Ubah(Request $request) {
        $return = array();
        $itemList = array();

        $id = ($request->input("id") != "") ? $request->input("id") : "";

        if ($this->Chek_Data($id) > 0) {
            $Fields = $this->List_Data($id);

            $item = array(
                "id" => $Fields->id,
                "category" => $Fields->category,
                "question_id" => $Fields->question_id,
                "answer_id" => $Fields->answer_id,
                "question_en" => $Fields->question_en,
                "answer_en" => $Fields->answer_en
            );
            $itemList[] = $item;

            $return["success"] = TRUE;
            $return["results"] = $item;
        } else {
            $return["success"] = FALSE;
            $return["msgServer"] = "Sorry, FAQ not found.";
        }

        echo json_encode($return);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Save list faq
    * Tipe         : create
    */
    function do_Simpan(Request $request) {
        $return = array();
        $error = "";

        $mode_form = ($request->input("mode_form") != "") ? $request->input("mode_form") : "";
        $id = ($request->input("id") != "") ? $request->input("id") : "";
        $category = ($request->input("category") != "") ? $request->input("category") : "";
        $question_id = ($request->input("question_id") != "") ? $request->input("question_id") : "";
        $answer_id = ($request->input("answer_id") != "") ? $request->input("answer_id") : "";
        $question_en = ($request->input("question_en") != "") ? $request->input("question_en") : "";
        $answer_en = ($request->input("answer_en") != "") ? $request->input("answer_en") : "";

        if ($mode_form == "tambah") {
            if ($this->Chek_Data($id) == 0) {
                DB::beginTransaction();
                try {
                    $this->insert($category, $question_id, $answer_id, $question_en, $answer_en);
                    DB::commit();
                    $return["msgServer"] = "Save FAQ success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {                    
                    DB::rollback();
                    $return["msgServer"] = "Save FAQ failed. !!!";
                    $return["success"] = FALSE;
                }
            } else {
                $error = "Sorry, FAQ already exists. !!!";
            }
        } else if ($mode_form == "ubah") {
            if ($this->Chek_Data($id) > 0) {
                DB::beginTransaction();
                try {
                    $this->update($id, $category, $question_id, $answer_id, $question_en, $answer_en);
                    DB::commit();
                    $return["msgServer"] = "Update FAQ success.";
                    $return["success"] = TRUE;
                } catch (Exception $e) {                    
                    DB::rollback();
                    $return["msgServer"] = "Update FAQ failed. !!!";
                    $return["success"] = FALSE;
                }
            } else {
                $error = "Sorry, FAQ not found. !!!";
            }
        }

        echo json_encode($return);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Check list faq
    * Tipe         : create
    */
    function Chek_Data($id = "", $name = "") {
        $query = DB::table('t_faq');

        if ($id) {
            $query->where('id', $id);
        } else {
            $query->where('question_id', $name);
            $query->orWhere('question_en', $name);
        }

        $data = $query->get();

        return count($data);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : list faq
    * Tipe         : create
    */
    function List_Data($id = "") {
        $query = DB::table('t_faq');
        $query->where('id', $id);
        $data = $query->first();

        return $data;
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Delete faq
    * Tipe         : create
    */
    function do_Hapus(Request $request){
        $id = ($request->input("id") != "") ? $request->input("id") : "";

        DB::beginTransaction();
        try {
            $this->delete($id);
            DB::commit();
            $return["msgServer"] = "Delete FAQ Success.";
            $return["success"] = true;
        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Sorry, Delete FAQ Failed.";
            $return["success"] = false;
        }

        echo json_encode($return);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Delete faq
    * Tipe         : create
    */
    function delete($id = ""){
        if ($id) {
            DB::table('t_faq')->where('id', $id)->delete();
        }
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Get length of list faq
    * Tipe         : create
    */
    function getCountFaq($criteria = "", $keyword = ""){

        $query = DB::table('t_faq');
        $query->join('m_kategori_faq', 'm_kategori_faq.id', '=', 't_faq.category');
        $query->select('t_faq.*', 'm_kategori_faq.name_id as category_id', 'm_kategori_faq.name_en as category_en');

        if ($criteria && $keyword) {
            $query->where('m_kategori_faq.name_id', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_kategori_faq.name_en', 'ilike', '%'.$keyword.'%');
            $query->orWhere('question_id', 'ilike', '%'.$keyword.'%');
            $query->orWhere('answer_id', 'ilike', '%'.$keyword.'%');
            $query->orWhere('question_en', 'ilike', '%'.$keyword.'%');
            $query->orWhere('answer_en', 'ilike', '%'.$keyword.'%');
        }

        $data = $query->get();

        return count($data);

    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Get list faq
    * Tipe         : create
    */
    function getFaq($criteria = "", $keyword = "", $sort = "", $dir = "", $start = "", $limit = ""){
        $data = "";

        $query = DB::table('t_faq');
        $query->join('m_kategori_faq', 'm_kategori_faq.id', '=', 't_faq.category');
        $query->select('t_faq.*', 'm_kategori_faq.name_id as category_id', 'm_kategori_faq.name_en as category_en');

        if ($criteria && $keyword) {
            $query->where('m_kategori_faq.name_id', 'ilike', '%'.$keyword.'%');
            $query->orWhere('m_kategori_faq.name_en', 'ilike', '%'.$keyword.'%');
            $query->orWhere('question_id', 'ilike', '%'.$keyword.'%');
            $query->orWhere('answer_id', 'ilike', '%'.$keyword.'%');
            $query->orWhere('question_en', 'ilike', '%'.$keyword.'%');
            $query->orWhere('answer_en', 'ilike', '%'.$keyword.'%');
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
    * Fungsi       : Create list faq
    * Tipe         : create
    */
    public function insert($category = "", $question_id = "", $answer_id = "", $question_en = "", $answer_en = "") {
        $data = array(
            "category"      => $category,
            "question_id"   => $question_id,
            "answer_id"     => $answer_id,
            "question_en"   => $question_en,
            "answer_en"     => $answer_en,
            "created_at"    => date("Y-m-d H:i:s"),
            "created_by"    => Auth::guard('web_admin')->user()->id
        );

        DB::table('t_faq')->insert($data);
    }

    /**
    * Programmer   : Halili
    * Tanggal      : 07-12-2016
    * Fungsi       : Update list faq
    * Tipe         : create
    */
    public function update($id = "", $category = "", $question_id = "", $answer_id = "", $question_en = "", $answer_en = "") {
        $data = array(
            "category"      => $category,
            "question_id"   => $question_id,
            "answer_id"     => $answer_id,
            "question_en"   => $question_en,
            "answer_en"     => $answer_en,
            "updated_at"    => date("Y-m-d H:i:s"),
            "updated_by"    => Auth::guard('web_admin')->user()->id
        );

        DB::table('t_faq')->where('id', $id)->update($data);
    }
}
