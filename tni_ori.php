<?php session_start();include 'h/h_engine.php'; ?>
<!DOCTYPE HTML>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
<html>
<head>
<link type="text/css" href="css/smoothness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/h_dialogform.css">

<script src="js/jquery.js"></script>
<script type="text/javascript" src="h/h_getjson.js"></script>
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>

<script>
$(document).ready(function()
{$.ajaxSetup({cache: false});
    var id = 1;
    <?php
    echo 'getjsonvalue("id="+id+"&'.getall_table_detail("employee").'","form2");';
    ?>
    
    //getjsonvalue("id="+id+"&table=employee&tb_field=name","form2");
    
	$("#tni_dialog_new").dialog
    ({
            autoOpen: false,
            width:"680px",resizable: false,
            modal: true,
            position:"center",
            buttons: 
            {
                Cancel: function()
                {
                    //$("#dialogcontent1").empty();
                    $("#tni_dialog_new").dialog( "close" );
                },
                Add: function()
                {                   
                    $.post("h/h_sql_crud.php?mode=create&table=employee",$("#tni_dialog_form").serialize(), function(data)
                    {
                        //var obj = $.parseJSON(data);
                        //alert(obj.content);
                        alert( "Data Loaded: " + data );
                        $("#tni_dialog_new").dialog( "close" );        
                    });
                }
            }
        });
        
    $('#tni_edit').click(function()
    {
    var id=1;
        $("#dialogcontent1").load("tni_dialog.php");
        $("#tni_dialog_new").dialog("open");
        <?php
    //echo 'getjsonvalue("id="+id+"&'.getall_table_detail("employee").'","tni_dialog_form");';
    ?>
    });            
        
	$('#emp_cancel').hide(); /* hide the button design */
	$('#emp_save').hide();
	
	$('#emp_edit').click(function()
    {
        //$("#dialogcontent1").load("h_newcase_dialog.php");
        //$("#tni_dialog_new").dialog("open");
        $('.emp').each(function() 
        {
        	var label_id = "#"+this.id; /* to get id ege: $("#blabal") */
        	var txt = $(label_id).text();
	        $(label_id).replaceWith("<input type='text' class='emp' id='"+this.id+"' name='"+this.id+"' />");
	        $(label_id).val(txt);//alert($(label_id).val())
        });
        $('#emp_save').show();
        $('#emp_edit').hide();
        $('#emp_cancel').show();
    });
    
    $('#emp_cancel').click(function()
    {
    	$('.emp').each(function() 
        {
        	var label_id = "#"+this.id;
        	var txt = $(label_id).val();
	        $(label_id).replaceWith("<label class='emp' id='"+this.id+"'>"+txt+"</label>");
        });
        $('#emp_save').hide();
        $('#emp_edit').show();
        $('#emp_cancel').hide();
    });
    
    $('#emp_save').live("click",function()
    {
    	alert($('#form2').serialize());
    	$.post("h/h_sql_crud.php?mode=create&table=employee",$("#form2").serialize(), function(data)
    	{
			$("#tni_dialog_new").dialog( "close" );         
		});
    });	
    //alert($('.emp').size());
    
});		
</script>
</head>
<body>
<div style="width:600px">
<div id="content1" style="float:left"><form id='form2' method='post'>
<table>
	<tr>
		<td><label>Name:</label></td>
		<td><label class="emp" id="name">a</label></td>
	</tr>
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
<button id="emp_edit">Edit</button><button id="emp_save">Save</button><button id="emp_cancel">Cancel</button>

</div>

<div id="content2" style="float:right"><form id='tni_form' method='post'>
<table>	
	<tr>
		<td><label>Skill Development Areas:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>Personal Skill Profile:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>Training Required:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>Microsoft Office Training:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>Application:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>Software:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>I.T. Knowledge:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>General Knowledge:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>Others :</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
	<tr>
		<td><label>Target Date:</label></td>
		<td><input id="emp" type="text" value="" /></td>
	</tr>
</table></form>
<button id="tni_edit">Edit</button>
</div>
</div>
<div id="tni_dialog_new"><div id="dialogcontent1"></div></div>
<div id="temp_user"></div>
</body>
</html>