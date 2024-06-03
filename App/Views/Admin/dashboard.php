<?php
/**
 * @var App\Utils\View $this
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="<?= $baseUrl ?>/favicon.ico" type="image/x-icon" />
  <title><?= $title ?></title>

  <!-- Styles -->

  <link rel="stylesheet" href="<?= $baseUrl ?>/css/master.css" />

  <!-- Scripts -->

  <script src="<?= $baseUrl ?>/js/cart-visibility.js" defer></script>
  <script src="<?= $baseUrl ?>/js/mobile-menu-visibility.js" defer></script>
  <script src="<?= $baseUrl ?>/js/session-menu-visibility.js" defer></script>

  <!-- Fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Pacifico&display=swap"
    rel="stylesheet" />
</head>

<body>
  <div id="dashboard" class="session">
    <!-- Tabs -->

    <div id="tabs">
      <a href="#" class="logo">
        <span>Fashion point</span>
      </a>

      <button type="button" id="choose-session-close">X</button>

      <ul>
        <li>
          <a href="/admin/dashboard/orders" class="active">Orders</a>
        </li>

        <li>
          <a href="/admin/dashboard/products">Products</a>
        </li>

        <li>
          <a href="/admin/dashboard/finalized-orders">Finalized orders</a>
        </li>

        <li>
          <a href="/admin/dashboard/users">Users</a>
        </li>

        <li>
          <a href="/admin/dashboard/administrators">Administrators</a>
        </li>
      </ul>

      <div class="out">
        <a href="/admin/logout" class="btn">Logout</a>
      </div>
    </div>

    <!-- Content Area -->

    <?= $this->load() ?>
  </div>
</body>

</html>