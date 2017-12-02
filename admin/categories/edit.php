<?php
include("../../includes/header.php");
include("../../includes/functions.php");
loginCheck();

if(isset($_GET['id'])) {
    $cat_id = $_GET['id'];
    $query_select_udate = "SELECT * FROM categories WHERE id = $cat_id LIMIT 1";
    $select_result =mysqli_query($connection, $query_select_udate);

    confirm($select_result);
    $row = mysqli_fetch_assoc($select_result) ;

} else {
    header("Location: index.php");
}

if(isset($_POST['save'])) {

    if (!$_POST['name']) {
        $errors[] = "Требуется название категории<br>";
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);

        $query = "SELECT id FROM categories WHERE (name = '{$name}') AND (id <> {$cat_id}) LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Название категории берется";
        } else {
            $query_update = "UPDATE categories SET name = '{$name}' WHERE id = {$cat_id}";
            $result_update = mysqli_query($connection, $query_update);
            confirm($result_update);
            header('Location: index.php');
        }
    }
}
?>

<div class="ui main text container segment">
    <div class="ui hug header">Редактировать категорию</div>

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
            <input type="text" name="name" placeholder="Название" value="<?php echo $row['name'] ?>">
        </div>
        <button type="submit" class="ui blue basic button" name="save">Сохранить</button>
    </form>
</div>


<?php include("../../includes/footer.php"); ?>
