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
//$('#content3').load("tni_html.php");
loaddiv();
function loaddiv()
{	
	$("#content2").load("tni_html.php",function() /* use this to load html ajax and execute after finsih loading */
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


    var id = '<?php echo $_SESSION['username']; ?>';
    <?php
    //echo 'getjsontext("id="+id+"&'.getall_table_detail("employee_tni").'","tni_form","category_office=category_office.id,category_os=category_os.id");';
	//echo "getjsontext('id=$id&$sqltable_detail','tni_form','category_office=category_office.id,category_os=category_os.id');"
	//echo 'getjsonvalue("id=\'"+id+"\'&'.getall_table_detail("employee_tni").'","tni_form");';
	
	$id = $_SESSION['id'];
	$sqltable_detail = getall_table_detail("employee_tni");
	//$updatemainform = "getjsontext('id=$id&$sqltable_detail','tni_form','category_office=category_office.id,category_os=category_os.id');";
	$updatemainform = "getjsontext('id=$id&$sqltable_detail','tni_form','category_office=category_office.id,category_os=category_os.id');";
	echo $updatemainform;
    ?>
    
    //getjsonvalue("id="+id+"&table=employee&tb_field=name","form2");
    
    $('#setting').click(function()
    {
        window.location.href = "setting.php";      
    });
    
    
    
    
    
<?php
//$username = $_SESSION['username'];
	dialog_new("detail_new","tni_dialog_form_new","employee_tni","tni_dialog_new.php",$updatemainform);
	dialog_edit("detail_edit","tni_dialog_form_edit","employee_tni","$id","tni_dialog_edit.php",$updatemainform);
?>        
});

<?php
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
        
    $('#$button_id').live('click',function()
    {
        $('#dialogcontent_$dialogform').load('$url');
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
