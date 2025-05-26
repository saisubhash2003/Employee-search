<?php
include 'db_config.php';

$id = intval($_POST['id']);
$first = $_POST['first_name'];
$middle = $_POST['middle_name'];
$last = $_POST['last_name'];
$dob = $_POST['dob'];
$dept = $_POST['department'];
$salary = $_POST['salary'];
$perm = $_POST['perm_address'];
$curr = $_POST['curr_address'];

$id_proof_path = null;
if ($_FILES['id_proof']['name']) {
    if ($_FILES['id_proof']['type'] !== 'application/pdf' ||
        $_FILES['id_proof']['size'] < 10240 ||
        $_FILES['id_proof']['size'] > 1048576) {
        die("Invalid PDF upload.");
    }

    $filename = uniqid() . "_" . basename($_FILES['id_proof']['name']);
    $target = "uploads/" . $filename;
    move_uploaded_file($_FILES['id_proof']['tmp_name'], $target);
    $id_proof_path = $target;
}

if ($id_proof_path) {
    $sql = "UPDATE employees SET first_name=?, middle_name=?, last_name=?, dob=?, department=?, salary=?, permanent_address=?, current_address=?, id_proof_path=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssdsssi", $first, $middle, $last, $dob, $dept, $salary, $perm, $curr, $id_proof_path, $id);
} else {
    $sql = "UPDATE employees SET first_name=?, middle_name=?, last_name=?, dob=?, department=?, salary=?, permanent_address=?, current_address=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssdssi", $first, $middle, $last, $dob, $dept, $salary, $perm, $curr, $id);
}

$stmt->execute();

echo "<h3>Employee updated successfully.</h3>";
echo "<a href='employee-view.php?id=$id'>View Record</a> | <a href='employee-search.php'>Search</a>";
?>
