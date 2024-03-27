<?php
$menus = [
    [
        'name' => 'Salad',
        'price' => 10000,
        'image' => 'salad.jpg',

    ],
    [
        'name' => 'Soup',
        'price' => 12000,
        'image' => 'soup.jpg',

    ],
    [
        'name' => 'Burger',
        'price' => 25000,
        'image' => 'burger.jpg',

    ],
    [
        'name' => 'Pizza',
        'price' => 30000,
        'image' => 'pizza.jpg',

    ],
    [
        'name' => 'Steak',
        'price' => 45000,
        'image' => 'steak.jpg',

    ],
    [
        'name' => 'Pasta',
        'price' => 20000,
        'image' => 'pasta.jpg',

    ],
    [
        'name' => 'Sandwich',
        'price' => 15000,
        'image' => 'sandwich.jpg',

    ],
    [
        'name' => 'Sushi',
        'price' => 35000,
        'image' => 'sushi.jpg',

    ],
];

if (isset ($_GET['search'])) {
    $searchTerm = strtolower($_GET['search']);
    $filteredMenus = array_filter($menus, function ($menu) use ($searchTerm) {
        return strpos(strtolower($menu['name']), $searchTerm) !== false;
    });
    $menus = $filteredMenus;
}
