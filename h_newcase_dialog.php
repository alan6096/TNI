<script>
$(document).ready(function()
{
	$('#ac_search2').autocomplete({
      	source: "user_autocomplete_process.php",
      	minLength: 1,
      	select: function( event, ui ) 
      	{
      		//alert( ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value );
      		//getjsonvalue("id="+ui.item.id+"&table=hd_user&tb_field=telephone,email,company_id","table=hd_company&tb_field=name","company_id");
      		$("#user_id").val(ui.item.id); /* save it here to use it on submit :current_id later */
      		//alert(ui.item.id);
      		$("#temp_user").text(ui.item.id);
      	}
    });
    
    $('#showall2').click(function()
	{
		$("#ac_search2").autocomplete( "search", "%" );
		$("#ac_search2").focus();
	});
});		
</script>
<?php
session_start();
include 'h/h_engine.php';

$myform = new form("form2");
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