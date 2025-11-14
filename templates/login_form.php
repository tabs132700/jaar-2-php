<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        form { max-width: 320px; display: grid; gap: 1rem; }
        label { display: grid; gap: 0.25rem; font-weight: 600; }
        input { padding: 0.5rem; font-size: 1rem; }
        .error { color: #b00020; }
    </style>
</head>
<body>
<h1>Login</h1>

<?php if (!empty($error)): ?>
    <p class="error">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="post" action="login.php" autocomplete="off">
    <label>
        Email
        <input type="email" name="email" required>
    </label>
    <label>
        Password
        <input type="password" name="password" required>
    </label>
    <button type="submit">Login</button>
</form>
</body>
</html>
