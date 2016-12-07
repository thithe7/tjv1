<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

trait menuCtrl {
	/**
     * Programmer   : Halili
     * Tanggal      : 05-12-2016
     * Fungsi       : Membuat susunan tree menu
	 * Tipe         : create
	 */
	function mapTree($dataset, $parent_id = "") {
		$tree = array();
		foreach ($dataset as $id => $node) {
			if ($node->parent != $parent_id) continue;
			$node->children = $this->mapTree($dataset, $node->id);
			$tree[$id] = $node;
		}

		return $tree;
	}

	/**
     * Programmer   : Halili
     * Tanggal      : 05-12-2016
     * Fungsi       : Membuat sidebar sesuai dengan template Admin LTE
	 * Tipe         : create
	 */
	function prepareMenu($tree,$level = 0) {
		$data = '<ul class="sidebar-menu"><li class="header" style="text-align: center;">SIDEBAR MENU</li>';
		if($level > 0) {
			$data = '<ul class="treeview-menu">';
		}

		foreach ($tree as $item) {
			$classTree = (count($item->children) > 0 && $level == 0 )? 'treeview' : '';
			$arrowTree = '';
			if(count($item->children) > 0){
				$arrowTree = '<i class="fa fa-angle-left pull-right"></i>';
		}
		if(isset($item->header) && !empty($item->header)){
			$data .= '
			<li class="header">'.strtoupper($item->header).'</li>';
		}

		$data .= '
		<li class="'.$classTree.'"><a href="/' . $item->url . '">'.$item->icon.' <span>'. $item->name .'</span>'.$arrowTree. '</a>';

			if (count($item->children) > 0)
			{
				$data .= $this->prepareMenu($item->children,++$level);
			}
			$data .= '</li>';
		}

		$data .= '</li></ul>';

		return $data;
	}

	/**
     * Programmer   : Halili
     * Tanggal      : 05-12-2016
     * Fungsi       : Generate menu
	 * Tipe         : create
	 */
	function generateMenu(){
		$query = DB::table('m_menu');
		$query->where('active', 1);
		$query->where('role', 'admin');
		// $query->orderBy('id');
		$menu = $query->get();

		return $this->prepareMenu($this->mapTree($menu));
	}
}