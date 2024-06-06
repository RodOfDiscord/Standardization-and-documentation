<?php if (!isset($movie) || empty($movie)): ?>
    <p class="not-found">Фільм не знайдено.</p>
<?php else: ?>
    <form method="post" enctype="multipart/form-data" class="movie-form">
        <div class="form-group">
            <label for="title">Назва:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required>
        </div>

        <div class="form-group">
            <label for="release_Year">Рік випуску:</label>
            <input type="number" id="release_Year" name="release_Year" value="<?= htmlspecialchars($movie['release_Year']) ?>" required>
        </div>

        <div class="form-group">
            <label for="genre">Жанр:</label>
            <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($movie['genre']) ?>" required>
        </div>

        <div class="form-group">
            <label for="Txt_Description">Опис:</label>
            <textarea id="Txt_Description" name="Txt_Description" required><?= htmlspecialchars($movie['Txt_Description']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Зображення:</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="submit-button">Оновити</button>
    </form>
<?php endif; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 20px;
    }

    .not-found {
        color: #ff0000;
        font-size: 18px;
        margin: 20px 0;
    }

    .movie-form {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group textarea,
    .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-group textarea {
        height: 100px;
    }

    .submit-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .submit-button:hover {
        background-color: #45a049;
    }
</style>
