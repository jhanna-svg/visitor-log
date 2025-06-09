<?php
// Include CRUD functions
require_once 'functions.php';

// Check if visitor ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to main page if no ID
    header('Location: index.php');
    exit();
}

$visitor_id = $_GET['id'];

// Get visitor data to show in confirmation
$visitor = getVisitorById($visitor_id);

// If visitor not found, redirect with error
if (!$visitor) {
    header('Location: index.php?error=Visitor not found');
    exit();
}

// Handle user's confirmation choice
if (isset($_POST['confirm_delete'])) {
    if ($_POST['confirm_delete'] == 'yes') {
        // User confirmed - delete the visitor
        if (deleteVisitor($visitor_id)) {
            header('Location: index.php?success=Visitor deleted successfully');
        } else {
            header('Location: index.php?error=Error deleting visitor');
        }
    } else {
        // User cancelled - go back to main page
        header('Location: index.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Visitor - Visitor Log System</title>
    <!-- W3.CSS Framework -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">

<!-- Page Header -->
<header class="w3-container w3-red w3-center w3-padding-32">
    <h1 class="w3-margin w3-jumbo">Delete Visitor</h1>
</header>

<div class="w3-container w3-margin">
    
    <!-- Back Button -->
    <div class="w3-margin-bottom">
        <a href="index.php" class="w3-button w3-gray">← Back to Visitor List</a>
    </div>

    <!-- Delete Confirmation -->
    <div class="w3-card-4 w3-margin w3-white">
        <header class="w3-container w3-red">
            <h3>Confirm Deletion</h3>
        </header>
        <div class="w3-container w3-padding">
            <!-- Warning message -->
            <div class="w3-panel w3-leftbar w3-light-red w3-border-red">
                <p><b>Warning:</b> You are about to delete the following visitor record. This action cannot be undone.</p>
            </div>
            
            <!-- Show visitor details before deletion -->
            <div class="w3-container w3-border w3-margin-bottom">
                <h4>Visitor Details:</h4>
                <p><b>ID:</b> <?php echo $visitor['id']; ?></p>
                <p><b>Name:</b> <?php echo htmlspecialchars($visitor['name']); ?></p>
                <p><b>Contact:</b> <?php echo htmlspecialchars($visitor['contact']); ?></p>
                <p><b>Purpose:</b> <?php echo htmlspecialchars($visitor['purpose']); ?></p>
                <p><b>Date Logged:</b> <?php echo date('Y-m-d H:i:s', strtotime($visitor['date_logged'])); ?></p>
            </div>
            
            <!-- Confirmation buttons -->
            <form method="POST" class="w3-container">
                <p class="w3-text-red"><b>Are you sure you want to delete this visitor record?</b></p>
                
                <!-- Yes - Delete button -->
                <button class="w3-button w3-red w3-margin-right" type="submit" name="confirm_delete" value="yes">
                    Yes, Delete
                </button>
                <!-- No - Cancel button -->
                <button class="w3-button w3-gray" type="submit" name="confirm_delete" value="no">
                    No, Cancel
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>