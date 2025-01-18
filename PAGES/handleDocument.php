<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the student ID from the form
    $studentId = $_POST['studentId'];
    $action = $_POST['action']; // Validate or Confirm

    // Handle document upload
    if (isset($_FILES['document'])) {
        $document = $_FILES['document'];

        // Check if the file is valid (you can add more checks here)
        if ($document['error'] == 0) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($document['name']);

            // Move the uploaded file to the server
            if (move_uploaded_file($document['tmp_name'], $uploadFile)) {
                echo "<p>Document uploaded successfully.</p>";
            } else {
                echo "<p>Error uploading document.</p>";
            }
        }
    }

    // Perform the action (validate or confirm)
    if ($action == 'validate') {
        echo "<p>Bordereau validated for student ID: $studentId</p>";
        // Insert code to mark the bordereau as validated in the database
    } elseif ($action == 'confirm') {
        echo "<p>Bordereau confirmed for student ID: $studentId</p>";
        // Insert code to mark the bordereau as confirmed in the database
    }
} else {
    echo "<p>No data received.</p>";
}
?>
