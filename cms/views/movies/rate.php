<?php
/** @var array $movie */
/** @var float $averageRating */
?>
<div class="container">
    <h1><?= htmlspecialchars($movie['title']) ?></h1>
    <p>Рік випуску: <?= htmlspecialchars($movie['release_Year']) ?></p>
    <p>Жанр: <?= htmlspecialchars($movie['genre']) ?></p>
    <p>Опис: <?= htmlspecialchars($movie['Txt_Description']) ?></p>
    <p>Середня оцінка: <?= htmlspecialchars($averageRating) ?></p>

    <?php if (models\Users::IsUserLogged()): ?>
        <form method="post" action="/movies/rate/<?= htmlspecialchars($movie['id']) ?>">
            <label for="rating">Ваша оцінка:</label>
            <select id="rating" name="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit" class="btn btn-primary">Залишити оцінку</button>
        </form>
    <?php else: ?>
        <p>Щоб залишити оцінку, будь ласка, <a href="/users/login">увійдіть в систему</a>.</p>
    <?php endif; ?>
</div>
