
<?php
session_start();

$students = $_SESSION["students"] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Student Registration System</h1>
    <p>View all registered students</p>
</header>

<nav>
    <a href="index.php">Register Student</a>
    <a href="students.php">View Students</a>
</nav>

<main class="container">
    <h2>Registered Students</h2>

    <p>Total Registered Students:
        <strong><?= count($students) ?></strong>
    </p>

    <?php if (count($students) > 0): ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Programme</th>
                        <th>Year of Study</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student["student_id"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($student["full_name"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($student["email"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($student["programme"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($student["year"], ENT_QUOTES, "UTF-8") ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>

        <p class="empty-message">No students have been registered yet.</p>

    <?php endif; ?>

    <a class="button-link" href="index.php">Register New Student</a>
</main>

<footer>
    <p>&copy; 2026 Student Registration System</p>
</footer>

</body>
</html>
