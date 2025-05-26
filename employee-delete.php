<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_ids'])) {
    $ids = $_POST['delete_ids'];

    foreach ($ids as $id) {
        $id = intval($id);

        // Optional: log history before deleting
        $empData = $conn->query("SELECT * FROM employees WHERE id = $id")->fetch_assoc();
        $data = json_encode($empData);
        $conn->query("INSERT INTO employee_history (employee_id, change_type, change_data) VALUES ($id, 'delete', '$data')");

        // Delete record
        $conn->query("DELETE FROM employees WHERE id = $id");
    }

    echo "<h3>Selected employees deleted successfully.</h3>";
} else {
    echo "<h3>No employees selected for deletion.</h3>";
}

echo "<a href='employee-search.php'>← Back to Search</a>";
?>
