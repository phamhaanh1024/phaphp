<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$errors = [];
$first_name = $last_name = $email = $invoice_id = '';
$pay_for = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean input data using test_input()
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $invoice_id = test_input($_POST['invoice_id']);
    $pay_for = $_POST['pay_for'] ?? [];

    // Validate first name
    if (empty($first_name)) {
        $errors['first_name'] = "First Name is required.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
        $errors['first_name'] = "First Name can only contain letters and white space.";
    } else {
        echo $_POST['first_name'] . "<br>";
    }

    // Validate last name
    if (empty($last_name)) {
        $errors['last_name'] = "Last Name is required.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
        $errors['last_name'] = "Last Name can only contain letters and white space.";
    } else {
        echo $_POST['last_name'] . "<br>";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        echo $_POST['email'] . "<br>";
    }

    // Validate invoice ID
    if (empty($invoice_id)) {
        $errors['invoice_id'] = "Invoice ID is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $invoice_id)) {
        $errors['invoice_id'] = "Invoice ID can only contain letters and numbers.";
    } else {
        echo $_POST['invoice_id'] . "<br>";
    }

    // Validate pay for
    if (empty($pay_for)) {
        $errors['pay_for'] = "Please select at least one item from 'Pay For'.";
    }
    if (empty($errors)) {
        // Process the form data (e.g., save to database, send email)
        echo "<p style='color: green;'>Form submitted successfully!</p>";
    }
}