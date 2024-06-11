<?php
/** @var array $movie */
/** @var float $averageRating */
/** @var array $comments */
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Деталі фільму</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .comment {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment-user {
            font-weight: bold;

        }

        .comment-date {
            font-size: 0.8em;
            color: #777;
        }

        .comment-text {
            margin-top: 5px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: yellow;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        p {
            margin-bottom: 10px;
            line-height: 1.5;
        }
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 4px;
            margin-bottom: 8px;
            resize: vertical;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        .comment-date {
            font-size: 0.8em;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Що у вас на думці про фільм: <?= htmlspecialchars($movie['title']) ?>?</h2>
    <?php if (isset($movie['image_path']) && !empty($movie['image_path'])): ?>
        <div class="fixed-size-img-container">
            <img src="<?= htmlspecialchars($movie['image_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
        </div>
    <?php endif; ?>
    <p>Рік випуску: <?= htmlspecialchars($movie['release_Year']) ?></p>
    <p>Жанр: <?= htmlspecialchars($movie['genre']) ?></p>
    <p>Опис: <?= htmlspecialchars($movie['Txt_Description']) ?></p>
    <p>Середня оцінка: <?= htmlspecialchars($averageRating) ?></p>

    <?php if (models\Users::IsUserLogged()): ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="rating">Ваша оцінка:</label>
                <select id="rating" name="rating">
                    <option value="">Без оцінки</option>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Ваш коментар:</label>
                <textarea id="comment" name="comment" rows="4"></textarea>
            </div>
            <button type="submit" class="btn">Залишити оцінку та коментар</button>
        </form>
    <?php else: ?>
        <p>Щоб залишити оцінку і коментар, будь ласка, <a href="/users/login">увійдіть в систему</a>.</p>
    <?php endif; ?>

    <h2>Коментарі</h2>
    <?php if (!empty($comments)): ?>
        <ul class="comments">
            <?php foreach ($comments as $comment): ?>
                <li class="comment">
                    <div class="comment-header">
                        <span class="comment-user"><?= htmlspecialchars($comment['username'] ?? 'Анонімний користувач') ?>:</span>
                        <span class="comment-date"><?= htmlspecialchars($comment['created_at']) ?></span>
                    </div>
                    <div class="comment-text"><?= htmlspecialchars($comment['content']) ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Немає коментарів до цього фільму.</p>
    <?php endif; ?>

</div>
</body>
</html>
