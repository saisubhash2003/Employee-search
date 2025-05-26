<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Employees</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Search Employees</h2>
  <form action="employee-search-result.php" method="GET">
    <label>Employee ID: <input type="text" name="employee_id"></label><br>
    <label>First Name: <input type="text" name="first_name"></label><br>
    <label>Last Name: <input type="text" name="last_name"></label><br>
    <label>Login ID: <input type="text" name="login_id"></label><br>
    <label>Date of Birth From: <input type="date" name="dob_from"></label><br>
    <label>Date of Birth To: <input type="date" name="dob_to"></label><br>
    <label>Department:
      <select name="department">
        <option value="">All</option>
        <option>Engineering</option>
        <option>Support</option>
        <option>HR</option>
        <option>Finance</option>
      </select>
    </label><br>
    <button type="submit">Search</button>
  </form>
</body>
</html>
