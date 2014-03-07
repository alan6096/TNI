<!DOCTYPE HTML>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
<html>
<head>
<link type="text/css" href="css/smoothness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/h_dialogform.css">

<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>    

<script>
$(document).ready(function()
{
	$("#dialog1").dialog
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
                    $("#dialog1").dialog( "close" );
                },
                Add: function()
                {
                    //$("#user_id").remove();
                    $("#user_id").val("");
                    var user_id = $("#temp_user").text();
                    $("#form2").append("<input type='text' id='user_id' name='user_id' value='"+user_id+"' style='display:none' />");
                    //alert($("#form2").serialize());
                    
                    $.post("h/h_sql_crud.php?mode=create&table=h_ticket",$("#form2").serialize(), function(data)
                    //$.post("z/z_sql_crud.php22?table=hd_mileage&db=helpdesk1",$("#form2").serialize(), function(data) 
                    {
                        $("#dialog1").dialog( "close" );
                        start_this_first();
                        //alert($("#form2").serialize());          
                    });
                }
            }
        });
	$('#emp_cancel').hide();
	$('#emp_edit').click(function()
    {
        //$("#dialogcontent1").load("h_newcase_dialog.php");
        //$("#dialog1").dialog("open");
        $('.emp').each(function() 
        {
        	var label_id = "#"+this.id;
        	var txt = $(label_id).text();
	        $(label_id).replaceWith("<input type='text' class='emp' id='"+this.id+"' name='"+this.id+"' />");
	        $(label_id).val(txt);//alert($(label_id).val())
        });
        $('#emp_edit').hide();$('#emp_cancel').show();
    });
    
    $('#emp_cancel').click(function()
    {
    	$('.emp').each(function() 
        {
        	var label_id = "#"+this.id;
        	var txt = $(label_id).val();
	        $(label_id).replaceWith("<label class='emp' id='"+this.id+"'>"+txt+"</label>");
        });
        $('#emp_edit').show();$('#emp_cancel').hide();
    });
    
    $('#emp_save').live("click",function()
    {
    	alert($('#form2').serialize());
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
		<td><label class="emp" id="emp_name">a</label></td>
	</tr>
	<tr>
		<td><label>Designation:</label></td>
		<td><label class="emp" id="emp_designation"></label></td>
	</tr>
	<tr>
		<td><label>Division:</label></td>
		<td><label class="emp" id="emp_division"></label></td>
	</tr>
	<tr>
		<td><label>City:</label></td>
		<td><label class="emp" id="emp_city"></label></td>
	</tr>
</table></form>
<button id="emp_edit">Edit</button><button id="emp_cancel">Cancel</button><button id="emp_save">Save</button>

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
<div id="dialog1"><div id="dialogcontent1"></div></div>
<div id="temp_user"></div>
</body>
</html>