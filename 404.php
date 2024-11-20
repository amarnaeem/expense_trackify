<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h2>404 - Page Not Found</h2>
        <p>Sorry, the page you're looking for does not exist.</p>
        <button onclick="handleBack()">Go Back</button>
    </main>

    <script>
        function handleBack() {
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
                // Redirect to the dashboard if the user is logged in
                window.location.href = 'dashboard.php';
            <?php else: ?>
                // Redirect to the login page if the user is not logged in
                window.location.href = 'login.php';
            <?php endif; ?>
        }
    </script>
</body>
</html>
