<?php

$db = mysqli_connect("localhost", "root", "", "pma");
if(!$db){
	die("Error 1 : Contact Administrator.");
}
execute_query("SET NAMES utf-8", $db);
execute_query("SET CHARACTER SET utf-8", $db);	

function execute_query($query){
	global $db;
	$result = mysqli_query($db, $query);
	return $result;
}

function insert_id($db=''){
	global $db;
	return mysqli_insert_id($db);
}

function select_data($table, $fields, $where='', $join='', $join_on='', $union='', $union_cols=''){
	
}

function update_data($table, $fields, $values, $where){
	
}

function delete_data($table, $fields, $values, $where){
	
}

?>