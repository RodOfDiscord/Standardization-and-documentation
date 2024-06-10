<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагування профілю</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ece9e6, #ffffff);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin: auto; /* Додаємо цей стиль, щоб центрувати контейнер */
            margin-top: 20px; /* Додаємо відступ зверху для виправлення проблеми з перекриттям хедера */
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .success-message, .error-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            font-weight: bold;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            text-align: left;
        }

        input[type="text"] {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            width: calc(100% - 1rem);
            box-sizing: border-box;
        }

        button {
            background: #4CAF50;
            color: #fff;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #45a049;
        }

        .form-group {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Редагування профілю</h1>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Форма редагування профілю -->
            <form method="POST" action="/users/profile">
                <div class="form-group">
                    <label for="firstName">Ім'я:</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($user['firstname'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Прізвище:</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>">
                </div>
                <button type="submit">Зберегти зміни</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>