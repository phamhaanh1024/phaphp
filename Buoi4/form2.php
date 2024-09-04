<?php
session_start();

$errors = [];
$first_name = $last_name = $email = $invoice_id = $additional_info = '';
$pay_for = [];
$file_upload = '';
$upload_success = false;

// Function to clean and sanitize input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean and validate form input
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $invoice_id = test_input($_POST['invoice_id']);
    $pay_for = $_POST['pay_for'] ?? [];
    $additional_info = test_input($_POST['additional_info']);

    // Validate first name
    if (empty($first_name)) {
        $errors['first_name'] = "First Name is required.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
        $errors['first_name'] = "First Name can only contain letters and white space.";
    }

    // Validate last name
    if (empty($last_name)) {
        $errors['last_name'] = "Last Name is required.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
        $errors['last_name'] = "Last Name can only contain letters and white space.";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate invoice ID
    if (empty($invoice_id)) {
        $errors['invoice_id'] = "Invoice ID is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $invoice_id)) {
        $errors['invoice_id'] = "Invoice ID can only contain letters and numbers.";
    }

    // Validate pay for
    if (empty($pay_for)) {
        $errors['pay_for'] = "Please select at least one item from 'Pay For'.";
    }

    // Validate file upload
    if ($_FILES['payment_receipt']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors['file'] = "Please upload your payment receipt.";
    } else {
        $file = $_FILES['payment_receipt'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_file_size = 1048576; // 1MB in bytes

        if (!in_array($file['type'], $allowed_types)) {
            $errors['file'] = "Only JPG, PNG, and GIF files are allowed.";
        } elseif ($file['size'] > $max_file_size) {
            $errors['file'] = "File size must not exceed 1MB.";
        } else {
            // Đảm bảo thư mục đích tồn tại và cấp quyền ghi
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // Tạo thư mục nếu chưa tồn tại
            }

            $target_file = $upload_dir . basename($_FILES["payment_receipt"]["name"]);

            // Kiểm tra và di chuyển file
            if (move_uploaded_file($_FILES["payment_receipt"]["tmp_name"], $target_file)) {
                $file_upload = $target_file;
            } else {
                $errors['file'] = "Đã xảy ra lỗi khi tải file.";
            }
        }
    }

    // If no errors, store in session, set cookies, and display
    if (empty($errors)) {
        // Store in session
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['invoice_id'] = $invoice_id;
        $_SESSION['pay_for'] = $pay_for;
        $_SESSION['additional_info'] = $additional_info;
        $_SESSION['file_upload'] = $file_upload;

        // Set cookies (expire in 1 day)
        setcookie('first_name', $first_name, time() + 86400, "/");
        setcookie('last_name', $last_name, time() + 86400, "/");
        setcookie('email', $email, time() + 86400, "/");
        setcookie('invoice_id', $invoice_id, time() + 86400, "/");

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// If session exists, retrieve data
if (isset($_SESSION['first_name'])) {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $invoice_id = $_SESSION['invoice_id'];
    $pay_for = $_SESSION['pay_for'];
    $additional_info = $_SESSION['additional_info'];
    $file_upload = $_SESSION['file_upload'];
}

// If cookies exist, retrieve data (this is just an example, could be adjusted based on your needs)
if (isset($_COOKIE['first_name'])) {
    $first_name = $_COOKIE['first_name'];
}
if (isset($_COOKIE['last_name'])) {
    $last_name = $_COOKIE['last_name'];
}
if (isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];
}
if (isset($_COOKIE['invoice_id'])) {
    $invoice_id = $_COOKIE['invoice_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            color: #8f8f8f;
        }

        .checkbox-group label {
            width: 48%;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        /* Additional CSS for displaying submitted data */
        .submitted-data {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9f7ef;
            border-radius: 5px;
            border: 1px solid #d4e9d5;
        }

        .submitted-data h3 {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .submitted-data img {
            max-width: 300px;
            display: block;
            margin-top: 10px;
        }

        .submitted-data p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Payment Receipt Upload Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="form-group">
                <label>First Name:</label>
                <div class="input-row">
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
                    <span class="error"><?php echo $errors['first_name'] ?? ''; ?></span>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                    <span class="error"><?php echo $errors['last_name'] ?? ''; ?></span>
                </div>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $errors['email'] ?? ''; ?></span>
            </div>

            <div class="form-group">
                <label>Invoice ID:</label>
                <input type="text" name="invoice_id" value="<?php echo htmlspecialchars($invoice_id); ?>">
                <span class="error"><?php echo $errors['invoice_id'] ?? ''; ?></span>
            </div>

            <div class="form-group">
                <label>Pay For:</label>
                <div class="checkbox-group">
                    <?php
                    $items = [
                        "15K Category",
                        "35K Category",
                        "55K Category",
                        "75K Category",
                        "116K Category",
                        "Shuttle Two Ways",
                        "Shuttle One Way",
                        "Compressport T-Shirt Merchandise",
                        "Training Cap Merchandise",
                        "Buf Merchandise",
                        "Other"
                    ];
                    foreach ($items as $item) {
                        $checked = in_array($item, $pay_for) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='pay_for[]' value='$item' $checked> $item</label>";
                    }
                    ?>
                </div>
                <span class="error"><?php echo $errors['pay_for'] ?? ''; ?></span>
            </div>

            <div class="form-group">
                <label>Please upload your payment receipt:</label>
                <input type="file" name="payment_receipt">
                <span class="error"><?php echo $errors['file'] ?? ''; ?></span>
            </div>

            <div class="form-group">
                <label>Additional Information:</label>
                <textarea name="additional_info"><?php echo htmlspecialchars($additional_info); ?></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>

        <!-- Display submitted data -->
        <?php if (isset($_SESSION['first_name'])): ?>
            <div class="submitted-data">
                <h3>Submitted Information:</h3>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars($invoice_id); ?></p>
                <p><strong>Items Paid For:</strong> <?php echo implode(', ', $pay_for); ?></p>
                <p><strong>Additional Information:</strong> <?php echo htmlspecialchars($additional_info); ?></p>

                <?php if ($file_upload): ?>
                    <p><strong>Uploaded Receipt:</strong></p>
                    <img src="<?php echo $file_upload; ?>" alt="Payment Receipt">
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>