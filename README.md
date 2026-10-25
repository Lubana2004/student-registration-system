# Student Registration System

## Project Description

The Student Registration System is a web application developed using PHP, HTML, CSS, and JavaScript. It allows users to register students, validate their details, and view registered student records.

The project also includes automated functional testing using Python and Selenium WebDriver.

## Features

- Student registration form
- Student ID, name, and email fields
- Programme selection and year-level selection
- Password and confirmation validation
- Terms and conditions checkbox
- Duplicate student ID validation
- Registration success and error messages
- View registered students
- Responsive user interface
- Six automated Selenium test cases

## Technologies Used

- PHP
- HTML
- CSS
- JavaScript
- Python
- Selenium WebDriver
- Git and GitHub
- XAMPP and Apache

## Requirements

- XAMPP with Apache
- Python installed
- Google Chrome
- Selenium Python package
- Git (for version control)

## How to Run the Application

1. Install and open XAMPP.
2. Start Apache from the XAMPP Control Panel.
3. Place the project folder inside `C:\xampp\htdocs\`.
4. Open a browser and visit:

   `http://localhost/StudentRegistration/index.php`

5. Complete the student registration form to test the application.

## How to Run the Selenium Tests

1. Make sure Apache is running.
2. Open Git Bash in the project folder.
3. Install Selenium if it is not already installed:

   `py -m pip install selenium`

4. Run the automated test script:

   `py test_student_registration.py`

The script tests successful registration, navigation to the student list, password mismatch, duplicate student ID, empty form validation, and invalid email validation.

## Data Storage

The application stores registered student records in PHP session data. Records are temporary and may not persist after the session ends.

## Testing Results

The six Selenium test cases completed successfully in the recorded test run, with six passed and zero failed.

## Author

Lubana Islam Khan
## Project Limitations

- Student records are stored in PHP session data and are temporary.
- The application does not use a database.
- Automated browser testing requires Apache, Python, Selenium, and Google Chrome.