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
            height: 100vh;
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
        .form-group input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group .input-row {
            display: flex;
            justify-content: space-between;
        }

        .form-group .input-row input {
            width: 48%;
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
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Payment Receipt Upload Form</h2>
        <?php
        // Include the PHP processing file to handle form submission
        include 'xuly.php';
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Name</label>
                <div class="input-row">
                    <input type="text" name="first_name" placeholder="First Name"
                        value="<?php echo htmlspecialchars($first_name); ?>">
                    <span class="error"><?php echo $errors['first_name'] ?? ''; ?></span>
                    <input type="text" name="last_name" placeholder="Last Name"
                        value="<?php echo htmlspecialchars($last_name); ?>">
                    <span class="error"><?php echo $errors['last_name'] ?? ''; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="example@example.com"
                    value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $errors['email'] ?? ''; ?></span>
            </div>
            <div class="form-group">
                <label>Invoice ID</label>
                <input type="text" name="invoice_id" value="<?php echo htmlspecialchars($invoice_id); ?>">
                <span class="error"><?php echo $errors['invoice_id'] ?? ''; ?></span>
            </div>
            <div class="form-group">
                <label>Pay For</label>
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
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>