<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Employee</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function validateForm() {
      const dob = new Date(document.getElementById("dob").value);
      const today = new Date();
      const age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();

      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
      }

      if (age < 18) {
        alert("Employee must be at least 18 years old.");
        return false;
      }

      const file = document.getElementById("id_proof").files[0];
      if (file) {
        if (file.type !== "application/pdf") {
          alert("Only PDF files are allowed.");
          return false;
        }
        if (file.size < 10240 || file.size > 1048576) {
          alert("File size must be between 10KB and 1MB.");
          return false;
        }
      }

      return true;
    }
  </script>
</head>
<body>
  <h2>Add Employee</h2>
  <form action="employee-add-save.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
    <label>First Name: <input type="text" name="first_name" required></label><br>
    <label>Middle Name: <input type="text" name="middle_name"></label><br>
    <label>Last Name: <input type="text" name="last_name" required></label><br>
    <label>Date of Birth: <input type="date" id="dob" name="dob" required></label><br>

    <label>Department:
      <select name="department" required>
        <option value="">Select</option>
        <option>Engineering</option>
        <option>Support</option>
        <option>HR</option>
        <option>Finance</option>
      </select>
    </label><br>

    <label>Salary: <input type="number" name="salary" required></label><br>
    <label>Permanent Address:<br><textarea name="perm_address" required></textarea></label><br>
    <label>Current Address:<br><textarea name="curr_address" required></textarea></label><br>
    <label>ID Proof (PDF only, 10KB–1MB): <input type="file" name="id_proof" id="id_proof" required></label><br>
    
    <button type="submit">Add Employee</button>
  </form>
</body>
</html>
