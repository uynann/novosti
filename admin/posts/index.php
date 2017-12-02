<?php
include("../../includes/header.php");
include("../../includes/functions.php");
loginCheck();

if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];

    $query_delete_post = "DELETE FROM posts WHERE id = $post_id";
    $result_delete_post = mysqli_query($connection, $query_delete_post);
    confirm($result_delete_post);

    header("Location: index.php");
}

?>

<div class="ui main text container segment">
    <div class="ui hug header">Все посты</div>
    <a href="new.php" class="ui blue basic button">Создать</a>

    <div class="ui middle aligned divided list">
        <?php
        $query_select = "SELECT * FROM posts ORDER BY id DESC";
        $result_select = mysqli_query($connection, $query_select);
        confirm($result_select);

        while($row = mysqli_fetch_assoc($result_select)) { ?>
        <div class="item">
            <div class="right floated content action-buttons">
                <a class="tiny ui blue basic button" href="edit.php?id=<?php echo $row['id'] ?>">Редактировать</a>
                <a class="tiny ui red basic button delete-post" data-url="index.php?delete=<?php echo $row['id'] ?>">Удалить</a>
            </div>
            <div class="right floated content action-buttons-mobile">
                <a href="edit.php?id=<?php echo $row['id'] ?>" class="tiny ui blue basic button icon"><i class="edit icon"></i></a>
                <a class="tiny ui red basic button delete-post icon" data-url="index.php?delete=<?php echo $row['id'] ?>"><i class="remove icon"></i></a>
            </div>
            <img class="ui avatar image" src="<?php if ($row['image']) echo $row['image']; ?>">
            <div class="content">
                <a class="header" href="<?php echo ROOT_DIR ?>show.php?id=<?php echo $row['id'] ?>">
                <?php
                  $text = $row['title'];
                  $max_char = 60;
                  if (strlen($text) > $max_char) {
                      $char = $text{$max_char - 1};

                      if (preg_match('/\s/', $text)) {
                          while($char != ' ') {
                              $char = $text{--$max_char}; // Find a space from the 59th, 58th, 57th character, etc
                          }
                      }

                      echo substr($text, 0, $max_char) . '...';
                  } else {
                      echo $text;
                  }


                ?>
                </a>
                <div class="description">
                    <?php
                    $category_id = $row['category_id'];
                    echoCategoryName($category_id);
                    ?>
                </div>
            </div>
        </div>
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


<?php include("../../includes/footer.php"); ?>
