<?php 
include 'h/h_session.php'; 
include 'h/h_engine.php';
include 'skdb/skdb.php';
?>
<!DOCTYPE HTML>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
<html>
<head>
<style>
    .setting_c { margin:20px}
</style>    
<link type="text/css" href="css/smoothness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/h_dialogform.css">
<link rel="stylesheet" type="text/css" href="css/h_table.css">
<link rel="stylesheet" type="text/css" href="css/h_pagination.css">

<script src="js/jquery.js"></script>
<script type="text/javascript" src="h/h_getjson.js"></script>
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>

<script>
$(document).ready(function()
{$.ajaxSetup({cache: false});

        $('body').append('<div id=\"tablehere\"></div>');
        $("#tablehere").empty();
        $("#tablehere").html("<div class='setting'><?php echo loopdiv(); ?></div>");
        $("#setting1").load("h_crud.php",{table:"category_office",table_col:"name",table_header:"MS Office",classname:"setting_table1"});
        $("#setting2").load("h_crud.php",{table:"category_application",table_col:"name",table_header:"Application",classname:"setting_table2"});
        $("#setting3").load("h_crud.php",{table:"category_os",table_col:"name",table_header:"OS Knowledge",classname:"setting_table3"});
        $("#setting4").load("h_crud.php",{table:"userlogin",table_col:"username,useicon_hide:role",table_header:"Username,Admin",select_option:"role+Admin+No&Yes",classname:"setting_table4"});
              
});
</script>
</head>
<body>
</body>
</html>
<?php
function loopdiv()
{
	for ($i=1; $i <= 10; $i++) 
	{ 
		$temp .= "<div class='setting_c' id='setting$i'></div>";
	}
	return $temp;
}	
?>