
from pathlib import Path

from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select, WebDriverWait
from selenium.webdriver.support import expected_conditions as EC


# Application URL
BASE_URL = "http://localhost/StudentRegistration/index.php"

# Project folder for saving screenshots
PROJECT_FOLDER = Path(__file__).resolve().parent

# Start Chrome
driver = webdriver.Chrome()
wait = WebDriverWait(driver, 10)

passed = 0
failed = 0


# Open the registration form
def open_form():
    driver.get(BASE_URL)

    wait.until(
        EC.presence_of_element_located((By.ID, "student_id"))
    )


# Fill in the registration form
def fill_form(
    student_id,
    email="john@example.com",
    password="student123",
    confirm_password="student123"
):
    driver.find_element(By.ID, "student_id").send_keys(student_id)
    driver.find_element(By.ID, "full_name").send_keys("John Smith")
    driver.find_element(By.ID, "email").send_keys(email)

    Select(
        driver.find_element(By.ID, "programme")
    ).select_by_value("Bachelor of Information Technology")

    driver.find_element(
        By.CSS_SELECTOR,
        'input[name="year"][value="Year 1"]'
    ).click()

    driver.find_element(By.ID, "password").send_keys(password)

    driver.find_element(
        By.ID, "confirm_password"
    ).send_keys(confirm_password)

    driver.find_element(By.ID, "terms").click()


# Run a test and report the result
def run_test(test_name, test_function):
    global passed, failed

    try:
        test_function()
        passed += 1
        print(f"PASS: {test_name}")

    except Exception as error:
        failed += 1
        print(f"FAIL: {test_name}")
        print(f"Reason: {error}")

        screenshot_name = (
            "".join(
                c if c.isalnum() else "_"
                for c in test_name
            )
            + "_failure.png"
        )

        try:
            driver.save_screenshot(
                str(PROJECT_FOLDER / screenshot_name)
            )
        except Exception:
            pass


# TEST 1: Successful registration
def test_successful_registration():
    open_form()
    fill_form("20261001")

    driver.find_element(
        By.CSS_SELECTOR, 'button[type="submit"]'
    ).click()

    wait.until(EC.url_contains("success.php"))

    page_text = driver.find_element(By.TAG_NAME, "body").text

    assert "Registration Successful!" in page_text
    assert "20261001" in page_text

    driver.save_screenshot(
        str(PROJECT_FOLDER / "successful_registration.png")
    )


# TEST 2: Navigate to the registered students page
def test_view_registered_students():
    driver.find_element(
        By.LINK_TEXT, "View All Students"
    ).click()

    wait.until(EC.url_contains("students.php"))

    page_text = driver.find_element(By.TAG_NAME, "body").text

    assert "20261001" in page_text

    driver.save_screenshot(
        str(PROJECT_FOLDER / "registered_students.png")
    )


# TEST 3: Reject mismatched passwords
def test_password_mismatch():
    open_form()

    fill_form(
        "20261002",
        password="student123",
        confirm_password="different123"
    )

    driver.find_element(
        By.CSS_SELECTOR, 'button[type="submit"]'
    ).click()

    # Wait for the JavaScript alert
    alert = wait.until(EC.alert_is_present())

    # Check the alert message
    assert "Passwords do not match" in alert.text

    # Accept the alert so Selenium can continue
    alert.accept()

    # Confirm that the form was not submitted
    assert "index.php" in driver.current_url


# TEST 4: Reject a duplicate student ID
def test_duplicate_student_id():
    open_form()
    fill_form("20261001")

    driver.find_element(
        By.CSS_SELECTOR, 'button[type="submit"]'
    ).click()

    wait.until(EC.url_contains("success.php"))

    page_text = driver.find_element(By.TAG_NAME, "body").text

    assert "already registered" in page_text.lower()


# TEST 5: Reject an empty form
def test_empty_form():
    open_form()

    driver.find_element(
        By.CSS_SELECTOR, 'button[type="submit"]'
    ).click()

    form_is_valid = driver.execute_script(
        "return document.querySelector('form').checkValidity();"
    )

    assert form_is_valid is False
    assert "index.php" in driver.current_url


# TEST 6: Reject an invalid email address
def test_invalid_email():
    open_form()

    fill_form(
        "20261003",
        email="not-an-email"
    )

    driver.find_element(
        By.CSS_SELECTOR, 'button[type="submit"]'
    ).click()

    email_is_valid = driver.execute_script(
        "return document.getElementById('email').checkValidity();"
    )

    assert email_is_valid is False
    assert "index.php" in driver.current_url


# Run all tests
try:
    print("\nSTUDENT REGISTRATION SYSTEM - SELENIUM TESTS")
    print("=" * 50)

    run_test(
        "Test 1 - Successful Registration",
        test_successful_registration
    )

    run_test(
        "Test 2 - View Registered Students",
        test_view_registered_students
    )

    run_test(
        "Test 3 - Password Mismatch",
        test_password_mismatch
    )

    run_test(
        "Test 4 - Duplicate Student ID",
        test_duplicate_student_id
    )

    run_test(
        "Test 5 - Empty Form Validation",
        test_empty_form
    )

    run_test(
        "Test 6 - Invalid Email Validation",
        test_invalid_email
    )

finally:
    print("\n" + "=" * 50)
    print(f"Tests passed: {passed}")
    print(f"Tests failed: {failed}")
    print(f"Total tests:  {passed + failed}")
    print(f"\nScreenshots folder: {PROJECT_FOLDER}")

    driver.quit()
