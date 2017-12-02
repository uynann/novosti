<?php
include("../../includes/header.php");
include("../../includes/functions.php");
loginCheck();

if(isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $query_select_udate = "SELECT * FROM posts WHERE id = $post_id LIMIT 1";
    $select_result =mysqli_query($connection, $query_select_udate);

    confirm($select_result);
    $row = mysqli_fetch_assoc($select_result) ;

} else {
    header("Location: index.php");
}

if(isset($_POST['save'])) {

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

        $query_update = "UPDATE posts SET title = '{$title}', category_id = {$category_id}, image = '{$image}', content = '{$content}' WHERE id = {$post_id}";
        $result_update = mysqli_query($connection, $query_update);
        confirm($result_update);
        header('Location: '.$_SERVER['PHP_SELF'] . '?id=' . $post_id);
    }
}
?>


<div class="ui main text container segment">
    <div class="ui hug header">Редактировать пост</div>

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
            <input type="text" name="title" placeholder="заглавие" value="<?php echo $row['title'] ?>">
        </div>
        <div class="field">
            <label>Картинка</label>
            <input type="text" name="image" placeholder="Источник картинки" value="<?php echo $row['image'] ?>">
        </div>
        <div class="field">
            <label>Категория</label>
            <div class="ui fluid selection dropdown">
                <input type="hidden" name="category_id" value="<?php echo $row['category_id'] ?>">
                <i class="dropdown icon"></i>
                <div class="default text">Выберите категорию</div>
                <div class="menu">
                    <?php
                    $query_select = "SELECT * FROM categories";
                    $result_select = mysqli_query($connection, $query_select);
                    confirm($result_select);

                    while($row1 = mysqli_fetch_assoc($result_select)) { ?>
                    <div class="item" data-value="<?php echo $row1['id'] ?>">
                        <?php echo $row1['name'] ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="field">
            <label>Содержание</label>
            <textarea name="content" id="" cols="30" rows="20" placeholder="Содержание"><?php echo $row['content'] ?></textarea>
        </div>
        <button type="submit" class="ui blue basic button" name="save">Сохранить</button>
    </form>
</div>

<?php include("../../includes/footer.php"); ?>
