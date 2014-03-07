<?php
session_start();
include 'h/h_engine.php';

$myform = new form("tni_dialog");
$myform->begin("tableform");
echo "<tr><th>Name:</th><td colspan=3><input type='text' id='ac_search2' name='ac_search2' /></td><td><input type='button' id='showall2' value='+'></td></tr>";
$myform->input_text("a", "track_id","hide",unique_generatecode());
$myform->input_text("Date Created", "datecreated","hide",date("Y-m-d H:i:s"));
$myform->select_option("category,Category,,hd_category,category");
$myform->select_option("priority,Priority,,hd_priority,priority");
$myform->input_text("Subject", "subject");
$myform->textarea("Issue", "issue");
$myform->input_text("", "assignee_id","hide",$_SESSION['USERID']);
$myform->end();
?>