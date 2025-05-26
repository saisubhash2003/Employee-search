<?php
include 'db_config.php';

function generateEmployeeID($conn) {
    $result = $conn->query("SELECT COUNT(*) AS count FROM employees");
    $row = $result->fetch_assoc();
    $next = $row['count'] + 1;
    return 'EMP' . str_pad($next, 4, '0', STR_PAD_LEFT);
}

function generateLoginID($first, $last, $conn) {
    $base = strtolower(substr($first, 0, 1) . $last);
    $login_id = $base;
    $i = 0;

    while (true) {
        $check = $conn->query("SELECT * FROM employees WHERE login_id = '$login_id'");
        if ($check->num_rows == 0) break;
        $login_id = $base . rand(100, 999);
        $i++;
        if ($i > 10) break; // fail-safe
    }
    return $login_id;
}

function isValidAge($dob) {
    $dobDate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($dobDate)->y;
    return $age >= 18;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = $_POST['first_name'];
    $middle = $_POST['middle_name'];
    $last = $_POST['last_name'];
    $dob = $_POST['dob'];
    $dept = $_POST['department'];
    $salary = $_POST['salary'];
    $perm_address = $_POST['perm_address'];
    $curr_address = $_POST['curr_address'];

    // Age validation
    if (!isValidAge($dob)) {
        die("Employee must be at least 18 years old.");
    }

    // File validation
    $file = $_FILES['id_proof'];
    $allowed = ['application/pdf'];
    if (!in_array($file['type'], $allowed)) {
        die("Only PDF files are allowed.");
    }
    if ($file['size'] < 10240 || $file['size'] > 1048576) {
        die("File size must be between 10KB and 1MB.");
    }

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) mkdir($upload_dir);
    $filename = uniqid() . "_" . basename($file['name']);
    $upload_path = $upload_dir . $filename;
    move_uploaded_file($file['tmp_name'], $upload_path);

    // Generate employee ID and login ID
    $employee_id = generateEmployeeID($conn);
    $login_id = generateLoginID($first, $last, $conn);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO employees (employee_id, first_name, middle_name, last_name, login_id, dob, department, salary, permanent_address, current_address, id_proof_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssisss", $employee_id, $first, $middle, $last, $login_id, $dob, $dept, $salary, $perm_address, $curr_address, $upload_path);
    $stmt->execute();

    echo "<h3 style='color:green;'>Employee added successfully! ID: $employee_id | Login: $login_id</h3>";
    echo "<a href='employee-add.php'>Add Another</a> | <a href='employee-search.php'>Search Employees</a>";
}
?>
