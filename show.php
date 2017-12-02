<?php
include "includes/header.php";
include "includes/functions.php";

if(isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $query_select_udate = "SELECT * FROM posts WHERE id = $post_id LIMIT 1";
    $select_result =mysqli_query($connection, $query_select_udate);

    confirm($select_result);
    $row = mysqli_fetch_assoc($select_result) ;

} else {
    header("Location: index.php");
}

?>


<div class="ui main text container segment">
    <div class="ui hug header post-header"><?php echo $row['title'] ?></div>
    <span>
    <?php
    $category_id = $row['category_id'];
    echoCategoryName($category_id);
    echo ' / ';
    echo $row['created_at'];
    ?>
    </span>

    <div class="ui top attached">
        <div class="item">
            <?php if ($row['image']) { ?>
                <img src="<?php echo $row['image'] ?>" alt="" class="ui centered rounded image">
            <?php } ?>
        </div>

        <div class="description">
            <?php echo $row['content'] ?>
        </div>

        <?php if (isset($_SESSION['id'])) { ?>
            <a href="admin/posts/edit.php?id=<?php echo $row['id'] ?>" class="ui blue basic button">Редактировать</a>
            <a class="ui red basic button delete-post" data-url="admin/posts/index.php?delete=<?php echo $row['id'] ?>">Удалить</a>
        <?php } ?>
    </div>
</div>

<div class="ui small modal modal-delete-post">
    <div class="header">Удалить пост</div>
    <div class="content">
        <p>Вы уверены, что хотите удалить пост?</p>
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



<?php include "includes/footer.php"; ?>
