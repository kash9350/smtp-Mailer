<?php
include 'config.php';

$registration_id='daigoo';

try {
$sql= "SELECT * FROM Registration WHERE registration_id = :registration_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':registration_id', $registration_id); 
$stmt->execute();
$row =$stmt->fetch();

echo "info=\n".$row['captain_name']."\n".$row['college_name'];



}
catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;

?>

