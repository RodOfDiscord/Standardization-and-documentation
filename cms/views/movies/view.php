<?php
/** @var array $movie */
/** @var float $averageRating */
/** @var array $comments */
?>
<div class="container">
    <h1><?= htmlspecialchars($movie['title']) ?></h1>
    <p>Рік випуску: <?= htmlspecialchars($movie['release_Year']) ?></p>
    <p>Жанр: <?= htmlspecialchars($movie['genre']) ?></p>
    <p>Опис: <?= htmlspecialchars($movie['Txt_Description']) ?></p>
    <p>Середня оцінка: <?= htmlspecialchars($averageRating) ?></p>

    <?php if (models\Users::IsUserLogged()): ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="rating">Ваша оцінка:</label>
                <select id="rating" name="rating" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Ваш коментар:</label>
                <textarea id="comment" name="comment" class="form-control" required></textarea>
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
                <li><strong><?= htmlspecialchars($comment['username'] ?? 'Анонімний користувач') ?>:</strong> <?= htmlspecialchars($comment['content']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Немає коментарів до цього фільму.</p>
    <?php endif; ?>
</div>
