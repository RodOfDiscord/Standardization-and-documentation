<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Наявні фільми</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card-img-container {
            width: 100%;
            height: 600px;
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
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn-container .btn {
            margin: 5px;
            background-color: yellow;
            color: blue;
            border: none;
            font-size: 18px; /* Зміна розміру шрифту */
            font-weight: bold; /* Додавання жирності шрифту */
        }

        .btn-container .btn:hover {
            background-color: gold;
            color: darkblue;
        }

        #filterForm {
            margin-top: 20px;
            display: none;
        }

        #moviesContainer {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Наявні фільми:</h1>

    <div class="btn-container">
        <button id="filterButton" class="btn btn-secondary">Фільтрувати</button>
        <button id="sortRatingButton" class="btn btn-primary">Сортувати за рейтингом</button>
    </div>

    <div id="filterForm">
        <form method="post" action="/movies/filter">
            <div class="form-group mb-3">
                <label for="title">Назва фільму:</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="genre">Жанр:</label>
                <input type="text" id="genre" name="genre" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="release_Year">Рік випуску:</label>
                <input type="number" id="release_Year" name="release_Year" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Відправити</button>
        </form>
    </div>

    <div id="moviesContainer">
        <div class="row" id="moviesList">
            <?php include 'views/movies/movies_list.php'; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#filterButton').click(function() {
            $('#filterForm').toggle();
        });

        $('#filterFormElement').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '/movies/filter',
                type: 'POST',
                dataType: 'html',
                data: $(this).serialize(),
                success: function(response){
                    $('#moviesList').html(response);
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        });

        $('#sortRatingButton').click(function() {
            $.ajax({
                url: '/movies/sortByRating',
                type: 'GET',
                dataType: 'html',
                success: function(response){
                    $('#moviesList').html(response);
                    window.location.href = '/movies/sortByRating';
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
</body>
</html>
