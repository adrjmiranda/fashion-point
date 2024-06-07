<?php
/**
 * @var App\Utils\View $this
 */

$this->extend('dashboard', [
  'title' => 'Products',
  'styles' => [
    'global',
    'admin-dashboard'
  ],
  'scripts' => [
    'session-menu-visibility'
  ]
]);
?>

<div id="content-area">
  <div class="content">
    <!-- Organization -->

    <div class="organization">
      <div class="header">
        <h1>Products</h1>
        <button type="button" id="choose-session">
          <img src="<?= $baseUrl ?>/img/menu.svg" alt="menu" />
        </button>
      </div>

      <div class="header-bottom">
        <a href="<?= $baseUrl ?>/admin/create-product" class="btn special">Add product</a>

        <div class="options">
          <form action="#" id="filter">
            <div class="field">
              <label for="order-by">Order by:</label>
              <select name="order_by" id="order-by">
                <option value="title">Title</option>
                <option value="last" selected>Last</option>
                <option value="older">Older</option>
              </select>
            </div>
          </form>

          <form action="#" id="search">
            <div class="field">
              <label for="query"> Search: </label>
              <input type="search" name="query" id="query" placeholder="Looking for what?" />
            </div>
            <button type="submit">
              <img src="<?= $baseUrl ?>/img/search.svg" alt="search" />
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- List -->

    <div class="list">
      <table>
        <thead>
          <tr>
            <th class="hide-id">Id</th>
            <th>Name</th>
            <th>Sold amount</th>
            <th class="hide-price">Price</th>
            <th class="hide-date">Stock</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($products as $product): ?>
            <tr>
              <td class="hide-id"><?= $product->id ?></td>
              <td><?= $product->name ?></td>
              <td><span>3</span> un</td>
              <td class="hide-price">$ <span><?= $product->price ?></span></td>
              <td class="hide-date"><span><?= $product->stock ?></span> un</td>
              <td>
                <a href="#">
                  <img src="<?= $baseUrl ?>/img/document.svg" alt="edit" />
                </a>
                <a href="#">
                  <img src="<?= $baseUrl ?>/img/trash.svg" alt="remove" />
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>