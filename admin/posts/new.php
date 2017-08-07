<?php
include("../../includes/header.php");
include("../../includes/functions.php");
loginCheck();

if(isset($_POST['publish'])) {

    if (!$_POST['title']) {
        $errors[] = "Требуется заглавие<br>";
    }

    if (!$_POST['category_id']) {
        $errors[] = "Требуется категория<br>";
    }

    if (!$_POST['content']) {
        $errors[] = "Требуется содержание<br>";
    }

    if (empty($errors)) {
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $image = mysqli_real_escape_string($connection, $_POST['image']);
        $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
        $content = mysqli_real_escape_string($connection, $_POST['content']);

        $query_insert = "INSERT INTO posts(title, image, category_id, content, created_at) VALUES('{$title}', '{$image}', {$category_id}, '{$content}', now())";
        $result_insert = mysqli_query($connection, $query_insert);
        $inserted_id = mysqli_insert_id($connection);
        confirm($result_insert);

        header('Location: edit.php?id=' . $inserted_id);
    }
}
?>


<div class="ui main text container segment">
    <div class="ui hug header">Новый пост</div>

    <?php if (!empty($errors)) { ?>
    <div class="ui error message">
        <i class="close icon"></i>
        <div class="header">
            Была/была ошибка/ошибки в вашей форме:
        </div>
        <ul class="list">
            <?php foreach($errors as $error) { ?>
            <li><?php echo $error ?></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>

    <form action="" method="post" class="ui form">
        <div class="field">
            <label>Заглавие</label>
            <input type="text" name="title" placeholder="заглавие">
        </div>
        <div class="field">
            <label>Картинка</label>
            <input type="text" name="image" placeholder="Источник картинки">
        </div>
        <div class="field">
            <label>Категория</label>
            <div class="ui fluid selection dropdown">
                <input type="hidden" name="category_id">
                <i class="dropdown icon"></i>
                <div class="default text">Выберите категорию</div>
                <div class="menu">
                    <?php
                    $query_select = "SELECT * FROM categories";
                    $result_select = mysqli_query($connection, $query_select);
                    confirm($result_select);

                    while($row = mysqli_fetch_assoc($result_select)) { ?>
                        <div class="item" data-value="<?php echo $row['id'] ?>">
                            <?php echo $row['name'] ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="field">
            <label>Содержание</label>
            <textarea name="content" id="" cols="30" rows="20" placeholder="Содержание"></textarea>
        </div>
        <button type="submit" class="ui blue basic button" name="publish">Опубликовать</button>
    </form>
</div>


<?php include("../../includes/footer.php"); ?>
