<?php
session_start();
require_once 'src/menus.php';
$selectedMenus = isset($_SESSION['selectedMenus']) ? $_SESSION['selectedMenus'] : [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food | Order Your Foods</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <header>
        <nav class="navbar shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="images/logo.png" alt="Logo" width="71" height="40" class="d-inline-block align-text-top">
                </a>
                <form class="d-flex" role="search" action="" method="GET">
                    <input class="form-control me-2" style="border-color: #f95e07;" type="search"
                        placeholder="Search menu..." value="<?= $_GET['search'] ?? '' ?>" aria-label="Search"
                        name="search" id="searchInput">
                    <button class="btn" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>
    <main class="container py-4">
        <section class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fs-3">Welcome, let's order!</h1>
            <div class="d-flex gap-3">
                <button type="button"
                    class="menu-selected btn py-1 px-2 d-flex gap-2 align-items-center justify-content-between"
                    data-toggle="tooltip" data-placement="bottom" title="Order Details" data-bs-toggle="modal"
                    data-bs-target="#modalMenu">
                    <img src="images/icons/cart.svg" width="25" height="25" alt="">
                    <p class="m-0 fs-5 fw-semibold">Order: <span class="order-count">0</span>
                    </p>
                </button>
            </div>
        </section>

        <section>
            <h2 class="fs-5">Menu</h2>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                <?php foreach ($menus as $menu): ?>
                    <form id="menuForm">
                        <div class="col">
                            <div class="card" style="width: 100%;">
                                <img src="images/<?= $menu['image'] ?>" class="card-img-top img-fluid" alt="..."
                                    style="object-fit: cover; height: 200px;">

                                <div class="card-body">
                                    <h5 class="card-title fw-normal fs-5 menu-name">
                                        <?= $menu['name'] ?>
                                    </h5>
                                    <p class="card-text fw-bold fs-5 price">
                                        <?= $menu['price'] ?>
                                    </p>
                                    <input type="hidden" name="menu" value="<?= $menu['name'] ?>">
                                    <input type="hidden" name="price" value="<?= $menu['price'] ?>">
                                    <button type="button" class="btn w-100 button-menu">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="px-3 gap-2 d-flex flex-lg-row flex-column" id="modalContent">
                                <div class=" rounded p-2 shadow-sm w-100 " style="background-color: white;">
                                    <?php if (isset($selectedMenus)): ?>
                                        <?php foreach ($selectedMenus as $selectedMenu): ?>
                                            <div class="col p-2 rounded shadow-sm mb-2">
                                                <div class="d-flex justify-content-between align-items-center gap-4 ">
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="p-2 rounded"
                                                            style="border: 1px solid var(--primary); display: inline-block; width: 70px; height: 70px;">
                                                            <img src="images/<?= strtolower($selectedMenu['menu']) ?>.jpg"
                                                                alt="" class="img-fluid"
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                        </div>
                                                        <div>
                                                            <p class=" fs-4 fw-semibold  mt-2">
                                                                <?= $selectedMenu['menu'] ?>
                                                            </p>
                                                            <p class="fs-6 fw-light" style="margin-top: -20px;">
                                                                <span class="price">
                                                                    <?= $selectedMenu['price'] ?>
                                                                </span> / Item
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <input type="number" class="selected-count py-1 px-2" style="width: 80px"
                                                        min="1" value="1">
                                                    <p class="selected-price fw-semibold price mt-2 total-item-price">
                                                        <?= $selectedMenu['price'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class=" p-2 rounded shadow-sm w-100 d-flex justify-content-center align-items-center"
                                    style="background-color: white;">
                                    <p class="fs-4">Total: <span class="total-price fw-semibold price">0</span></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn " data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-save">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <img src="images/logo.png" alt="Logo" width="43" height="24" class="d-inline-block align-text-top">
            </a>
            <span class="mb-3 mb-md-0 text-muted">&copy;
                <?= date('Y') ?> Food by <a href="https://michaelarselius.com/" target="_blank"
                    style="text-decoration:none; color:#333; fw-semibold;">AccengggDev</a>
            </span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-muted" target="_blank" href="https://instagram.com/accenggg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-instagram" viewBox="0 0 16 16">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                    </svg>
                </a>
            </li>
            <li class="ms-3">
                <a class="text-muted" target="_blank"
                    href="https://www.linkedin.com/in/michael-arselius-pamasi-240aa1278/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path
                            d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                    </svg>
                </a>
            </li>
        </ul>
    </footer>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/formatRupiah.js"></script>
    <script src="js/handleMenu.js"></script>
    <script src="js/sendOrder.js"></script>
    <script src="js/countingPrice.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buyNowButton = document.querySelector(".btn-save");

            buyNowButton.addEventListener("click", function () {
                alert("Order Success, please wait!");
                localStorage.removeItem("selectedMenuList");
                window.location.href = "src/finishOrder.php";
            });
        });

    </script>


</body>

</html>