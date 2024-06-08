<?php
/** @var string $user */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання нових даних користувача з форми
    $newAddress = $_POST['address'];
    $newNickname = $_POST['nickname'];

    // Оновлення даних користувача у базі даних (цю частину вам потрібно додати самостійно)
    // Припустимо, що дані користувача оновлюються в базі даних

    // Після оновлення даних, перенаправте користувача на ту ж сторінку, щоб побачити оновлені дані
    header("Location: /profile");
    exit;
}

// Відображення форми профілю
include('views/users/profile.php');
?>

<div class="container mt-5">
    <h1>Профіль користувача</h1>
    <form action="users/profile" method="post">
        <div class="mb-3">
            <label for="address" class="form-label">Нова адреса:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
        </div>
        <div class="mb-3">
            <label for="nickname" class="form-label">Новий нікнейм:</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo htmlspecialchars($user['nickname']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</div>
