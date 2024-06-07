<?php
/** @var array $movies Список фільмів */
?>
<div class="container mt-5">
    <style>
        .card-img-container {
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .card-body {
            height: 300px;
            overflow-y: auto;
        }

        .btn-container {
            position: relative;
        }

        .btn-container .btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
    <h1 class="mb-4">Наявні фільми</h1>
    <div class="row">
        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="btn-container">
                            <a href="/movies/view?id=<?php echo htmlspecialchars($movie['id']); ?>" class="btn btn-secondary">Коментувати</a>
                        </div>
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
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Немає доступних фільмів.</p>
        <?php endif; ?>
    </div>
</div>
