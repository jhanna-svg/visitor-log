<?php
// Include CRUD functions
require_once 'functions.php';

// Check if visitor ID is provided in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to main page if no ID
    header('Location: index.php');
    exit();
}

$visitor_id = $_GET['id'];

// Handle form submission for updating visitor
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    // Get updated form data
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $purpose = $_POST['purpose'];
    
    // Try to update visitor
    if (updateVisitor($visitor_id, $name, $contact, $purpose)) {
        $success = "Visitor updated successfully!";
        // Auto-redirect to main page after 2 seconds
        header("refresh:2;url=index.php");
    } else {
        $error = "Error updating visitor!";
    }
}

// Get current visitor data to populate form
$visitor = getVisitorById($visitor_id);

// If visitor not found, redirect to main page
if (!$visitor) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Visitor - Visitor Log System</title>
    <!-- W3.CSS Framework -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">

<!-- Page Header -->
<header class="w3-container w3-blue w3-center w3-padding-32">
    <h1 class="w3-margin w3-jumbo">Edit Visitor</h1>
</header>

<div class="w3-container w3-margin">
    
    <!-- Back Button -->
    <div class="w3-margin-bottom">
        <a href="index.php" class="w3-button w3-gray">← Back to Visitor List</a>
    </div>
    
    <!-- Display Success Messages -->
    <?php if (isset($success)): ?>
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p><?php echo $success; ?></p>
        </div>
    <?php endif; ?>
    
    <!-- Display Error Messages -->
    <?php if (isset($error)): ?>
        <div class="w3-panel w3-red w3-display-container">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            <p><?php echo $error; ?></p>
        </div>
    <?php endif; ?>

    <!-- Edit Visitor Form -->
    <div class="w3-card-4 w3-margin w3-white">
        <header class="w3-container w3-blue">
            <h3>Edit Visitor Information</h3>
        </header>
        <div class="w3-container w3-padding">
            <form method="POST" class="w3-container">
                <!-- Hidden field to identify form action -->
                <input type="hidden" name="action" value="update">
                
                <!-- Name field - pre-filled with current data -->
                <label class="w3-text-blue"><b>Name</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="name" value="<?php echo htmlspecialchars($visitor['name']); ?>" required>
                
                <!-- Contact field - pre-filled -->
                <label class="w3-text-blue"><b>Contact</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="contact" value="<?php echo htmlspecialchars($visitor['contact']); ?>">
                
                <!-- Purpose field - pre-filled -->
                <label class="w3-text-blue"><b>Purpose</b></label>
                <textarea class="w3-input w3-border w3-margin-bottom" name="purpose" rows="3"><?php echo htmlspecialchars($visitor['purpose']); ?></textarea>
                
                <!-- Show original date (read-only) -->
                <p class="w3-text-gray"><b>Date Logged:</b> <?php echo date('Y-m-d H:i:s', strtotime($visitor['date_logged'])); ?></p>
                
                <!-- Submit and Cancel buttons -->
                <button class="w3-button w3-blue w3-margin-bottom w3-margin-right" type="submit">Update Visitor</button>
                <a href="index.php" class="w3-button w3-gray w3-margin-bottom">Cancel</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>