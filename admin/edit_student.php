<?php
include 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission and update student record
    $studentId = $_POST['id'];
    $updateFields = array();

    // Update the name if provided
    if (isset($_POST['name'])) {
        $updateFields[] = "name = '" . $_POST['name'] . "'";
    }

    // Update the profession if provided
    if (isset($_POST['profession'])) {
        $updateFields[] = "profession = '" . $_POST['profession'] . "'";
    }

    // Update the image if a new one is provided
    if ($_FILES['image']['size'] > 0) {
        $uploadDir = 'uploads/'; // Specify your upload directory
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $updateFields[] = "image_path = '$uploadFile'";
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Update the password if a new one is provided
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $trimmedPassword = trim($_POST['password']);
        $hashedPassword = password_hash($trimmedPassword, PASSWORD_BCRYPT);
        $updateFields[] = "password = '$hashedPassword'";
    }

    // Construct the SQL query
    $updateSql = "UPDATE register_student SET " . implode(", ", $updateFields) . " WHERE id = $studentId";

    if ($conn->query($updateSql) === TRUE) {
        // After successful update
        echo '<script>';
        echo 'alert("Student updated successfully.");';
        echo 'window.location.href = "students.php";';
        echo '</script>';
    } else {
        echo "Error updating student: " . $conn->error;
    }
} else {
    // Display the form for editing
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $studentId = $_GET['id'];

        // Fetch student data based on the ID
        $selectSql = "SELECT * FROM register_student WHERE id = $studentId";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            // Student found, retrieve data
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $selectedProfession = $row['profession']; // Added line to get the existing profession

            // Display a form with pre-filled data for editing
            echo '<html lang="en">';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            echo '<title>Edit Student</title>';
            echo '<style>';
            echo 'body { font-family: Arial, sans-serif; background-color: #f4f4f4; }';
            echo 'form { max-width: 400px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }';
            echo 'h2 { text-align: center; margin-bottom: 20px; }';
            echo 'label { display: block; margin-bottom: 10px; }';
            echo 'input, select, textarea { width: 100%; padding: 8px; margin-bottom: 15px; box-sizing: border-box; }';
            echo 'input[type="submit"] { background-color: #4caf50; color: #fff; border: none; padding: 10px 15px; cursor: pointer; border-radius: 5px; }';
            echo 'input[type="submit"]:hover { background-color: #45a049; }';
            echo '</style>';
            echo '</head>';
            echo '<body>';

            echo '<h2>Edit Student</h2>';
            echo '<form action="edit_student.php" method="post" enctype="multipart/form-data">';

            // Name input
            echo '<label for="name">Name:</label>';
            echo '<input type="text" id="name" name="name" value="' . $name . '" required>';

            // Profession dropdown
            echo '<label for="profession">Profession:</label>';
            echo '<select name="profession" id="profession" class="box" required>';
            echo '<option value="" disabled>-- select your skill</option>';
            echo '<option value="developer" ' . ($selectedProfession === 'developer' ? 'selected' : '') . '>Web Developer</option>';
            echo '<option value="front end developer" ' . ($selectedProfession === 'front end developer' ? 'selected' : '') . '>Front End Developer</option>';
            echo '<option value="backend developer" ' . ($selectedProfession === 'backend developer' ? 'selected' : '') . '>Back End Developer</option>';
            echo '<option value="full stack developer" ' . ($selectedProfession === 'full stack developer' ? 'selected' : '') . '>Full Stack Developer</option>';
            echo '<option value="ML" ' . ($selectedProfession === 'ML' ? 'selected' : '') . '>Machine Learning</option>';
            echo '<option value="Analyst" ' . ($selectedProfession === 'Analyst' ? 'selected' : '') . '>Analyst</option>';
            echo '</select>';

            // Image input
            echo '<label for="image">Image:</label>';
            echo '<input type="file" id="image" name="image">';

            // Password input
            echo '<label for="password">New Password:</label>';
            echo '<input type="password" id="password" name="password">';

            echo '<input type="hidden" name="id" value="' . $studentId . '">';
            echo '<input type="submit" value="Update">';
            echo '</form>';
            echo '</body>';
            echo '</html>';
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Invalid student ID.";
    }
}

// Close the database connection
$conn->close();
?>
