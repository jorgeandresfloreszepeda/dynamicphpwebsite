<?php
// Start a session for tracking page visits
session_start();

// Initialize visit counter
if (!isset($_SESSION['visit_count'])) {
    $_SESSION['visit_count'] = 0;
}
$_SESSION['visit_count']++;

// Handle form submission for welcome message
$welcome_message = "Welcome to Our Dynamic Website!";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
    $welcome_message = "Hello, $username! Welcome to our site!";
}

// Simple calculator function
function calculate($num1, $num2, $operation) {
    switch ($operation) {
        case 'add':
            return $num1 + $num2;
        case 'subtract':
            return $num1 - $num2;
        case 'multiply':
            return $num1 * $num2;
        case 'divide':
            return $num2 != 0 ? $num1 / $num2 : "Error: Division by zero!";
        default:
            return "Invalid operation";
    }
}

// Handle calculator form submission
$calc_result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation'])) {
    $num1 = floatval($_POST['num1']);
    $num2 = floatval($_POST['num2']);
    $operation = $_POST['operation'];
    $calc_result = "Result: " . calculate($num1, $num2, $operation);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Website</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Dynamic Welcome Message -->
        <h1 class="text-center"><?php echo $welcome_message; ?></h1>
        <p class="text-center">Page Visits: <?php echo $_SESSION['visit_count']; ?></p>

        <!-- Form for user greeting -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Enter Your Name:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Calculator Form -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h3>Simple Calculator</h3>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-4">
                    <div class="mb-3">
                        <label for="num1" class="form-label">Number 1:</label>
                        <input type="number" class="form-control" id="num1" name="num1" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="num2" class="form-label">Number 2:</label>
                        <input type="number" class="form-control" id="num2" name="num2" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="operation" class="form-label">Operation:</label>
                        <select class="form-select" id="operation" name="operation" required>
                            <option value="add">Add</option>
                            <option value="subtract">Subtract</option>
                            <option value="multiply">Multiply</option>
                            <option value="divide">Divide</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Calculate</button>
                </form>
                <?php if ($calc_result): ?>
                    <p class="mt-3"><?php echo $calc_result; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>