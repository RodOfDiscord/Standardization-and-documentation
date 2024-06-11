<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагування профілю</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .success-message {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error-message {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        button[type="submit"] {
            background-color: yellow;
            color: blue;
            border: none;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }

        button[type="submit"]:hover {
            background-color: gold;
            color: darkblue;
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
    <?php endif; ?>

    <form method="POST" action="/users/profile">
        <div class="form-group">
            <label for="firstName">Ім'я:</label>
            <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo htmlspecialchars($user['firstname'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="lastName">Прізвище:</label>
            <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Зберегти зміни</button>
        </div>
    </form>
</div>
</body>
</html>
