<?php 
include 'h/h_session.php'; 
include 'h/h_engine.php';
include 'skdb/skdb.php';
?>
<!DOCTYPE HTML>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
<html>
<head>
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

loaddiv();
function loaddiv()
{	
	$("#content2").load("admin_tni_html.php",function() /* use this to load html ajax and execute after finsih loading */
	{
		$('#detail_edit').hide();
	    var userexist = $("#idexist").val(); /* if id exist no new entry else allowed new entry */
	   	
	    if(userexist!="")
	    {
	        $('#detail_new').hide();
	        $('#detail_edit').show();
	    }
	    
	    <?php 
		if(isadmin()==1)
			echo "$('#detail_new').show();";
		?>;

	   // do other stuff load is completed
	});
}



    $('body').append('<div id=\"tablehere\"></div>');
    $("#tablehere").empty();
    $("#tablehere").html("<div class='setting'><?php echo loopdiv(); ?></div>");
    
    //var table_col = "id,skill_development,other,target_date,date_created,date_updated,category_office,category_application,category_sotfware,category_os,category_general";
    //var table_header = "Staff Username,Skill Development Areas,Job Skills Profile,Others,Target Date, Date Created, Date Updated,";
    $("#content1").load("h_crud.php",{table:"employee_tni",table_col:"id,staff_username,skill_development,skill_job,skill_personal,join:category_office+category_office.name,category_application,category_software,category_os,category_general,other,target_date,date_created,date_updated",table_header:"MS Office,Created By,Skill Development Areas,Job Skill Profile,Personal Skill Profile,Microsoft Office Training,Application,Software,IT Knowledge,General Knowledge,Others,Target Date,Date Created,Last Update", select_option:"category_office+Category Office++category_office.name", classname:"setting_table1"});
	//$("#content1").load("h_crud.php",{table:"employee_tni",table_col:"id,staff_username,skill_development,other,target_date,date_created,date_updated,skill_job,skill_personal,join:category_office+category_office.name,category_application,category_software,category_os,category_general",table_header:"Staff Username, Created By,Skill Development Areas,Others,Target Date,Date Created,Last Update,Skill Development Areas,Job Skill Profile,Personal Skill Profile,Microsoft Office Training,Application,Software,OS Knowledge,General Knowledge", select_option:"category_office+Category Office++category_office.name", classname:"setting_table1"});

	$('#myupdateemployee_tniemployee_tnisetting_table1').live("click",function()
    {
    	var id = $("#temp_id").text();
        $('#dialogcontent_tni_dialog_form_edit').load('admin_tni_dialog.php?mode=edit');
        $('#tni_dialog_form_editid').dialog('open');
        getjsonvalue('id='+id+'&table=employee_tni&tb_field=id,staff_username,skill_development,skill_job,skill_personal,category_office,category_application,category_software,category_os,category_general,other,target_date,date_created,date_updated','tni_dialog_form_edit');
        $('#myupdateemployee_tniemployee_tnisetting_table1').dalog('close');  
    });
    
<?php

	$id = $_SESSION['id'];
	$sqltable_detail = getall_table_detail("employee_tni");
	$updatemainform = "getjsontext('id=$id&$sqltable_detail','tni_form','category_office=category_office.id,category_os=category_os.id');";
	echo $updatemainform;
?>
        
    $('#setting').click(function()
    {
        window.location.href = "setting.php";      
    });
        
    
<?php
//$username = $_SESSION['username'];
	dialog_new("detail_new","tni_dialog_form_create","employee_tni","admin_tni_dialog.php?mode=create",$updatemainform);
	dialog_edit("detail_edit","tni_dialog_form_edit","employee_tni","$id","admin_tni_dialog.php?mode=edit",$updatemainform);
?>        
});

<?php
function loopdiv()
{
    for ($i=1; $i <= 10; $i++) 
    { 
        $temp .= "<div class='setting_c' id='setting$i'></div>";
    }
    return $temp;
}   

