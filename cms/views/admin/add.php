<?php
$this->Title = 'Додати новий фільм';
?>
<div class="container mt-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Назва фільму</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="release_Year">Рік випуску</label>
            <input type="number" class="form-control" id="release_Year" name="release_Year" required>
        </div>
        <div class="form-group">
            <label for="genre">Жанр</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <div class="form-group">
            <label for="Txt_Description">Опис фільму</label>
            <textarea class="form-control" id="Txt_Description" name="Txt_Description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Завантажити зображення</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Додати фільм</button>
    </form>
</div>
