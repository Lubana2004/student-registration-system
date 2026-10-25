
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

<header>
    <h1>Student Registration System</h1>
    <p>Register as a student using the form below.</p>
</header>

<nav>
    <a href="index.php">Register Student</a>
    <a href="students.php">View Students</a>
</nav>

<main class="container">
    <h2>Student Registration Form</h2>

    <form action="success.php" method="POST" onsubmit="return validateForm()">

        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="programme">Programme:</label>
        <select id="programme" name="programme" required>
            <option value="">-- Select Programme --</option>
            <option value="Bachelor of Information Technology">Bachelor of Information Technology</option>
            <option value="Postgraduate Diploma in IT">Postgraduate Diploma in IT</option>
            <option value="Bachelor of Science">Bachelor of Science</option>
            <option value="Bachelor of Commerce">Bachelor of Commerce</option>
        </select>

        <label>Year of Study:</label>
        <div class="radio-group">
            <label><input type="radio" name="year" value="Year 1" required> Year 1</label>
            <label><input type="radio" name="year" value="Year 2"> Year 2</label>
            <label><input type="radio" name="year" value="Year 3"> Year 3</label>
            <label><input type="radio" name="year" value="Year 4"> Year 4</label>
        </div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" minlength="6" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" minlength="6" required>

        <div class="checkbox-group">
            <input type="checkbox" id="terms" name="terms" value="yes" required>
            <label for="terms">I confirm that my information is correct.</label>
        </div>

        <button type="submit">Register Student</button>
        <button type="reset" class="reset-button">Clear Form</button>

    </form>
</main>

<footer>
    <p>&copy; 2026 Student Registration System</p>
</footer>

</body>
</html>
