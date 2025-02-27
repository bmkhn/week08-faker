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

// Generate Employee Data [200]
for ($i = 0; $i < 200; $i++){
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->companyEmail;
    $address = $faker->address;
    $city = $faker->city;
    $country = 'Philippines';
    $postal = $faker->postcode;

    $sql = "INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES ('$name', '$contactnum', '$email', '$address', '$city', '$country', '$postal')";
    $connection->query($sql);
}

// Generate Office Data [50]
for ($i = 0; $i < 50; $i++){
    // Code here
}

// Generate Transaction Data [500]
for ($i = 0; $i < 500; $i++){
    // Code here
}
?>


