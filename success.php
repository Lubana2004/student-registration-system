
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$student_id = trim($_POST["student_id"] ?? "");
$full_name = trim($_POST["full_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$programme = trim($_POST["programme"] ?? "");
$year = trim($_POST["year"] ?? "");
$password = $_POST["password"] ?? "";
$confirm_password = $_POST["confirm_password"] ?? "";
$terms = $_POST["terms"] ?? "";

$allowed_programmes = [
    "Bachelor of Information Technology",
    "Postgraduate Diploma in IT",
    "Bachelor of Science",
    "Bachelor of Commerce"
];

$allowed_years = ["Year 1", "Year 2", "Year 3", "Year 4"];

if (
    $student_id === "" ||
    $full_name === "" ||
    $email === "" ||
    $programme === "" ||
    $year === "" ||
    $password === "" ||
    $confirm_password === ""
) {
    die("Please complete all fields. <a href='index.php'>Go back</a>");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address. <a href='index.php'>Go back</a>");
}

if (
    !in_array($programme, $allowed_programmes, true) ||
    !in_array($year, $allowed_years, true)
) {
    die("Invalid programme or year. <a href='index.php'>Go back</a>");
}

if (strlen($password) < 6) {
    die("Password must contain at least 6 characters. <a href='index.php'>Go back</a>");
}

if ($password !== $confirm_password) {
    die("Passwords do not match. <a href='index.php'>Go back</a>");
}

if ($terms !== "yes") {
    die("Please confirm your information. <a href='index.php'>Go back</a>");
}

if (!isset($_SESSION["students"])) {
    $_SESSION["students"] = [];
}

foreach ($_SESSION["students"] as $student) {
    if ($student["student_id"] === $student_id) {
        die("Student ID already registered. <a href='index.php'>Go back</a>");
    }
}

$_SESSION["students"][] = [
    "student_id" => $student_id,
    "full_name" => $full_name,
    "email" => $email,
    "programme" => $programme,
    "year" => $year
];

unset($password, $confirm_password);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Student Registration System</h1>
</header>

<nav>
    <a href="index.php">Register Student</a>
    <a href="students.php">View Students</a>
</nav>

<main class="container success-container">
    <h2>Registration Successful!</h2>
    <p>The student has been registered successfully.</p>

    <h3>Student Details</h3>

    <p><strong>Student ID:</strong>
        <?= htmlspecialchars($student_id, ENT_QUOTES, "UTF-8") ?>
    </p>

    <p><strong>Full Name:</strong>
        <?= htmlspecialchars($full_name, ENT_QUOTES, "UTF-8") ?>
    </p>

    <p><strong>Email:</strong>
        <?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>
    </p>

    <p><strong>Programme:</strong>
        <?= htmlspecialchars($programme, ENT_QUOTES, "UTF-8") ?>
    </p>

    <p><strong>Year of Study:</strong>
        <?= htmlspecialchars($year, ENT_QUOTES, "UTF-8") ?>
    </p>

    <a class="button-link" href="index.php">Register Another Student</a>
    <a class="button-link" href="students.php">View All Students</a>
</main>

<footer>
    <p>&copy; 2026 Student Registration System</p>
</footer>

</body>
</html>
