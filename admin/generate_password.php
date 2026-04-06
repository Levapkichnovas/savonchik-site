<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Скрипт для генерации хеша пароля
$hash = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (!empty($password)) {
        // Создаем хеш (bcrypt)
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Генератор пароля</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background: #f0f2f5;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .result {
            background: #e8f5e9;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            word-break: break-all;
        }

        code {
            font-weight: bold;
            color: #2e7d32;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>🔑 Генератор безопасного пароля</h2>
        <p>Введите новый пароль, чтобы получить его зашифрованный код (хеш).</p>

        <form method="POST">
            <input type="text" name="password" placeholder="Ваш новый пароль" required>
            <button type="submit">Сгенерировать хеш</button>
        </form>

        <?php if ($hash): ?>
            <div class="result">
                <p><strong>Ваш хеш:</strong></p>
                <code><?= $hash ?></code>
                <p><small>Скопируйте этот код и вставьте его в файл <code>admin/login.php</code> вместо старого
                        хеша.</small></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>