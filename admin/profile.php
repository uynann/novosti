<?php
include "../includes/header.php";
include "../includes/functions.php";
loginCheck();

$query = "SELECT * FROM users WHERE id = " . mysqli_real_escape_string($connection, $_SESSION['id']) . " LIMIT 1";
$row = mysqli_fetch_array(mysqli_query($connection, $query));

if(isset($_POST['save'])) {

    if (!$_POST['username']) {
        $errors[] = "Требуется название категории<br>";
    }

    if (!$_POST['email']) {
        $errors[] = "Требуется адрес электронной почты<br>";
    }

    if (empty($errors)) {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        $query_select_user = "SELECT id FROM users WHERE (email = '{$email}') AND (id <> {$_SESSION['id']}) LIMIT 1";
        $result_select_user = mysqli_query($connection, $query_select_user);

        if (mysqli_num_rows($result_select_user) > 0) {
            $errors[] = "Адрес электронной почты берется";
        } else {
            $query_update_user = "UPDATE users SET username = '{$username}', email = '{$email}' WHERE id = {$_SESSION['id']}";
            $result_update_user = mysqli_query($connection, $query_update_user);
            confirm($result_update_user);
            header('Location: '.$_SERVER['PHP_SELF']);
        }
    }
}

?>


<div class="ui main text container segment">
    <div class="ui hug header">Мой профил</div>
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
            <label>Имя пользователя</label>
            <input type="text" name="username" placeholder="Имя пользователя" value="<?php echo $row['username'] ?>">
        </div>
        <div class="field">
            <label>E-mail</label>
            <input type="email" name="email" placeholder="E-mail" value="<?php echo $row['email'] ?>">
        </div>
        <button type="submit" class="ui blue basic button" name="save">Сохранить</button>
    </form>
</div>


<?php include "../includes/footer.php"; ?>
