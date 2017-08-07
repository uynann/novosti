<?php
function loginCheck() {
    if (!array_key_exists("id", $_SESSION)) {
        header("Location: " . ROOT_DIR . "index.php");
    }
}

function isLoggedIn() {
    if (isset($_SESSION['id'])) {
        header("Location: admin/profile.php");
    }
}

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED MAN!". mysqli_error($connection));
    }
}

function echoCategoryName($category_id) {
    global $connection;
    $select_category_query = "SELECT * FROM categories WHERE id = {$category_id} LIMIT 1";
    $select_category_result = mysqli_query($connection, $select_category_query);
    confirm($select_category_result);
    $rowCat = mysqli_fetch_assoc($select_category_result);
    echo $rowCat['name'];
}

