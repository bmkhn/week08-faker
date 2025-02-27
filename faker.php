<?php
require_once 'vendor/autoload.php';


// Database Connection
$host = 'localhost';
$db = 'fakerdb';
$user = 'root';
$pass = 'root';

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


// Initialize Faker
$faker = Faker\Factory::create('en_PH');


// Generate Office Data [50]            NEEDS TO BE FIRST BECAUSE OF FK CONSTRAINT
$stmt1 = $connection->prepare("INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 50; $i++) {
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->companyEmail;
    $address = $faker->address;
    $city = $faker->city;
    $country = 'Philippines';
    $postal = $faker->postcode;

    $stmt1->bind_param("sssssss", $name, $contactnum, $email, $address, $city, $country, $postal);
    $stmt1->execute();
}
echo "Office Data Generated!<br>";


// Generate Employee Data [200]
$stmt2 = $connection->prepare("INSERT INTO Employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
for ($i = 0; $i < 200; $i++) {
    $lastname = $faker->lastName;
    $firstname = $faker->firstName;
    $office_id = $faker->numberBetween(1, 50); // FK
    $address = $faker->address;

    $stmt2->bind_param("ssis", $lastname, $firstname, $office_id, $address);
    $stmt2->execute();
}
echo "Employee Data Generated!\n";


// Generate Transaction Data [500]
for ($i = 0; $i < 500; $i++){
    // Code here
}
?>