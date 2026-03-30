<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="auth-container">
    <h1>Create Account</h1>

    <form action="register_action.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role">
            <option value="intern">Intern</option>
            <option value="manager">Manager</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>