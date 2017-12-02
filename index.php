<?php
include "includes/header.php";
include "includes/functions.php";
?>

<div class="ui main text container">
    <div class="ui huge header">Наши Новости</div>

    <div class="ui top attached segment">
        <div class="ui divided items">

            <?php
            $query_select = "SELECT * FROM posts ORDER BY id DESC";
            $result_select = mysqli_query($connection, $query_select);
            confirm($result_select);

            while($row = mysqli_fetch_assoc($result_select)) { ?>
            <div class="item">
                <div class="image">
                    <a href="show.php?id=<?php echo $row['id'] ?>">
                       <?php if ($row['image']) { ?>
                            <img src="<?php echo $row['image'] ?>" alt="">
                       <?php } else { ?>
                            <img src="http://virtualizationtutorials.com/wp-content/themes/annina-pro/images/no-image-box.png" alt="no image">
                        <?php } ?>
                    </a>
                </div>
                <div class="content">
                    <a href="show.php?id=<?php echo $row['id'] ?>" class="header"><?php echo $row['title'] ?></a>
                    <div class="meta">
                        <span>
                        <?php
                          $category_id = $row['category_id'];
                          echoCategoryName($category_id);
                          echo ' / ';
                          echo $row['created_at']
                        ?>

                        </span>
                    </div>
                    <div class="description">
                        <?php
                        $text = $row['content'];
                        $max_char = 150;
                        if (strlen($text) > $max_char) {
                            $char = $text{$max_char - 1};

                            if (preg_match('/\s/', $text)) {
                                while($char != ' ') {
                                    $char = $text{--$max_char}; // Find a space from the 149th, 148th, 147th character, etc
                                }
                            }
                            echo substr($text, 0, $max_char) . ' ...';
                        } else {
                            echo $text;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>