function isadmin()
{
	$username = $_SESSION['username'];
	$rs= new sksql("userlogin");
	$rs->whereadd("username='$username'");
	$rs->find();
	
	$row = $rs->fetch();
	return $row->role;
	//$rs->id=$row->id;
	//$rs_link = $rs->getlink($param[0],$param[1],$param[2]);
	//return $rs_link->name;
}

function dialog_new($button_id,$dialogform,$sqltable,$url,$updatemainform)
{
    $dialogid = "$dialogform" . "id";
    $sqltable_detail = getall_table_detail($sqltable);
    echo "
    $('body').append('<div id=\"$dialogid\"><div id=\"dialogcontent_$dialogform\"></div></div>');
    $('#$dialogid').dialog
    ({
            autoOpen: false,
            width:'680px',resizable: false,
            modal: true,
            position:'center',
            buttons: 
            {
                Cancel: function()
                {
                    $('#$dialogid').dialog( 'close' );
                },
                Add: function()
                {                   
                    $.post('h/h_sql_crud.php?mode=create&table=$sqltable',$('#$dialogform').serialize(), function(data)
                    {
                        $('#$dialogid').dialog( 'close' );
                        loaddiv(); /* load tni_html.php again to do the ajax */
						$updatemainform   
                    });
                }
            }
        });
        
    $('#$button_id').live('click',function()
    {
        $('#dialogcontent_$dialogform').load('$url');
        $('#$dialogid').dialog('open');
    });
    ";
}

function dialog_edit($button_id,$dialogform,$sqltable,$id,$url,$updatemainform)
{
    $dialogid = "$dialogform" . "id";
    $sqltable_detail = getall_table_detail($sqltable);
    echo "
    $('body').append('<div id=\"$dialogid\"><div id=\"dialogcontent_$dialogform\"></div></div>');
    $('#$dialogid').dialog
    ({
            autoOpen: false,
            width:'980px',resizable: true,
            modal: true,
            position:'center',
            buttons: 
            {
                Cancel: function()
                {
                    $('#$dialogid').dialog( 'close' );
                },
                Add: function()
                {                   
                    $.post('h/h_sql_crud.php?mode=update&table=$sqltable',$('#$dialogform').serialize(), function(data)
                    {
                    	//var obj = $.parseJSON(data);
                        //alert(obj.content);
                    	//alert('Data Loaded: ' + data );
                        $('#$dialogid').dialog( 'close' );
                        //getjsontext('id=$id&$sqltable_detail','tni_form','category_office=category_office.id,category_os=category_os.id');
                        $updatemainform
                    });
                }
            }
        });
		
    $('#dialogcontent_$dialogform').load('$url'); /* must put outside here to avoid form load at different angle */
    $('#$button_id').live('click',function()
    {
        $('#$dialogid').dialog('open');
        //getjsonvalue('id='+$id+'&$sqltable_detail','$dialogform');
        getjsonvalue('id=$id&$sqltable_detail','$dialogform');
    });        
    ";
}

?>
</script>
</head>
<body>
<div  style="float:right">
    Welcome, <?php echo $_SESSION['name']; ?> 
    <a href="ldap_status.php?status=logout">Logout</a>
    <button id="setting">Setting</button>
</div>    
    
<div style="width:600px">
<div id="content3"></div>	
	
<div id="content1" style="float:left"><form id='form2' method='post'>
   
<table>
    <tr>
        <td><label>Designation:</label></td>
        <td><label class="emp" id="designation"></label></td>
    </tr>
    <tr>
        <td><label>Division:</label></td>
        <td><label class="emp" id="division"></label></td>
    </tr>
    <tr>
        <td><label>City:</label></td>
        <td><label class="emp" id="city"></label></td>
    </tr>
</table></form>
<button id="emp_edit">Edit</button>

</div>

<div id="content2" style="float:right">
</div>
</div>

<div id="temp_user"></div>
</body>
</html>
<?php
function userexist()
{
    $username = $_SESSION['id'];
    $rs= new sksql("employee_tni");
    $rs->whereadd("id='$username'");
    $rs->find();
    $row = $rs->fetch();
    return $row->id;
}
?>
