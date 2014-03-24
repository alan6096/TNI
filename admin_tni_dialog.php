<?php
$mode = $_GET['mode'];
include 'h/h_session.php';
include 'h/h_engine.php';

$myform = new form("tni_dialog_form_$mode"); /* print $mode for dialog jquery selection */
$myform->begin("tableform");
$myform->input_text("ID", "id","");
$myform->input_text("Skill Development Areas", "skill_development");
$myform->select_option("skill_job,Job Skills Profile,,skill_job,name");
$myform->select_option("skill_personal,Personal Skill Profile,,skill_personal,name");
$myform->select_option("category_office,Microsoft Office Training,,category_office,name");
$myform->select_option("category_application,Application,,category_application,name");
$myform->select_option("category_software,Software,,category_software,name");
$myform->select_option("category_os,IT Knowledge,,category_os,name");
$myform->select_option("category_general,General Knowledge,,category_general,name");

$myform->input_text("Others", "other");
$myform->input_text("Target Date", "target_date");

$myform->input_text("Username", "staff_username","hide",$_SESSION['username']);
if($mode=="create")
$myform->input_text("Date Created", "date_created","hide2",date("Y-m-d H:i:s"));
if($mode=="edit")
$myform->input_text("Date Updated", "date_updated","hide2",date("Y-m-d H:i:s"));
$myform->end();
?>