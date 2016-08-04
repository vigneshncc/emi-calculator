<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Viewer Detail</title>

</head>



<body>

<?php

include_once "db.php";



  $data = mysql_query("SELECT * FROM emi_log WHERE ip<>'117.193.3.76'  AND ip<>'117.193.2.210' AND ip<>'117.193.16.104' AND ip<>'117.193.7.150'" );

    print "<table width=600 border=1 style='border-collapse:collapse;'>";

	?>

    <tr style="font:14px arial;background-color:#C0C0C0;color: #000000;">

    <td>Sno</td>

    <td>IP</td>

    <td>City</td>

    <td>Time</td>

    </tr>

    <?php 

	

while ($get_info = mysql_fetch_row($data))

{

print "<tr>\n";

print "\t<td>1</td>";

foreach ($get_info as $field)

print "\t<td>$field</td>\n";

print "</tr>\n";

}

print "</table>\n";

?>

</body>

</html>