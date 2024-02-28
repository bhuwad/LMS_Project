<?php
session_start();

// Retrieve data from the AJAX request
// if user_id is not found from sessin he will set the adminid as 1
$adminId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '-1';
$courseId = $_POST['course_id'];
$message = $_POST['message'];
// Log received data for debugging
error_log("Received data: admin_id=$adminId, course_id=$courseId, message=$message");

// Insert data into the notification_records table (replace 'your_connection_details' with your actual database connection details)
$servername = "localhost";
$username = "u105084344_LMS";
$password = "Lms@4321";
$dbname = "u105084344_LMS";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($courseId == 0){
    $student_ids_query = "SELECT id FROM register_student WHERE created_by = $adminId;";
}
else if ($courseId != 0){
    $student_ids_query = "SELECT id FROM register_student WHERE active_course_id = $courseId AND created_by = $adminId;";
}
$student_ids_result = $conn->query($student_ids_query);

if ($student_ids_result) {
    // Insert into the notification table
    $sql = "INSERT INTO notification (admin_id, course_id, message, is_createdby_admin, created_at, updated_at) 
            VALUES ('$adminId', '$courseId', '$message', 1, NOW(), NOW() )";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the ID of the inserted notification
        $notification_id = $conn->insert_id;

        // Loop through student IDs and insert into notification_records
        while ($row = $student_ids_result->fetch_assoc()) {
            $student_id = $row['id'];
            $notification_record_sql = "INSERT INTO notification_records (notification_id, student_id) 
                                        VALUES ('$notification_id', '$student_id')";

            // Execute the query to insert into notification_records
            if (!$conn->query($notification_record_sql)) {
                echo "Error inserting notification record: " . $conn->error;
                // Rollback the transaction if an error occurs
                $conn->rollback();
                exit(); // Exit the script
            }
        }

        echo "Notification and records inserted successfully";
    } else {
        echo "Error inserting notification: " . $conn->error;
    }
} else {
    echo "Error fetching student IDs: " . $conn->error;
}


$conn->close();
?>