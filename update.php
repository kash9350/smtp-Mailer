<?php
include 'config.php';

$registration_id="daigoo";
$captain_name='karlos';
$college_name="college";
$email="abc";
$primary_contact=1111111111;
$secondary_contact=2121212121;
 $accom_for=5;
try {

 $sql = "UPDATE `Registration`   
   SET 	captain_name=:captain_name,
	college_name=:college_name,
	email=:email,
	primary_contact=:primary_contact,
	secondary_contact=:secondary_contact,
	accom_for=:accom_for
 WHERE `registration_id` = :registration_id";



 $statement = $conn->prepare($sql);
 $statement->bindValue(":registration_id", $registration_id);
 $statement->bindValue(":captain_name", $captain_name);
 $statement->bindValue(":college_name", $college_name);
 $statement->bindValue(":email", $email);
 $statement->bindValue(":primary_contact", $primary_contact);
 $statement->bindValue(":secondary_contact", $secondary_contact);
 $statement->bindValue(":accom_for", $accom_for);

 $count = $statement->execute();

  $conn = null;        // Disconnect
}
catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;

?>

