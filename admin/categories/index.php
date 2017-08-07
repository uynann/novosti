<?php
include("../../includes/header.php");
include("../../includes/functions.php");
loginCheck();


if(isset($_POST['create'])) {

    if (!$_POST['name']) {
        $errors[] = "Требуется название категории<br>";
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);

        $query = "SELECT id FROM categories WHERE name = '{$name}' LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Название категории берется";
        } else {
            $query_insert = "INSERT INTO categories(name) VALUES('{$name}')";
            $result_insert = mysqli_query($connection, $query_insert);
			confirm($result_insert);
            header('Location: '.$_SERVER['PHP_SELF']);
        }
    }
}


if(isset($_GET['delete'])){
    $category_id = $_GET['delete'];

    $query_delete_posts = "DELETE FROM posts WHERE category_id = $category_id";
    $result_delete_posts = mysqli_query($connection, $query_delete_posts);
    confirm($result_delete_posts);


    $query_delete_category = "DELETE FROM categories WHERE id = $category_id";
    $result_delete_category = mysqli_query($connection, $query_delete_category);
    confirm($result_delete_category);
    header("Location: index.php");
}

?>

<div class="ui main text container segment">
    <div class="ui hug header">Все категории</div>

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
            <label>Название</label>
            <input type="text" name="name" placeholder="Название">
        </div>
        <button type="submit" class="ui blue basic button" name="create">Создать</button>
    </form>

    <div class="ui middle aligned divided list">
        <?php
        $query_select = "SELECT * FROM categories ORDER BY id DESC";
        $result_select = mysqli_query($connection, $query_select);
        confirm($result_select);

        while($row = mysqli_fetch_assoc($result_select)) { ?>
            <div class="item">
                <div class="right floated content action-buttons">
                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="tiny ui blue basic button">Редактировать</a>
                    <a class="tiny ui red basic button delete-category" data-id="<?php echo $row['id'] ?>">Удалить</a>
                </div>
                <div class="right floated content action-buttons-mobile">
                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="tiny ui blue basic button icon"><i class="edit icon"></i></a>
                    <a class="tiny ui red basic button delete-category icon" data-id="<?php echo $row['id'] ?>"><i class="remove icon"></i></a>
                </div>
                <div class="content">
                    <a class="header"><?php echo $row['name'] ?></a>
                </div>
            </div>
        <?php } ?>

    </div>
</div>


<div class="ui small modal modal-delete-category">
    <div class="header">Удалить категорию</div>
    <div class="content">
        <p>Вы уверены, что хотите удалить категорию? Все посты в этой категории будут также удалены.</p>
    </div>
    <div class="actions">
        <div class="ui black deny button">
            Отмена
        </div>
        <a class="ui positive right labeled icon button ok-button" href="">
            Удалить
            <i class="checkmark icon"></i>
        </a>
    </div>
</div>


<?php include("../../includes/footer.php"); ?>
