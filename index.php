<?php
// Include CRUD functions
require_once 'functions.php';

// Handle messages from URL (from delete operations)
$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;

// Handle form submission for adding new visitor
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    // Get form data
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $purpose = $_POST['purpose'];
    
    // Try to add visitor
    if (addVisitor($name, $contact, $purpose)) {
        $success = "Visitor added successfully!";
    } else {
        $error = "Error adding visitor!";
    }
}

// Get all visitors for display
$visitors = getAllVisitors();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Log System</title>
    <!-- W3.CSS Framework for styling -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">

<!-- Page Header -->
<header class="w3-container w3-blue w3-center w3-padding-32">
    <h1 class="w3-margin w3-jumbo">Visitor Log System</h1>
</header>

<div class="w3-container w3-margin">
    
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

    <!-- Add New Visitor Form -->
    <div class="w3-card-4 w3-margin w3-white">
        <header class="w3-container w3-blue">
            <h3>Add New Visitor</h3>
        </header>
        <div class="w3-container w3-padding">
            <form method="POST" class="w3-container">
                <!-- Hidden field to identify form action -->
                <input type="hidden" name="action" value="add">
                
                <!-- Name input field -->
                <label class="w3-text-blue"><b>Name</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="name" required>
                
                <!-- Contact input field -->
                <label class="w3-text-blue"><b>Contact</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="contact">
                
                <!-- Purpose textarea field -->
                <label class="w3-text-blue"><b>Purpose</b></label>
                <textarea class="w3-input w3-border w3-margin-bottom" name="purpose" rows="3"></textarea>
                
                <!-- Submit button -->
                <button class="w3-button w3-blue w3-margin-bottom" type="submit">Add Visitor</button>
            </form>
        </div>
    </div>

    <!-- Visitor List Table -->
    <div class="w3-card-4 w3-margin w3-white">
        <header class="w3-container w3-blue">
            <h3>Visitor List</h3>
        </header>
        <div class="w3-container">
            <?php if (empty($visitors)): ?>
                <!-- Show message if no visitors -->
                <p class="w3-center w3-padding">No visitors found.</p>
            <?php else: ?>
                <!-- Display visitors in table -->
                <table class="w3-table-all w3-hoverable">
                    <thead>
                        <tr class="w3-blue">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Purpose</th>
                            <th>Date Logged</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($visitors as $visitor): ?>
                        <tr>
                            <!-- Display visitor data with HTML escaping for security -->
                            <td><?php echo $visitor['id']; ?></td>
                            <td><?php echo htmlspecialchars($visitor['name']); ?></td>
                            <td><?php echo htmlspecialchars($visitor['contact']); ?></td>
                            <td><?php echo htmlspecialchars($visitor['purpose']); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($visitor['date_logged'])); ?></td>
                            <td>
                                <!-- Edit button - links to edit.php -->
                                <a href="edit.php?id=<?php echo $visitor['id']; ?>" class="w3-button w3-small w3-green">Edit</a>
                                <!-- Delete button - links to delete.php with confirmation -->
                                <a href="delete.php?id=<?php echo $visitor['id']; ?>" class="w3-button w3-small w3-red" onclick="return confirm('Are you sure you want to delete this visitor?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
<?php
// Include CRUD functions
require_once 'functions.php';

// Handle messages from URL (from delete operations)
$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;

// Handle form submission for adding new visitor
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    // Get form data
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $purpose = $_POST['purpose'];
    
    // Try to add visitor
    if (addVisitor($name, $contact, $purpose)) {
        $success = "Visitor added successfully!";
    } else {
        $error = "Error adding visitor!";
    }
}

// Get all visitors for display
$visitors = getAllVisitors();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Log System</title>
    <!-- W3.CSS Framework for styling -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body class="w3-light-grey">

<!-- Page Header -->
<header class="w3-container w3-blue w3-center w3-padding-32">
    <h1 class="w3-margin w3-jumbo">Visitor Log System</h1>
</header>

<div class="w3-container w3-margin">
    
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

    <!-- Add New Visitor Form -->
    <div class="w3-card-4 w3-margin w3-white">
        <header class="w3-container w3-blue">
            <h3>Add New Visitor</h3>
        </header>
        <div class="w3-container w3-padding">
            <form method="POST" class="w3-container">
                <!-- Hidden field to identify form action -->
                <input type="hidden" name="action" value="add">
                
                <!-- Name input field -->
                <label class="w3-text-blue"><b>Name</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="name" required>
                
                <!-- Contact input field -->
                <label class="w3-text-blue"><b>Contact</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="contact">
                
                <!-- Purpose textarea field -->
                <label class="w3-text-blue"><b>Purpose</b></label>
                <textarea class="w3-input w3-border w3-margin-bottom" name="purpose" rows="3"></textarea>
                
                <!-- Submit button -->
                <button class="w3-button w3-blue w3-margin-bottom" type="submit">Add Visitor</button>
            </form>
        </div>
    </div>

    <!-- Visitor List Table -->
    <div class="w3-card-4 w3-margin w3-white">
        <header class="w3-container w3-blue">
            <h3>Visitor List</h3>
        </header>
        <div class="w3-container">
            <?php if (empty($visitors)): ?>
                <!-- Show message if no visitors -->
                <p class="w3-center w3-padding">No visitors found.</p>
            <?php else: ?>
                <!-- Display visitors in table -->
                <table class="w3-table-all w3-hoverable">
                    <thead>
                        <tr class="w3-blue">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Purpose</th>
                            <th>Date Logged</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($visitors as $visitor): ?>
                        <tr>
                            <!-- Display visitor data with HTML escaping for security -->
                            <td><?php echo $visitor['GUEST_ID']; ?></td>
                            <td><?php echo htmlspecialchars($visitor['NAME']); ?></td>
                            <td><?php echo htmlspecialchars($visitor['CONTACT']); ?></td>
                            <td><?php echo htmlspecialchars($visitor['PURPOSE']); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($visitor['DATE_LOGGED'])); ?></td>
                            <td>
                                <!-- Edit button - links to edit.php -->
                                <a href="edit.php?id=<?php echo $visitor['GUEST_ID']; ?>" class="w3-button w3-small w3-green">Edit</a>
                                <!-- Delete button - links to delete.php -->
                                <a href="delete.php?id=<?php echo $visitor['GUEST_ID']; ?>" class="w3-button w3-small w3-red">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
