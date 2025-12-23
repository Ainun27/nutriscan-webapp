<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Register</title>

    <?php if (isset($success)): ?>
    <script>
        alert("<?= esc($success) ?>");
    </script>
    <?php endif; ?>

    <?php if (isset($error)): ?>
    <script>
        alert("<?= esc($error) ?>");
    </script>
    <?php endif; ?>

</head>
<body>
    <header>
        <h1>NutriScan</h1>
    </header>
    <div class="form-container">
        <h2>Daftar</h2>

        <form method="POST" action="/register">
            <div class="form-group">
                <label for="username">Nama:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="button">Daftar</button>
        </form>

        <div class="toggle-link">
            <p>Sudah punya akun? <a href="/login">Masuk di sini</a></p>
        </div>
    </div>

    <footer>
        &copy; 2024 NutriScan
    </footer>
</body>
</html>
