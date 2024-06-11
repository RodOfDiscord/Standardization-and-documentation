
<?php if (!empty($movies)): ?>
    <?php foreach ($movies as $movie): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-img-container">
                    <?php if (!empty($movie['image'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($movie['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($movie['title']); ?>">
                    <?php elseif (!empty($movie['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($movie['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($movie['title']); ?>">
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($movie['title']); ?></h5>
                    <p class="card-text">
                        <strong>Рік випуску:</strong> <?php echo htmlspecialchars($movie['release_Year']); ?><br>
                        <strong>Жанр:</strong> <?php echo htmlspecialchars($movie['genre']); ?><br>
                        <strong>Опис:</strong> <?php echo htmlspecialchars($movie['Txt_Description']); ?>
                    </p>
                </div>
                <div class="btn-container">
                    <a href="/movies/view/<?php echo htmlspecialchars($movie['id']); ?>" class="btn btn-secondary">Переглянути, оцінити та коментувати</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Немає доступних фільмів.</p>
<?php endif; ?>
