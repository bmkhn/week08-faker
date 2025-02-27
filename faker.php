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
$stmt = $connection->prepare("INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 50; $i++) {
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->companyEmail;
    $address = $faker->address;
    $city = $faker->city;
    $country = 'Philippines';
    $postal = $faker->postcode;

    $stmt->bind_param("sssssss", $name, $contactnum, $email, $address, $city, $country, $postal);
    $stmt->execute();
}
echo "Office Data Generated!<br>";


// Generate Employee Data [200]         FK USED: office_id
$stmt = $connection->prepare("INSERT INTO Employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
for ($i = 0; $i < 200; $i++) {
    $lastname = $faker->lastName;
    $firstname = $faker->firstName;
    $office_id = $faker->numberBetween(1, 50);          // FK
    $address = $faker->address;

    $stmt->bind_param("ssis", $lastname, $firstname, $office_id, $address);
    $stmt->execute();
}
echo "Employee Data Generated!<br>";


// Generate Transaction Data [500]      FK USED: employee_id, office_id
$stmt = $connection->prepare("INSERT INTO Transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 500; $i++) {
    $employee_id = $faker->numberBetween(1, 200);       // FK
    $office_id = $faker->numberBetween(1, 50);          // FK
    $datelog = $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s');  // Min: 10 years ago and Max: now
    $action = $faker->word;
    $remarks = $faker->words(3, true);  // 3 words, concatenated
    $documentcode = $faker->uuid;

    $stmt->bind_param("iissss", $employee_id, $office_id, $datelog, $action, $remarks, $documentcode);
    $stmt->execute();
}
echo "Transaction Data Generated!<br>";


// Close Connection
$stmt->close();
$connection->close();
?>