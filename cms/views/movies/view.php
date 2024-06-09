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
        .fixed-size-img-container {
            width: 500px;
            height: 500px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .fixed-size-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .comment-date {
            font-size: 0.8em;
            color: gray;
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
</div>

<?php if (models\Users::IsUserLogged()): ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="rating">Ваша оцінка:</label>
            <select id="rating" name="rating" class="form-control">
                <option value="">Без оцінки</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
        <div class="form-group">
            <label for="comment">Ваш коментар:</label>
            <textarea id="comment" name="comment" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Залишити оцінку та коментар</button>
    </form>
<?php else: ?>
    <p>Щоб залишити оцінку і коментар, будь ласка, <a href="/users/login">увійдіть в систему</a>.</p>
<?php endif; ?>

<h2>Коментарі</h2>
<?php if (!empty($comments)): ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?= htmlspecialchars($comment['username'] ?? 'Анонімний користувач') ?>:</strong>
                <span class="comment-date"><?= htmlspecialchars($comment['created_at']) ?></span>
                <?= htmlspecialchars($comment['content']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Немає коментарів до цього фільму.</p>
<?php endif; ?>
</div>
</body>
</html>
