<?php include 'headImports.php'; ?>
    <!DOCTYPE html>

<html>

    <head>


        <title>Townsville Children's Hospital - Reports</title>

        <?php
        require_once 'include.php';

        if (!signed_in()) {
            include 'login.php';
            exit();
        }


        if ((userAccessLvl() != "0")) {
            $error = 'Only the hospital administrator may access this page.';
            include 'accessDenied.php';
            exit();
        }

        $sql = "SELECT SUM(invoice_owing) AS Total FROM patient_details";
        $result = query($sql);
        $invoiceTotal = mysql_fetch_array($result);
        $sql1 = "SELECT SUM(cost) AS TotalServices FROM patient_billing";
        $result1 = query($sql1);
        $invoiceTotal1 = mysql_fetch_array($result1);
        $paid1 = $invoiceTotal1[0];
        $paid2 = $invoiceTotal[0];
        $paid = $paid1 - $paid2;
        $owing = $paid1 - $paid;

        ?>

<div id="wrapper">

<?php include 'header.php'; ?>


    <div id="main_container">

        <div id="right_container" class="panel panel-default">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Patients</a></li>
                <li class="active">Patient Details</li>
            </ol>
			
<?php			

			
			
			echo '<ul id="user_information">
        		<li><h2><small>Finances:</small></h2></li>';
				
				echo "<li>The hospital has billed $$invoiceTotal1[0] worth of services.</li>";
				
				echo "<li>Of this $$paid has been paid to the hospital.</li>";
				
				echo "<li>With $$owing still owing to the hospital. </li>";
				
			$sql2 = "SELECT COUNT(patient_id) AS Numberofpatients FROM patient_details";
			$result2 = query($sql2);
			$numberOfPatients = mysql_fetch_array($result2);
			
			$sql3 = "SELECT COUNT(patient_id) AS NumberofpatientsTreated FROM patient_history";
			$result3 = query($sql3);
			$numberOfPatientsHelped = mysql_fetch_array($result3);
			
			echo '
        		<li><h2><small>Patients:</small></h2></li>';
				
			echo "<li>The hospital has $numberOfPatients[0] listed in its databases.</li>";
			
			echo "<li>The hospital has helped $numberOfPatientsHelped[0] patients.</li>";
			
			$sql4 = "SELECT COUNT(patient_id) AS Numberoftests FROM testing_request";
			$result4 = query($sql4);
			$numberOfTests = mysql_fetch_array($result4);
			
			
			echo '
        		<li><h2><small>Tests:</small></h2></li>';
				
				echo "<li>The doctors have ordered total of $numberOfTests[0] tests.</li>";
				
			$sql5 = "SELECT COUNT(*) AS NumberofStaff FROM staff";
			$result5 = query($sql5);
			$numberOfStaff = mysql_fetch_array($result5);	
			$sql6 = "SELECT COUNT(*) AS NumberofStaff FROM staff WHERE role='Doctor';";
			$result6 = query($sql6);
			$numberOfDocs = mysql_fetch_array($result6);	
				
			echo '
        		<li><h2><small>Staff:</small></h2></li>';
				
				echo "<li>The hospital has $numberOfStaff[0] staff.</li>";
				echo "<li>The hospital has $numberOfStaff[0] Doctors.</li>";
				
			$sql7 = "SELECT COUNT(*) AS NumberofBedsAvailable FROM bed_status WHERE in_use='0';";
			$result7 = query($sql7);
			$numberOfBedsAvailable = mysql_fetch_array($result7);
			
			$sql8 = "SELECT COUNT(*) AS NumberofBeds FROM bed_status ";
			$result8 = query($sql8);
			$numberOfBeds = mysql_fetch_array($result8);
				
			echo '
        		<li><h2><small>Resources:</small></h2></li>';
				
				echo "<li>The hospital has $numberOfBedsAvailable[0] beds available.</li>";
				echo "<li>With a total of $numberOfBeds[0] beds. </li>";
			
			
			echo '</ul>';
				
				
				
				