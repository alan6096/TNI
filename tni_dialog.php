<?php
include 'h/h_engine.php';

$myform = new form("tni_dialog_form");
$myform->begin("tableform");
//$myform->input_text("Name", "name");
$myform->input_text("Designation", "designation");
$myform->input_text("Division", "division");
$myform->input_text("City", "city");
$myform->end();
?>