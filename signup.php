<?php
include "includes/header.php";
include "includes/functions.php";

isLoggedIn();

if(isset($_POST['signup'])) {

    if (!$_POST['username']) {
        $errors[] = "Требуется имя пользователя<br>";
    }

    if (!$_POST['email']) {
        $errors[] = "Требуется адрес электронной почты<br>";
    }

    if (!$_POST['password']) {
        $errors[] = "Требуется пароль<br>";
    }

    if (empty($errors)) {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $query = "SELECT id FROM users WHERE email = '{$email}' LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Адрес электронной почты берется";
        } else {
            $query_insert = "INSERT INTO users (username, email, password) VALUES ('{$username}', '{$email}', '{$password}')";

            if (!mysqli_query($connection, $query_insert)) {
                $errors[] = "Не могу записать вас - пожалуйста, попробуйте снова позже";
            } else {
                $inserted_id = mysqli_insert_id($connection);
                $encrypted_password = md5(md5($inserted_id) . $_POST['password']);
                $query_update_password = "UPDATE users SET password = '$encrypted_password' WHERE id = $inserted_id LIMIT 1";
                mysqli_query($connection, $query_update_password);

                $_SESSION['id'] = $inserted_id;
                header("Location: admin/profile.php");
            }
        }
    }
}

?>


<div class="ui main text container segment">
    <div class="ui hug header">Регистрация</div>

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
            <input type="text" name="username" placeholder="Имя пользователя">
        </div>
        <div class="field">
            <label>E-mail</label>
            <input type="email" name="email" placeholder="E-mail">
        </div>
        <div class="field">
            <label>Пароль</label>
            <input type="password" name="password" placeholder="Пароль">
        </div>

        <button type="submit" class="ui blue basic button" name="signup">Регстрация</button>
    </form>
</div>


<?php include "includes/footer.php"; ?>
