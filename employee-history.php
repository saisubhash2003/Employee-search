<?php
include 'db_config.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM employee_history WHERE employee_id = $id ORDER BY changed_at DESC");

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Employee History</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>History for Employee ID <?= $id ?></h2>

  <table border="1" cellpadding="5">
    <tr>
      <th>Timestamp</th>
      <th>Change Type</th>
      <th>Data Snapshot</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['changed_at'] ?></td>
        <td><?= $row['change_type'] ?></td>
        <td><pre><?= htmlentities($row['change_data']) ?></pre></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <br>
  <a href="employee-view.php?id=<?= $id ?>">← Back to View</a>
</body>
</html>
