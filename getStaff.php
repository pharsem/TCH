<?php
session_start();

require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

$q = escape($_GET["q"]);


echo "

<div class='panel panel-default'>
  <div class='panel-heading'><h2><small>Patient search results</h2></small></div>
  <div class='panel-body'>
    <p>To find out more information about a staff member click 'view/edit'.</p>
  </div>
  
<table class='table'>
    <tr>
        <th>First name</th>
        <th>Surname</th>
        <th>Username</th>
        <th>Role</th>
        <th>Access level</th>
        <th>View/edit</th>
    </tr>
</div>
";


$sql = "SELECT * FROM staff WHERE first_name LIKE '%" . $q . "%' OR surname LIKE '%" . $q . "%'";

$result = query($sql);

while ($row = mysql_fetch_array($result)) {
    echo '<tr>
				<td>' . $row[0] . '</td>
				<td>' . $row[1] . '</td>
				<td>' . $row[3] . '</td>
				<td>' . $row[2] . '</td>
				<td>' . $row[4] . '</td>
				<td><a href="singleStaff.php?staff_username=' . $row[3] . '">View/edit</a></td>
			</tr>';
}

echo "</table>";

?>