<?php
include 'db_config.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM employees WHERE id = $id");
if ($result->num_rows == 0) {
    die("Employee not found.");
}
$emp = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>View Employee</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Employee Details</h2>
  <table border="1" cellpadding="8">
    <tr><th>Employee ID</th><td><?= $emp['employee_id'] ?></td></tr>
    <tr><th>Login ID</th><td><?= $emp['login_id'] ?></td></tr>
    <tr><th>First Name</th><td><?= $emp['first_name'] ?></td></tr>
    <tr><th>Middle Name</th><td><?= $emp['middle_name'] ?></td></tr>
    <tr><th>Last Name</th><td><?= $emp['last_name'] ?></td></tr>
    <tr><th>Date of Birth</th><td><?= $emp['dob'] ?></td></tr>
    <tr><th>Department</th><td><?= $emp['department'] ?></td></tr>
    <tr><th>Salary</th><td><?= $emp['salary'] ?></td></tr>
    <tr><th>Permanent Address</th><td><?= $emp['permanent_address'] ?></td></tr>
    <tr><th>Current Address</th><td><?= $emp['current_address'] ?></td></tr>
    <tr><th>ID Proof</th>
        <td><a href="<?= $emp['id_proof_path'] ?>" target="_blank">View PDF</a></td></tr>
  </table>
  <br>
  <a href="employee-search.php">← Back to Search</a>
</body>
</html>
