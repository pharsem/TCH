<?php
require('fpdf17/fpdf.php');
require_once 'include.php';

class PDF extends FPDF
{

    function Header()
    {
        global $patientDetails;
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(90, 10, "Patient Details: $patientDetails[1] $patientDetails[2]", 0, 0);
        $this->Cell(90, 10, "ID: $patientDetails[0]", 0, 0, 'R');
        // Line break
        $this->Ln();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 5, "Date of Birth: $patientDetails[3]", 0, 0, 'L');
        $this->Cell(60, 5, "Nationality: $patientDetails[4]", 0, 0, 'C');
        $this->Cell(60, 5, "Gender: $patientDetails[5]", 0, 0, 'R');
        $this->Ln();
        $this->Cell(90, 5, "Address: $patientDetails[7]", 0, 0, 'L');
        $this->Cell(90, 5, "Contact Number: $patientDetails[6]", 0, 0, 'R');
        $this->Ln();
        $this->Cell(60, 5, "Emergency Contact: $patientDetails[8] : $patientDetails[9]", 0, 0, 'L');
        $this->Ln(10);

    }

    function PatientHistory($result1)
    {

        $this->SetFont('Arial', 'B', 16);
        $this->Cell(90, 10, "Patient History:", 0, 0);
        $this->Ln();
        $this->SetFont('Arial', 'B', 10);
        while ($patientHistory = mysql_fetch_row($result1)) {
            $this->Cell(90, 5, "Date Admitted: $patientHistory[3]", 0, 0);
            $this->Ln();
            $this->Cell(90, 5, "Date Discharged: $patientHistory[4]", 0, 0);
            $this->Ln();
            $this->Cell(90, 5, "Doctor: $patientHistory[2]", 0, 0);
            $this->Ln();
            $this->Cell(90, 5, "Condition: $patientHistory[5]", 0, 0);
            $this->Ln();
            $this->Cell(90, 5, "Surgeries: $patientHistory[6]", 0, 0);
            $this->Ln();
            $this->Cell(90, 5, "Doctor's notes: $patientHistory[7]", 0, 0);
            $this->Ln();
            $this->Cell(90, 5, "Nurse's notes: $patientHistory[8]", 0, 0);
            $this->Ln();
            $this->Ln();
            $this->Cell(90, 5, "---------------------------------------------", 0, 0);
            $this->Ln();
            $this->Ln();
        }

    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$patient_id = $_POST['Patient_ID'];
$sql = "SELECT * FROM patient_details WHERE patient_id = '$patient_id'";
$result = query($sql);
$patient_id = $_POST['Patient_ID'];
$sql = "SELECT * FROM patient_history WHERE patient_id = '$patient_id'";
$result1 = query($sql);

$patientDetails = mysql_fetch_array($result);


$pdf = new PDF();
$pdf->AddPage();
$pdf->PatientHistory($result1);
$pdf->Output();

?>
