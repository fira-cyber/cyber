<?php
session_start(); // Start the session

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $studentName = isset($_POST['student_name']) ? $_POST['student_name'] : '';
    $cgpa = isset($_POST['cgpa']) ? floatval($_POST['cgpa']) : 0;
    $semester = isset($_POST['semester']) ? $_POST['semester'] : '';
    $academicYear = isset($_POST['academic_year']) ? $_POST['academic_year'] : '';
    $isCafe = isset($_POST['is_cafe']) ? $_POST['is_cafe'] : 'No';
    $hasCBEAccount = isset($_POST['has_cbe_account']) ? $_POST['has_cbe_account'] : 'No';
    $accountNumber = isset($_POST['account_number']) ? $_POST['account_number'] : '';
    
    // Handle add/drop course logic
    $addCourse = isset($_POST['add_course']) ? $_POST['add_course'] : '';
    $dropCourse = isset($_POST['drop_course']) ? $_POST['drop_course'] : '';
    $courseNameAdd = isset($_POST['course_name_add']) ? $_POST['course_name_add'] : '';
    $courseCodeAdd = isset($_POST['course_code_add']) ? $_POST['course_code_add'] : '';
    $courseNameDrop = isset($_POST['course_name_drop']) ? $_POST['course_name_drop'] : '';
    $courseCodeDrop = isset($_POST['course_code_drop']) ? $_POST['course_code_drop'] : '';

    // Handle CGPA logic
    if ($cgpa < 1.8) {
        $errorMessage = "Sorry, you cannot register due to CGPA less than 1.8.";
    } else {
        // Prepare the data to save
        $registrationData = "Student Name: $studentName\nCGPA: $cgpa\nAcademic Year: $academicYear\nSemester: $semester\nCafé: $isCafe\nCBE Account: $hasCBEAccount\nAccount Number: $accountNumber\n";

        if ($addCourse) {
            $registrationData .= "Add Course: $courseNameAdd (Code: $courseCodeAdd)\n";
        }
        if ($dropCourse) {
            $registrationData .= "Drop Course: $courseNameDrop (Code: $courseCodeDrop)\n";
        }
        
        $registrationData .= "\n";
        
        // Save data in the specified path
        $filePath = "C:\\Users\\firao\\OneDrive\\semester_registrations.txt";
        $logFilePath = "C:\\Users\\firao\\OneDrive\\log.txt"; // Log file to check the script flow
        
        // Log the attempt to write
        file_put_contents($logFilePath, "Attempting to write to file\n", FILE_APPEND);
        
        if (file_put_contents($filePath, $registrationData, FILE_APPEND) !== false) {
            $successMessage = "Registration successful!";
            file_put_contents($logFilePath, "Write successful\n", FILE_APPEND); // Log success
        } else {
            $errorMessage = "Failed to save registration.";
            file_put_contents($logFilePath, "Write failed\n", FILE_APPEND); // Log failure
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Semester</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-image: url('ll.jpg'); /* Change as needed */
            background-size: cover;
            color: #333;
        }
        
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        
        h1 {
            text-align: center;
            color: #3f51b5;
        }
        
        img.logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
        }

        label {
            margin-top: 10px;
            display: block;
            font-weight: 500;
            color: #555;
        }
        
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #3f51b5;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        
        input:focus, select:focus {
            border-color: #673ab7;
            outline: none;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background-color: #3f51b5;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        
        button:hover {
            background-color: #5b6bd5;
        }
        
        .message {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
        }
        
        .error {
            color: red;
        }
        
        .success {
            color: green;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input { 
            opacity: 0; 
            width: 0; 
            height: 0; 
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #3f51b5;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .account-number-container {
            display: none;
        }

        .course-fields {
            display: none;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin-top: 20px;
            }

            h1 {
                font-size: 1.5em;
            }
        }
    </style>
    <script>
        function validateCGPA() {
            const cgpaInput = document.getElementById('cgpa').value;
            const cgpaMessage = document.getElementById('cgpa-message');
            if (cgpaInput < 1.8) {
                cgpaMessage.innerHTML = "Sorry, you can't register due to CGPA < 1.8.";
                document.getElementById('registrationForm').reset(); // Reset form on failure
                disableFields();
                return false; // Prevent form submission
            } else {
                cgpaMessage.innerHTML = "";
                enableFields();
                return true; // Allow form submission
            }
        }

        function toggleAccountInfo() {
            const isCafe = document.getElementById('is_cafe_switch').checked ? 'Yes' : 'No';
            const accountSection = document.getElementById('account_section');
            const accountNumberField = document.getElementById('account_number_container');
            if (isCafe === 'Yes') {
                accountSection.style.display = 'block';
            } else {
                accountSection.style.display = 'none';
                accountNumberField.style.display = 'none'; // Hide account number when cafe is "No"
            }
        }

        function toggleCBEAccount() {
            const cbeSwitch = document.getElementById('has_cbe_account');
            const accountNumberField = document.getElementById('account_number_container');
            if (cbeSwitch.checked) {
                accountNumberField.style.display = 'block';
            } else {
                accountNumberField.style.display = 'none';
            }
        }

        function toggleCourseFields() {
            const addCourseCheckbox = document.getElementById('add_course');
            const dropCourseCheckbox = document.getElementById('drop_course');
            const addFields = document.getElementById('add_course_fields');
            const dropFields = document.getElementById('drop_course_fields');

            if (addCourseCheckbox.checked) {
                addFields.style.display = 'block';
            } else {
                addFields.style.display = 'none';
            }

            if (dropCourseCheckbox.checked) {
                dropFields.style.display = 'block';
            } else {
                dropFields.style.display = 'none';
            }
        }

        function enableFields() {
            document.getElementById('semester').disabled = false;
            document.getElementById('academic_year').disabled = false;
            document.getElementById('has_cbe_account').disabled = false;
            document.getElementById('add_course').disabled = false;
            document.getElementById('drop_course').disabled = false;
        }

        function disableFields() {
            document.getElementById('semester').disabled = true;
            document.getElementById('academic_year').disabled = true;
            document.getElementById('has_cbe_account').disabled = true;
            document.getElementById('add_course').disabled = true;
            document.getElementById('drop_course').disabled = true;
        }
    </script>
</head>
<body>
    <div class="container">
        <img src="logo.jpg" alt="Logo" class="logo"> <!-- Change the logo path as needed -->
        <h1>Register for Semester</h1>
        
        <?php 
        if (isset($successMessage)) {
            echo "<div class='message success'>$successMessage</div>";
        } elseif (isset($errorMessage)) {
            echo "<div class='message error'>$errorMessage</div>";
        }
        ?>

        <form id="registrationForm" action="" method="POST" onsubmit="return validateCGPA();">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required>

            <label for="cgpa">CGPA:</label>
            <input type="number" step="0.01" id="cgpa" name="cgpa" min="0" max="4.0" onchange="validateCGPA()" required>
            <div id="cgpa-message" style="color: red;"></div>

            <label for="academic_year">Academic Year:</label>
            <select id="academic_year" name="academic_year" required disabled>
                <option value="">Select Academic Year</option>
                <option value="2023-2024">2023-2024</option>
                <option value="2024-2025">2024-2025</option>
                <option value="2025-2026">2025-2026</option>
                <!-- Add more years as needed -->
            </select>

            <label for="semester">Semester:</label>
            <select id="semester" name="semester" required disabled>
                <option value="">Select Semester</option>
                <option value="Spring">Spring</option>
                <option value="Fall">Fall</option>
                <option value="Summer">Summer</option>
            </select>

            <label>Café:</label>
            <label class="switch">
                <input type="checkbox" id="is_cafe_switch" onchange="toggleAccountInfo()">
                <span class="slider"></span>
            </label>

            <div id="account_section" style="display: none;">
                <label>Do you have a CBE Account?</label>
                <label class="switch">
                    <input type="checkbox" id="has_cbe_account" name="has_cbe_account" onchange="toggleCBEAccount()">
                    <span class="slider"></span>
                </label>

                <div id="account_number_container" class="account-number-container">
                    <label for="account_number">Account Number:</label>
                    <input type="text" id="account_number" name="account_number">
                </div>
            </div>

            <label>Add Course:</label>
            <input type="checkbox" id="add_course" name="add_course" onchange="toggleCourseFields()">
            <label for="add_course">Add Course</label>
            <div id="add_course_fields" class="course-fields" style="display: none;">
                <label for="course_name_add">Course Name:</label>
                <input type="text" id="course_name_add" name="course_name_add">
                <label for="course_code_add">Course Code:</label>
                <input type="text" id="course_code_add" name="course_code_add">
            </div>

            <label>Drop Course:</label>
            <input type="checkbox" id="drop_course" name="drop_course" onchange="toggleCourseFields()">
            <label for="drop_course">Drop Course</label>
            <div id="drop_course_fields" class="course-fields" style="display: none;">
                <label for="course_name_drop">Course Name:</label>
                <input type="text" id="course_name_drop" name="course_name_drop">
                <label for="course_code_drop">Course Code:</label>
                <input type="text" id="course_code_drop" name="course_code_drop">
            </div>

            <button type="submit">Register</button>
            <button type="button" onclick="window.history.back();" style="margin-top: 10px;">Back</button>
        </form>
    </div>
</body>
</html>