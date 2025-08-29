<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Login</title>
</head>
<body>
    <!-- Script alert untuk flashdata -->
    <?php if (session()->getFlashdata('error')): ?>
        <script>
            alert("<?= esc(session()->getFlashdata('error')) ?>");
        </script>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('success')): ?>
        <script>
            alert("<?= esc(session()->getFlashdata('success')) ?>");
        </script>
    <?php endif; ?>

    <header>
        <h1>NutriScan</h1>
    </header>
    <div class="form-container">
        <h2>Masuk</h2>

        <form method="POST" action="/login">
            <div class="form-group">
                <label for="login">Nama/Email:</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="button">Masuk</button>
        </form>

        <div class="toggle-link">
            <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>
        </div>
    </div>

    <footer>
        &copy; 2024 NutriScan
    </footer>
</body>
</html>
