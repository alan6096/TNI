<?php
include 'h/h_session.php'; 
include 'skdb/skdb.php';

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

<form id='tni_form' method='post'>
<table> 
    <tr>
        <td><label>Skill Development Areas:</label></td>
        <td><label class="emp" id="skill_development"></label></td>
    </tr>
    <tr>
        <td><label>Job Skill Profile:</label></td>
        <td><label class="emp" id="skill_job"></label></td>
    </tr>
    <tr>
        <td><label>Personal Skill Profile:</label></td>
        <td><label class="emp" id="skill_personal"></label></td>
    </tr>
    <tr>
        <td><label>Microsoft Office Training:</label></td>
        <td><label class="emp" id="category_office"></label></td>
    </tr>
    <tr>
        <td><label>Application:</label></td>
        <td><label class="emp" id="category_application"></label></td>
    </tr>
    <tr>
        <td><label>Software:</label></td>
        <td><label class="emp" id="category_software"></label></td>
    </tr>
    <tr>
        <td><label>IT Knowledge:</label></td>
        <td><label class="emp" id="category_os"></label></td>
    </tr>
    <tr>
        <td><label>General Knowledge:</label></td>
        <td><label class="emp" id="category_general"></label></td>
    </tr>
    <tr>
        <td><label>Others :</label></td>
        <td><label class="emp" id="other"></label></td>
    </tr>
    <tr>
        <td><label>Target Date:</label></td>
        <td><label class="emp" id="target_date"></label></td>
    </tr>

</table></form>
<button id="detail_new">New</button><button id="detail_edit">Edit</button>
<input type="hidden" id="idexist" value="<?php echo userexist(); ?>" />
