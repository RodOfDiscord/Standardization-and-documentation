<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI Документація</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            background: #fff;
            border-radius: 5px;
            max-width: 300px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: blue;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .btn.small { padding: 5px 10px; font-size: 12px; }
        .btn.large { padding: 12px 20px; font-size: 18px; }
        .btn.red { background: red; }
        .btn.green { background: green; }
    </style>
</head>
<body>

<div class="container">
    <h1>Документація UI компонентів</h1>

    <!-- Компонент MovieCard -->
    <h2>Компонент: MovieCard</h2>
    <p><strong>Опис:</strong> Компонент, який відображає інформацію про фільм, включаючи його назву, рік, жанр та короткий опис.</p>
    <p><strong>Властивості:</strong></p>
    <ul>
        <li><strong>title</strong> (string): Назва фільму</li>
        <li><strong>year</strong> (string): Рік випуску фільму</li>
        <li><strong>genre</strong> (string): Жанр фільму</li>
        <li><strong>desc</strong> (string): Короткий опис фільму</li>
    </ul>
    <p><strong>Як використовувати:</strong> Використовуйте цей компонент для відображення інформації про фільм на вашій сторінці.</p>
    <pre>
    <?php
    function renderMovieCard($title, $year, $genre, $desc) {
        echo "<div class='card'>";
        echo "<h3>" . htmlspecialchars($title) . "</h3>";
        echo "<p><strong>Рік:</strong> " . htmlspecialchars($year) . "</p>";
        echo "<p><strong>Жанр:</strong> " . htmlspecialchars($genre) . "</p>";
        echo "<p>" . htmlspecialchars($desc) . "</p>";
        echo "</div>";
    }

    renderMovieCard("Інтерстеллар", "2014", "Фантастика", "Наукова експедиція у чорну діру.");
    renderMovieCard("Джон Вік", "2014", "Бойовик", "Колишній найманий вбивця повертається.");
    renderMovieCard("Гаррі Поттер", "2001", "Фентезі", "Історія про хлопчика-чарівника.");
    ?>
    </pre>

    <!-- Компонент Button -->
    <h2>Компонент: Button</h2>
    <p><strong>Опис:</strong> Компонент для створення кнопок з різними варіаціями стилів. Може використовуватися для створення звичайних кнопок, кнопок із різними кольорами та розмірами.</p>
    <p><strong>Властивості:</strong></p>
    <ul>
        <li><strong>text</strong> (string): Текст, що відображається на кнопці.</li>
        <li><strong>color</strong> (string): Колір кнопки. Можливі значення: "blue", "red", "green".</li>
        <li><strong>size</strong> (string): Розмір кнопки. Можливі значення: "small", "medium", "large".</li>
    </ul>
    <p><strong>Як використовувати:</strong> Використовуйте цей компонент для створення кнопок різних стилів та розмірів.</p>
    <pre>
    <?php
    function renderButton($text, $color = "blue", $size = "medium") {
        $class = "btn " . htmlspecialchars($color) . " " . htmlspecialchars($size);
        echo "<button class='$class'>" . htmlspecialchars($text) . "</button>";
    }

    renderButton("Звичайна кнопка");
    renderButton("Червона кнопка", "red");
    renderButton("Зелена кнопка", "green");
    renderButton("Маленька кнопка", "blue", "small");
    renderButton("Велика кнопка", "blue", "large");
    ?>
    </pre>

    <h3>Інтерактивність:</h3>
    <p>Ви можете натискати на кнопки, щоб перевірити їхню реакцію. Кожна кнопка має свій колір та розмір, і може бути використана для різних сценаріїв на вашому сайті.</p>
</div>

<script>
    // JavaScript для додавання інтерактивності до кнопок
    document.querySelectorAll('.btn').forEach(function(button) {
        button.addEventListener('click', function() {
            alert('Ви натискали кнопку: ' + button.innerText);
        });
    });
</script>

</body>
</html>
