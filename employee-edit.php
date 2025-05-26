<?php
include 'db_config.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM employees WHERE id = $id");
if ($res->num_rows == 0) {
    die("Employee not found.");
}
$emp = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Employee</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Edit Employee</h2>
  <form action="employee-edit-save.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $emp['id'] ?>">
    <label>First Name: <input type="text" name="first_name" value="<?= $emp['first_name'] ?>" required></label><br>
    <label>Middle Name: <input type="text" name="middle_name" value="<?= $emp['middle_name'] ?>"></label><br>
    <label>Last Name: <input type="text" name="last_name" value="<?= $emp['last_name'] ?>" required></label><br>
    <label>Date of Birth: <input type="date" name="dob" value="<?= $emp['dob'] ?>" required></label><br>
    <label>Department:
      <select name="department" required>
        <?php foreach (['Engineering', 'Support', 'HR', 'Finance'] as $dept): ?>
          <option <?= $emp['department'] === $dept ? "selected" : "" ?>><?= $dept ?></option>
        <?php endforeach; ?>
      </select>
    </label><br>
    <label>Salary: <input type="number" name="salary" value="<?= $emp['salary'] ?>" required></label><br>
    <label>Permanent Address:<br><textarea name="perm_address"><?= $emp['permanent_address'] ?></textarea></label><br>
    <label>Current Address:<br><textarea name="curr_address"><?= $emp['current_address'] ?></textarea></label><br>
    <label>Replace ID Proof (optional): <input type="file" name="id_proof"></label><br>

    <button type="submit">Update</button>
  </form>
</body>
</html>
