<?php


use models\Users;

/** @var array $movie Інформація про фільм */
/** @var array $comments Список коментарів */
/** @var bool $isUserLogged Чи залогінений користувач */
?>

<div class="container mt-5">
    <h1><?php echo htmlspecialchars($movie['title'] ?? ''); ?></h1>

    <h2>Коментарі</h2>
    <?php foreach ($comments as $comment): ?>
        <?php $user = Users::getUserById($comment['user_id']); ?>
        <div class="comment mb-3">
            <?php if ($user && isset($user['firstName']) && isset($user['lastName'])): ?>
                <p><strong><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?>:</strong></p>
            <?php endif; ?>
            <p><?php echo htmlspecialchars($comment['content']); ?></p>
        </div>
    <?php endforeach; ?>


    <?php if (Users::IsUserLogged()): ?>
        <h3>Додати коментар</h3>
        <form action="/movies/addComment" method="post">
            <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie['id'] ?? ''); ?>">
            <div class="mb-3">
                <label for="comment" class="form-label">Ваш коментар</label>
                <textarea id="comment" name="comment" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Надіслати</button>
        </form>
    <?php else: ?>
        <p>Будь ласка, <a href="/users/login">увійдіть</a>, щоб залишити коментар.</p>
    <?php endif; ?>
</div>
