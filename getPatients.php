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
    <p>To find out more information about a patient click 'view/edit'.</p>
  </div>
  
<table class='table'>
    <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Surname</th>
        <th>Date of Birth</th>
        <th>Nationality</th>
        <th>Gender</th>
        <th>View/edit</th>
    </tr>
</div>
";


$sql = "SELECT * FROM patient_details WHERE first_name LIKE '%" . $q . "%' OR surname LIKE '%" . $q . "%'";

$result = query($sql);

while ($row = mysql_fetch_array($result)) {
    echo '<tr>
				<td>' . $row[0] . '</td>
				<td>' . $row[1] . '</td>
				<td>' . $row[2] . '</td>
				<td>' . $row[3] . '</td>
				<td>' . $row[4] . '</td>
				<td>' . $row[5] . '</td>
				<td><a href="singlePatient.php?patient_id=' . $row[0] . '">View/edit</a></td>
			</tr>';
}

echo "</table>";

?>