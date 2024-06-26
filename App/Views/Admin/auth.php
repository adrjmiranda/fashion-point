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

  <?php foreach ($styles as $file): ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/<?= $file ?>.css" />
  <?php endforeach; ?>

  <!-- Scripts -->

  <?php foreach ($scripts as $file): ?>
    <script src="<?= $baseUrl ?>/js/<?= $file ?>.js" defer></script>
  <?php endforeach; ?>

  <!-- Fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Pacifico&display=swap"
    rel="stylesheet" />
</head>

<body>
  <div id="main">
    <!-- Register Form -->
    <div class="container">
      <div id="auth-container">
        <?= $this->load() ?>
      </div>
    </div>
  </div>
</body>

</html>