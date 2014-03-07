<?php
 
// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
	exit;
 
// connect to the database server and select the appropriate database for use
$dblink = mysql_connect('localhost', 'root', 'wmlevel5') or die( mysql_error() );
mysql_select_db('helpdesk1');
 
// query the database table for zip codes that match 'term'
$rs = mysql_query('select * from hd_user where name like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by name', $dblink);
 
// loop through each zipcode returned and format the response for jQuery
$data = array();
if ( $rs && mysql_num_rows($rs) )
{
	while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
	{
		$data[] = array(
			'label' => $row['name'] .', '. $row['email'] .', '. $row['telephone'] ,
			'value' => $row['name'],'id' => $row['id'],'email' => $row['email'],'telephone' => $row['telephone']
		);
	}
}
 
// jQuery wants JSON data
echo json_encode($data);
flush();
