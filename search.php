<?php
error_reporting(0);
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MySQL table search</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<style>
BODY, TD {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
</head>


<body>

<form id="form1" name="form1" method="post" action="search.php">

 <label>Title:</label>
<input type="text" name="string" id="string" value="<?php echo stripcslashes($_REQUEST["string"]); ?>" />
<label>Categories:</label>
<select name="kategori_asnaf">
<option value="">--</option>
<?php
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." GROUP BY kategori_asnaf ORDER BY kategori_asnaf";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	while ($row = mysql_fetch_assoc($sql_result)) {
		echo "<option value='".$row["kategori_asnaf"]."'".($row["kategori_asnaf"]==$_REQUEST["kategori_asnaf"] ? " selected" : "").">".$row["kategori_asnaf"]."</option>";
	}
?>
</select>
<label>Negeri:</label>
<select name="negeri">
<option value="">--</option>
<?php
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." GROUP BY negeri ORDER BY negeri";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	while ($row = mysql_fetch_assoc($sql_result)) {
		echo "<option value='".$row["negeri"]."'".($row["negeri"]==$_REQUEST["negeri"] ? " selected" : "").">".$row["negeri"]."</option>";
	}
?>
</select>
<input type="submit" name="button" id="button" value="Filter" />
  </label>
  <a href="search.php"> 
  reset</a>
</form>
<br /><br />
<table width="700" border="1" cellspacing="0" cellpadding="4">
  <tr>
    
    <td width="159" bgcolor="#CCCCCC"><strong>Title</strong></td>
    
    <td width="113" bgcolor="#CCCCCC"><strong>Categories</strong></td>

    <td width="113" bgcolor="#CCCCCC"><strong>City</strong></td>
  </tr>
<?php
if ($_REQUEST["string"]<>'') {
	$search_string = " AND (nama_ketua_keluarga LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' )";	
}
if ($_REQUEST["kategori_asnaf"]<>'') {
	$search_city = " AND kategori_asnaf='".mysql_real_escape_string($_REQUEST["kategori_asnaf"])."'";	
}
if ($_REQUEST["negeri"]<>'') {
	$search_citys = " AND negeri='".mysql_real_escape_string($_REQUEST["negeri"])."'";	
}


	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE id_rumah_asnaf>0".$search_string.$search_city.$search_citys;


$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
if (mysql_num_rows($sql_result)>0) {
	while ($row = mysql_fetch_assoc($sql_result)) {
?>
  <tr>
    
    <td><?php echo $row["nama_ketua_keluarga"]; ?></td>
    
    <td><?php echo $row["kategori_asnaf"]; ?></td>

    <td><?php echo $row["negeri"]; ?></td>
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="5">No results found.</td>
<?php	
}
?>
</table>




</body>
</html>