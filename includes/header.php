<?php
ob_start();
define('ROOT_DIR', '/my-site-6/');
define('CSS_DIR', ROOT_DIR . 'css/');
define('JS_DIR', ROOT_DIR . 'js/');
define('ADMIN_DIR', ROOT_DIR . 'admin/');
include $_SERVER["DOCUMENT_ROOT"] . ROOT_DIR . "includes/db.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$query_select = "SELECT * FROM categories";
$result_select = mysqli_query($connection, $query_select);
$result_select1 = mysqli_query($connection, $query_select);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <link rel="stylesheet" media="screen" href="https://oss.maxcdn.com/semantic-ui/2.1.8/semantic.min.css">
    <link rel="stylesheet" href="<?php echo CSS_DIR ?>styles.css"type="text/css">
</head>



<body>
    <div class="ui fixed inverted menu">
        <div class="ui container">
            <a class="item <?php if($_SERVER['SCRIPT_NAME'] == ROOT_DIR . "index.php") { echo "active"; } ?>" href="<?php echo ROOT_DIR ?>">
                <i class="newspaper icon"></i>
                Новости
            </a>

            <?php
            while($row = mysqli_fetch_assoc($result_select)) { ?>
            <a class="item nav-category <?php if(($_SERVER['SCRIPT_NAME'] . "?id=" . $id) == (ROOT_DIR . "categories.php?id=" . $row['id'])) { echo "active"; } ?>" href="<?php echo ROOT_DIR ?>categories.php?id=<?php echo $row['id'] ?>">
                <?php echo $row['name'] ?>
            </a>
            <?php } ?>




            <?php if (!isset($_SESSION['id'])) { ?>
                <a class="item nav-user right <?php if($_SERVER['SCRIPT_NAME'] == ROOT_DIR . "signin.php") { echo "active"; } ?>" href="signin.php">
                    Войти
                </a>
                <a class="item nav-user <?php if($_SERVER['SCRIPT_NAME'] == ROOT_DIR . "signup.php") { echo "active"; } ?>" href="signup.php">
                    Регистрация
                </a>
            <?php } else {
                $query = "SELECT username FROM users WHERE id = " . mysqli_real_escape_string($connection, $_SESSION['id']) . " LIMIT 1";
                $row = mysqli_fetch_array(mysqli_query($connection, $query));
                $username = $row['username'];
            ?>
            <div class="ui dropdown item left nav-action">
                <div class="text"><i class="plus icon"></i>Создать</div>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="<?php echo ADMIN_DIR ?>posts/new.php">Новый пост</a>
                    <a class="item" href="<?php echo ADMIN_DIR ?>categories/index.php">Новую категорию</a>
                </div>
            </div>

            <div class="ui dropdown item right nav-user">
                <div class="text"><?php echo $username ?></div>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="<?php echo ADMIN_DIR ?>posts/index.php">Все посты</a>
                    <a class="item" href="<?php echo ADMIN_DIR ?>categories/index.php">Все категории</a>
                    <div class="divider"></div>
                    <a class="item" href="<?php echo ADMIN_DIR ?>profile.php">Мой профиль</a>
                    <div class="divider"></div>
                    <a href="<?php echo ROOT_DIR ?>signout.php" class="item">Выйти</a>
                </div>
            </div>
            <?php } ?>

            <span class="item right nav-btn active icon"><i class="content icon"></i></span>
        </div>
    </div>

    <div class="nav-overlay"></div>

    <div class="nav-categories-mobile">
        <?php while($row = mysqli_fetch_assoc($result_select1)) { ?>
        <a class="nav-category-mobile <?php if(($_SERVER['SCRIPT_NAME'] . "?id=" . $id) == (ROOT_DIR . "categories.php?id=" . $row['id'])) { echo "active"; } ?>" href="<?php echo ROOT_DIR ?>categories.php?id=<?php echo $row['id'] ?>">
            <?php echo $row['name'] ?>
        </a>
        <?php }

        if (!isset($_SESSION['id'])) { ?>
        <a class="nav-user-mobile <?php if($_SERVER['SCRIPT_NAME'] == ROOT_DIR . "signin.php") { echo "active"; } ?>" href="signin.php">
            Войти
        </a>
        <a class="nav-user-mobile <?php if($_SERVER['SCRIPT_NAME'] == ROOT_DIR . "signup.php") { echo "active"; } ?>" href="signup.php">
            Регистрация
        </a>
        <?php }  else { ?>
        <a class="nav-user-mobile" href="<?php echo ADMIN_DIR ?>posts/index.php">Все посты</a>
        <a class="nav-user-mobile" href="<?php echo ADMIN_DIR ?>categories/index.php">Все категории</a>
        <a class="nav-user-mobile" href="<?php echo ADMIN_DIR ?>profile.php">Мой профиль</a>
        <a href="<?php echo ROOT_DIR ?>signout.php" class="nav-user-mobile">Выйти</a>

        <?php } ?>

    </div>

