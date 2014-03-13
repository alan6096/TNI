<?php
echo is_numeric("a");
$str = "tbl_employee.dept_id=tbl_department.id&tbl_department.sbu_id=tbl_sbu.id";
jointable($str,$table,$id);

function jointable($myarray,$table,$id) //join:tbl_employee.dept_id=tbl_department.id&tbl_department.sbu_id=tbl_sbu.id
{
    $content1="";$content2="";
	$fullarray = explode("&", $myarray);
	  
	if(isset($fullarray[0]))
	{
	$content1 = $fullarray[0];
	    $content1_array = explode("=", $content1);
	    $content_value_left = $content1_array[0];
	        //$content_value_left_array = explode(".", $content_value_left);
	        //$table1 = $content_value_left_array[0];
	        $table1_field = $content_value_left;//$content_value_left_array[1];
	    
	    $content_value_right = $content1_array[1];
	        $content_value_right_array = explode(".", $content_value_right);
	        $table2 = $content_value_right_array[0];
	        $table2_field = $content_value_right_array[1];
	        
	}
	
	echo $table2_field;
}
?>