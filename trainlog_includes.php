<?php

require ('trainlog_variables.php');

if (!(function_exists('connect_to_mysql'))){

	function connect_to_mysql(){

		global $db_location,$db_username,$db_password,$db_database;

		$conn = mysql_connect("$db_location","$db_username","$db_password"); 
		if (!$conn) die("Error: " . mysql_error()); 
		mysql_select_db($db_database,$conn) or die("Error: " . mysql_error());

		return;
	}
}

if (!(function_exists('connect_to_mysql'))){

	function error_message($text){

		echo"<p align='left' class='errortext'><br><b><span style='background-color: #FF6666'>Error:</span></b><br>$text</p>";

		return;

	}

}

function admin_header(){

	global $admin_font;
	$admin_font="verdana, arial";

	echo"<html>";
	echo"<head>";
	echo"<title>TrainLog Admin Area</title>";
	echo"<style type='text/css'>";
	echo"a:hover {color: #400080; text-decoration: underline;}";
	echo".banner {font-size: 24pt; font-family: $admin_font; font-weight: bold;}";
	echo".title {font-size: 16pt; font-family: $admin_font;}";
	echo".subheading {font-size: 11pt; font-family: $admin_font; font-weight: bold;}";
	echo".prose {font-size: 9pt; font-family: $admin_font;}";
	echo".errortext {font-size: 8pt; font-family: $admin_font;}";
	echo".smallprint {font-size: 7pt; font-family: $admin_font;}";
	echo"</style>";
	echo"</head>";
	echo"<body bgcolor='#EEEEEE' text='#000000' link='#0000FF' vlink='#0000FF' alink='#400080'>";

	echo"<font class=banner>TrainLog</font>";
	echo"<br><table width='95%' border='0' cellpadding='5' cellspacing='0' style='border: 1 solid #000000;'><tr><td bgcolor='#FFFFFF'>";

	return;
}

function admin_footer(){

	global $version;
	
	echo"<font class='smallprint'><br><br>Powered by TrainLog version <a href='http://www.iammike.org/index.php?loc=about_tl'><b>$version</b></a>";

	echo"</td></tr></table></center></body></html>";

	return;

}

function admin_links(){
	
	echo"<font class='prose'><a href='$_SERVER[PHP_SELF]?to_do=new_entry'>Add New Entry</a> | <a href='$_SERVER[PHP_SELF]?to_do=view_entry'>View/Edit/Delete Entries</a> | <a href='$_SERVER[PHP_SELF]?to_do=logout'>Log Out</a><br><br><br></font>";

	return;

}

function admin_login_check($q_admin_u,$q_admin_p){

	global $admin_username, $admin_password;

	$admin_password = md5($admin_password);

	if ($q_admin_u == $admin_username AND $q_admin_p == $admin_password){
		return TRUE;
	}
	else {
		return FALSE;
	}	

}

function admin_login_form(){

	echo"<p align='center' class='title'>Please Login</p>";
	echo"<center>";
	echo"<table width='75%' border='0' cellpadding='3' cellspacing='0' style='border: 1 solid #000000;'>";
	echo"<tr>";
	echo"<td align='center' class='prose'>";
	echo"<form action='$_SERVER[PHP_SELF]' method='post'>";
	echo"<input type='hidden' name='to_do' value='process_login'>";
	echo"Username: <input type='text' name='q_admin_u'><br>";
	echo"Password: <input type='password' name='q_admin_p'><br><br>";
	echo"<input type='submit' value='Login to TrainLog Admin Area'>";
	echo"</td>";
	echo"</form>";
	echo"</tr>";
	echo"</table>";
	echo"</center>";

return;

}

?>
