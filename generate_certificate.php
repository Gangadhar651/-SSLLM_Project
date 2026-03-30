
<?php
session_start();
include('../config/db.php');

// 🔥 FIXED PATH (IMPORTANT)
require(__DIR__ . '/../lib/fpdf.php');

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user name
$userQuery = $conn->query("SELECT name FROM users WHERE id=$user_id");

if(!$userQuery){
    die("User Fetch Error: " . $conn->error);
}

$user = $userQuery->fetch_assoc();
$name = $user['name'] ?? "Intern";

// Fetch skills
$skillsQuery = $conn->query("SELECT skill_name FROM user_skills WHERE user_id=$user_id");

$skillList = "";

if($skillsQuery){
    while($row = $skillsQuery->fetch_assoc()){
        $skillList .= $row['skill_name'] . ", ";
    }
}

// Remove last comma
$skillList = rtrim($skillList, ", ");

// Default if empty
if(empty($skillList)){
    $skillList = "General Skills Training";
}

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,20,'Certificate of Completion',0,1,'C');

// Space
$pdf->Ln(5);

// Subtitle
$pdf->SetFont('Arial','',16);
$pdf->Cell(0,10,"This certifies that",0,1,'C');

// Name
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,10,$name,0,1,'C');

// Space
$pdf->Ln(5);

// Skills
$pdf->SetFont('Arial','',14);
$pdf->MultiCell(0,10,"Has successfully completed training in:\n$skillList",0,'C');

// Space
$pdf->Ln(10);

// Date
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,"Date: " . date("d M Y"),0,1,'C');

// Output PDF
$pdf->Output("D","certificate.pdf");
exit();
?>