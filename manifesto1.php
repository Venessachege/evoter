<?php
### update database ###
foreach($HTTP_POST_VARS as $sForm => $value)
{
mysql_connect($server,$user,$password) or die("Database error");
mysql_select_db($database);
mysql_query("UPDATE `table` SET `field` = '".$HTTP_POST_VARS[$sForm]."'");
}
### end update database ###
?>