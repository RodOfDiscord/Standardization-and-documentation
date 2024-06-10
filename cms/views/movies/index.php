<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Наявні фільми</title>
    <style>
        .card-img-container {
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            height: 150px;
            overflow-y: auto;
        }

        .btn-container {
            margin-top: 10px;
            text-align: center;
        }

        .btn-container .btn {
            margin-top: 10px;
        }

        /* Стилі для маленького меню */
        .sort-menu {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: white;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .sort-menu.active {
            display: block;
        }

        .menu-toggle-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .menu-toggle-btn {
            display: inline-block;
            cursor: pointer;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        #sortMenu {
            display: none;
            margin-top: 10px;
        }

        #sortMenu.active {
            display: block;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Наявні фільми</h1>

    <!-- Форма фільтрації -->
    <button id="filterButton" class="btn btn-secondary">Фільтрувати</button>
    <div id="filterForm" style="display:none;">
        <form method="post" action="/movies/filter">
            <div class="form-group">
                <label for="genre">Жанр:</label>
                <input type="text" id="genre" name="genre" class="form-control">
            </div>
            <div class="form-group">
                <label for="title">Назва фільму:</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="release_Year">Рік випуску:</label>
                <input type="number" id="release_Year" name="release_Year" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Відправити</button>
        </form>
    </div>
    <button id="sortButton" class="btn btn-primary">Сортувати за рейтингом</button>
    <div id="moviesContainer" class="row">
        <!-- Movie cards will be injected here -->
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
    </div>
</div>

<script>
    document.getElementById('filterButton').addEventListener('click', function() {
        var filterForm = document.getElementById('filterForm');
        if (filterForm.style.display === 'none') {
            filterForm.style.display = 'block';
        } else {
            filterForm.style.display = 'none';
        }
    });
    document.getElementById('sortButton').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/movies/sortByRating', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var moviesContainer = document.getElementById('moviesContainer');
                moviesContainer.innerHTML = xhr.responseText; // Оновлення контейнера фільмів
            } else {
                console.error('Сталася помилка: ' + xhr.status);
            }
        };
        xhr.send('sort=rating');
    });

</script>
</body>
</html>
