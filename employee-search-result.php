<?php
include 'db_config.php';

$conditions = [];
$params = [];

if (!empty($_GET['employee_id'])) {
  $conditions[] = "employee_id LIKE ?";
  $params[] = "%" . $_GET['employee_id'] . "%";
}
if (!empty($_GET['first_name'])) {
  $conditions[] = "first_name LIKE ?";
  $params[] = "%" . $_GET['first_name'] . "%";
}
if (!empty($_GET['last_name'])) {
  $conditions[] = "last_name LIKE ?";
  $params[] = "%" . $_GET['last_name'] . "%";
}
if (!empty($_GET['login_id'])) {
  $conditions[] = "login_id LIKE ?";
  $params[] = "%" . $_GET['login_id'] . "%";
}
if (!empty($_GET['dob_from'])) {
  $conditions[] = "dob >= ?";
  $params[] = $_GET['dob_from'];
}
if (!empty($_GET['dob_to'])) {
  $conditions[] = "dob <= ?";
  $params[] = $_GET['dob_to'];
}
if (!empty($_GET['department'])) {
  $conditions[] = "department = ?";
  $params[] = $_GET['department'];
}

$where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM employees $where LIMIT $limit OFFSET $offset";
$stmt = $conn->prepare($query);

// Bind parameters dynamically
if ($params) {
  $types = str_repeat("s", count($params));
  $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Results</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Search Results</h2>
  <form method="POST" action="employee-delete.php">
    <table border="1" cellpadding="5">
      <thead>
        <tr>
          <th>Select</th>
          <th>Employee ID</th>
          <th>Name</th>
          <th>Login ID</th>
          <th>DOB</th>
          <th>Department</th>
          <th>Salary</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><input type="checkbox" name="delete_ids[]" value="<?= $row['id'] ?>"></td>
            <td><a href="employee-view.php?id=<?= $row['id'] ?>"><?= $row['employee_id'] ?></a></td>
            <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
            <td><?= $row['login_id'] ?></td>
            <td><?= $row['dob'] ?></td>
            <td><?= $row['department'] ?></td>
            <td><?= $row['salary'] ?></td>
            <td>
              <a href="employee-view.php?id=<?= $row['id'] ?>">View</a> |
              <a href="employee-edit.php?id=<?= $row['id'] ?>">Edit</a> |
              <a href="employee-history.php?id=<?= $row['id'] ?>">History</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <br>
    <button type="submit">Delete Selected</button>
  </form>

  <br>
  <div>
    <a href="?<?= http_build_query(array_merge($_GET, ['page' => max($page - 1, 1)])) ?>">Prev</a> |
    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Next</a>
  </div>
</body>
</html>
