<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Наявні фільми</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Наявні фільми</h1>

    <button id="filterButton" class="btn btn-secondary">Фільтрувати</button>
    <div id="filterForm" style="display:none;">
        <form method="post" action="/movies/filter">
            <div class="form-group">
                <label for="title">Назва фільму:</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="genre">Жанр:</label>
                <input type="text" id="genre" name="genre" class="form-control">
            </div>
            <div class="form-group">
                <label for="release_Year">Рік випуску:</label>
                <input type="number" id="release_Year" name="release_Year" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Відправити</button>
        </form>
    </div>

    <button id="sortRatingButton" class="btn btn-primary">Сортувати за рейтингом</button>

    <div id="moviesContainer">
        <div class="row" id="moviesList">
            <?php include 'views/movies/movies_list.php'; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('filterButton').addEventListener('click', function() {
        var filterForm = document.getElementById('filterForm');
        filterForm.style.display = filterForm.style.display === 'none' ? 'block' : 'none';
    });

    document.getElementById('sortRatingButton').addEventListener('click', function() {
        window.location.href = '/movies/sortByRating';
    });
</script>

</body>
</html>
