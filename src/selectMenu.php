<?php
session_start();


if (!isset($_SESSION['selectedMenus'])) {
    $_SESSION['selectedMenus'] = [];
}

if (isset($_POST['menu']) && isset($_POST['price'])) {
    $menu = $_POST['menu'];
    $price = $_POST['price'];

    $_SESSION['selectedMenus'][] = [
        'menu' => $menu,
        'price' => $price,
        'count' => 1
    ];
}
header("Location: ../index.php");
?>