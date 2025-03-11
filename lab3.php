<?php
require_once 'vendor/autoload.php';

$faker = Faker\Factory::create();

$users = [];
for ($i = 0; $i < 10; $i++) {
    $email = $faker->email;

    $users[] = [
        'user_id' => $faker->uuid,
        'full_name' => $faker->name,
        'email' => $email,
        'username' => strtolower(explode('@', $email)[0]),
        'password' => hash('sha256', $faker->password),
        'account_created' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake User Accounts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Fake User Accounts</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Username</th>
                    <th>Password (SHA-256)</th>
                    <th>Account Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['password']); ?></td>
                        <td><?php echo htmlspecialchars($user['account_created']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>