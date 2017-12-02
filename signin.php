<?php
include "includes/header.php";
include "includes/functions.php";

isLoggedIn();

if(isset($_POST['signin'])) {

    if (!$_POST['email']) {
        $errors[] = "Требуется адрес электронной почты<br>";
    }

    if (!$_POST['password']) {
        $errors[] = "Требуется пароль<br>";
    }

    if (empty($errors)) {
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        $query = "SELECT * FROM users WHERE email = '{$email}'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);

        if (isset($row)) {
            $hashed_password = md5(md5($row['id']) . $_POST['password']);

            if ($hashed_password == $row['password']) {
                $_SESSION['id'] = $row['id'];

                header("Location: admin/profile.php");
            } else {
                $errors[] = "Электронная почта/пароль не может быть найден";
            }
        } else {
            $errors[] = "Электронная почта/пароль не может быть найден";
        }

    }
}

?>


<div class="ui main text container segment">
    <div class="ui hug header">Войти</div>

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
            <label>E-mail</label>
            <input type="email" name="email" placeholder="E-mail">
        </div>
        <div class="field">
            <label>Пароль</label>
            <input type="password" name="password" placeholder="Пароли">
        </div>

        <button type="submit" class="ui blue basic button" name="signin">Войти</button>
    </form>
</div>


<?php include "includes/footer.php"; ?>
