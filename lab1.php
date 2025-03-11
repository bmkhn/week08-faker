<?php
require_once 'vendor/autoload.php';

$faker = Faker\Factory::create('en_PH');
$jobTitles = ['Software Engineer', 'Data Scientist', 'Product Manager', 'Graphic Designer', 'Marketing Specialist', 'Sales Manager', 'HR Coordinator', 'Financial Analyst', 'Customer Support', 'Operations Manager'];

$profiles = [];
for ($i = 0; $i < 5; $i++) {
    $profiles[] = [
        'full_name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->municipality . ', ' . $faker->province,
        'birthdate' => $faker->date('Y-m-d'),
        'job_title' => $jobTitles[array_rand($jobTitles)],
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake User Profiles</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Fake User Profiles</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Complete Address</th>
                    <th>Birthdate</th>
                    <th>Job Title</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profiles as $profile): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($profile['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($profile['email']); ?></td>
                        <td><?php echo htmlspecialchars($profile['phone']); ?></td>
                        <td><?php echo htmlspecialchars($profile['address']); ?></td>
                        <td><?php echo htmlspecialchars($profile['birthdate']); ?></td>
                        <td><?php echo htmlspecialchars($profile['job_title']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>