<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\adminCtrl;
use App\Http\Controllers\Admin\menuCtrl;
use DB;
use Auth;

class configCtrl extends adminCtrl {
    use menuCtrl;
    /**
    * Programmer   : Ory
    * Tanggal      : 03-12-2016
    * Fungsi       : Menampilkan halaman company profile dengan membawa beberapa variabel
    * Tipe         : Edit
    */
    function index(){
        $data = [];
        $data['title'] = 'Company Profile';
        $data['subtitle'] = '';
        $data['payment'] = $this->payment();
        $data['config'] = $this->getConfig();
        $data['about'] = $this->getAbout();
        $menu = $this->generateMenu();
    	return view('admin/config/view', compact('data','menu'));
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 03-12-2016
    * Fungsi       : Mengambil data Payment Type
    * Tipe         : Edit
    */
    function payment(){
        $query = DB::table('m_payment_type');
        $query->orderBy('id_type', 'asc');
        $data = $query->get();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 03-12-2016
    * Fungsi       : Mengambil data m_config
    * Tipe         : Edit
    */
    function getConfig(){
        $query = DB::table('m_config');
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 03-12-2016
    * Fungsi       : Mengambil data m_about
    * Tipe         : Edit
    */
    function getAbout(){
        $query = DB::table('m_about');
        $data = $query->first();
        return $data;
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 03-12-2016
    * Fungsi       : Fungsi menyimpan perubahan
    * Tipe         : Edit
    */
    function do_Simpan(Request $request) {
        $return = array();
        $error = "";
        $paymenttype = [];

        $t50i = ($request->input("t50i") != "") ? $request->input("t50i") : "";
        $t20d = ($request->input("t20d") != "") ? $request->input("t20d") : "";
        $id_type = ($request->input("id_type") != "") ? $request->input("id_type") : "";
        $status_payment_type = ($request->input("status_payment_type") != "") ? $request->input("status_payment_type") : "";
        $footer = ($request->input("footer") != "") ? $request->input("footer") : "";
        $websitename = ($request->input("websitename") != "") ? $request->input("websitename") : "";
        $seo_title = ($request->input("seo_title") != "") ? $request->input("seo_title") : "";
        $seo_keywords = ($request->input("seo_keywords") != "") ? $request->input("seo_keywords") : "";
        $seo_desc = ($request->input("seo_desc") != "") ? $request->input("seo_desc") : "";
        $maintenance_status = ($request->input("maintenance_status") != false) ? $request->input("maintenance_status") : false;
        $maintenance_ip = ($request->input("maintenance_ip") != "") ? $request->input("maintenance_ip") : "";
        $announcement = ($request->input("announcement") != "") ? $request->input("announcement") : "";
        $emailname = ($request->input("emailname") != "") ? $request->input("emailname") : "";
        $email = ($request->input("email") != "") ? $request->input("email") : "";
        $smtp = ($request->input("smtp") != "") ? $request->input("smtp") : "";
        $smtp_host = ($request->input("smtp_host") != "") ? $request->input("smtp_host") : "";
        $smtp_port = ($request->input("smtp_port") != "") ? $request->input("smtp_port") : "";
        $smtp_user = ($request->input("smtp_user") != "") ? $request->input("smtp_user") : "";
        $smtp_pass = ($request->input("smtp_pass") != "") ? $request->input("smtp_pass") : "";
        $use_email = ($request->input("use_email") != false) ? $request->input("use_email") : false;
        $news_emailname = ($request->input("news_emailname") != "") ? $request->input("news_emailname") : "";
        $news_email = ($request->input("news_email") != "") ? $request->input("news_email") : "";
        $news_smtp = ($request->input("news_smtp") != "") ? $request->input("news_smtp") : "";
        $news_smtp_host = ($request->input("news_smtp_host") != "") ? $request->input("news_smtp_host") : "";
        $news_smtp_port = ($request->input("news_smtp_port") != "") ? $request->input("news_smtp_port") : "";
        $news_smtp_user = ($request->input("news_smtp_user") != "") ? $request->input("news_smtp_user") : "";
        $news_smtp_pass = ($request->input("news_smtp_pass") != "") ? $request->input("news_smtp_pass") : "";
        $office_name = ($request->input("office_name") != "") ? $request->input("office_name") : "";
        $office_email = ($request->input("office_email") != "") ? $request->input("office_email") : "";
        $office_phone = ($request->input("office_phone") != "") ? $request->input("office_phone") : "";
        $office_fax = ($request->input("office_fax") != "") ? $request->input("office_fax") : "";
        $office_address = ($request->input("office_address") != "") ? $request->input("office_address") : "";
        $maps_lat = ($request->input("maps_lat") != "") ? $request->input("maps_lat") : "";
        $maps_long = ($request->input("maps_long") != "") ? $request->input("maps_long") : "";
        $maps_icon = ($request->input("maps_icon") != "") ? $request->input("maps_icon") : "";
        $maps_title = ($request->input("maps_title") != "") ? $request->input("maps_title") : "";
        $maps_desc = ($request->input("maps_desc") != "") ? $request->input("maps_desc") : "";
        $inv_prefix = ($request->input("inv_prefix") != "") ? $request->input("inv_prefix") : "";
        $inv_code = ($request->input("inv_code") != null) ? $request->input("inv_code") : null;
        $point_value = ($request->input("point_value") != null) ? $request->input("point_value") : null;
        $redeem_value = ($request->input("redeem_value") != null) ? $request->input("redeem_value") : null;
        $vlm_from = ($request->input("vlm_from") != null) ? $request->input("vlm_from") : null;
        $vlm_to = ($request->input("vlm_to") != null) ? $request->input("vlm_to") : null;
        $link = ($request->input("link") != null) ? $request->input("link") : null;
        $max_allotment_default = ($request->input("max_allotment_default") != null) ? $request->input("max_allotment_default") : null;
        $title = ($request->input("title") != null) ? $request->input("title") : null;
        $description = ($request->input("description") != null) ? $request->input("description") : null;
        foreach ($id_type as $row) {
            $id = $row;
                $paymenttype[$id] = [
                    'id_type' => $id,
                    'status_payment_type' => $status_payment_type[$id]
                ];
        }
        $return = $this->update($footer, $websitename, $seo_title, $seo_keywords, $seo_desc, $maintenance_status, $maintenance_ip, $announcement, $emailname, $email, $smtp, $smtp_host, $smtp_port, $smtp_user, $smtp_pass, $use_email, $news_emailname, $news_email, $news_smtp, $news_smtp_host, $news_smtp_port, $news_smtp_user, $news_smtp_pass, $office_name, $office_email, $office_phone, $office_fax, $office_address, $maps_lat, $maps_long, $maps_icon, $maps_title, $maps_desc, $inv_prefix, $inv_code, $paymenttype, $point_value, $redeem_value, $vlm_from, $vlm_to, $link, $max_allotment_default, $title, $description);
        echo json_encode($return);
    }

    /**
    * Programmer   : Ory
    * Tanggal      : 03-12-2016
    * Fungsi       : Fungsi menyimpan perubahan
    * Tipe         : Edit
    */
    public function update($footer = "", $websitename = "", $seo_title = "", $seo_keywords = "", $seo_desc = "", $maintenance_status = "", $maintenance_ip = "", $announcement = "", $emailname = "", $email = "", $smtp = "", $smtp_host = "", $smtp_port = "", $smtp_user = "", $smtp_pass = "", $use_email = "", $news_emailname = "", $news_email = "", $news_smtp = "", $news_smtp_host = "", $news_smtp_port = "", $news_smtp_user = "", $news_smtp_pass = "", $office_name = "", $office_email = "", $office_phone = "", $office_fax = "", $office_address = "", $maps_lat = "", $maps_long = "", $maps_icon = "", $maps_title = "", $maps_desc = "", $inv_prefix = "", $inv_code = "", $paymenttype = [], $point_value = "", $redeem_value = "", $vlm_from = "", $vlm_to = "", $link = "", $max_allotment_default = "", $title = "", $description = "") {
        $data = array(
            "footer"                => $footer,
            "websitename"           => $websitename,
            "seo_title"             => $seo_title,
            "seo_keywords"          => $seo_keywords,
            "seo_desc"              => $seo_desc,
            "maintenance_status"    => $maintenance_status,
            "maintenance_ip"        => $maintenance_ip,
            "announcement"          => $announcement,
            "emailname"             => $emailname,
            "email"                 => $email,
            "smtp"                  => $smtp,
            "smtp_host"             => $smtp_host,
            "smtp_port"             => $smtp_port,
            "smtp_user"             => $smtp_user,
            "smtp_pass"             => $smtp_pass,
            "use_email"             => $use_email,
            "news_emailname"        => $news_emailname,
            "news_email"            => $news_email,
            "news_smtp"             => $news_smtp,
            "news_smtp_host"        => $news_smtp_host,
            "news_smtp_port"        => $news_smtp_port,
            "news_smtp_user"        => $news_smtp_user,
            "news_smtp_pass"        => $news_smtp_pass,
            "office_name"           => $office_name,
            "office_email"          => $office_email,
            "office_phone"          => $office_phone,
            "office_fax"            => $office_fax,
            "office_address"        => $office_address,
            "maps_lat"              => $maps_lat,
            "maps_long"             => $maps_long,
            "maps_icon"             => $maps_icon,
            "maps_title"            => $maps_title,
            "maps_desc"             => $maps_desc,
            "inv_prefix"            => $inv_prefix,
            "inv_code"              => $inv_code,
            "point_value"           => $point_value,
            "redeem_value"          => $redeem_value,
            "vlm_from"              => $vlm_from,
            "vlm_to"                => $vlm_to,
            "link"                  => $link,
            "max_allotment_default" => $max_allotment_default,
            "updated_at"            => date("Y-m-d H:i:s")
        );

        $dataabout = array(
            "title"                => $title,
            "description"           => $description
        );

        DB::beginTransaction();
        try {
            DB::table('m_config')->update($data);
            foreach ($paymenttype as $row) {
                $data = [
                    'status'    => $row['status_payment_type']
                ];
                DB::table('m_payment_type')->where('id_type', $row['id_type'])->update($data);
            }

            DB::table('m_about')->update($dataabout);

            DB::commit();
            $return["msgServer"] = "Update configuration success.";
            $return["success"] = TRUE;
        } catch (Exception $e) {
            DB::rollback();
            $return["msgServer"] = "Update configuration failed. !!!";
            $return["success"] = FALSE;
        }
        return $return;
    }
}
