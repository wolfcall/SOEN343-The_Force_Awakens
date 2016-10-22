<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tableHelper
 *
 * @author Georges
 */
class tableHelper {
	//put your code here
	
	private $table;
	
	public function __construct() {
		$this->table = "";
	}
			
	public function initTable($params){
		$table = "";
		$table .= "<table ";
		foreach ($params as $key => $value) {
			$table .= "'".$key."' = '".$value."' ";
		}
		$table .= "><tbody>";
		return $table;
	}
	
	public function populateRow($params,$class,$content){
		$row = "<tr ";
		
		foreach ($params as $key => $value){
			$row .= "'".$key."' = '".$value."' ";
		}
		
		$row .= ">";
		
		foreach ($content as $key => $value){
			$row .= "<td class='".$class."'>".$value."</td>";
		}
		
		$row .= "</tr>";
		return $row;
	}
	
	public function populateHeader($params,$class,$content){
		$row = "<tr ";
		
		foreach ($params as $key => $value){
			$row .= "'".$key."' = '".$value."' ";
		}
		
		$row .= ">";
		
		foreach ($content as $key => $value){
			$row .= "<th class='".$class."'>".$value."</th>";
		}
		
		$row .= "</tr>";
		return $row;
	}
	
	public function closeTable(){
		return "</tbody></table>";
	}
}
