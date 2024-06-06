<?php
/**
 * @var App\Utils\View $this
 */

$this->extend('dashboard', [
  'title' => 'Orders',
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
        <h1>Orders</h1>
        <button type="button" id="choose-session">
          <img src="<?= $baseUrl ?>/img/menu.svg" alt="menu" />
        </button>
      </div>

      <div class="options">
        <form action="#" id="filter">
          <div class="field">
            <label for="order-by">Order by:</label>
            <select name="order_by" id="order-by">
              <option value="title">Title</option>
              <option value="last" selected>Last</option>
              <option value="older">Older</option>
              <option value="active">Active</option>
              <option value="sent">Sent</option>
              <option value="canceled">Canceled</option>
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

    <!-- List -->

    <div class="list">
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Code</th>
            <th class="hide-quantity">Quantity</th>
            <th class="hide-total-price">Total price</th>
            <th class="hide-purchase-date">Purchase date</th>
            <th class="hide-actions">Actions</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>E4k67l0f82lcbPICxHqe</td>
            <td class="hide-quantity">5</td>
            <td class="hide-total-price">$ <span>323.99</span></td>
            <td class="hide-purchase-date">12/03/2024 10:30:32</td>
            <td class="hide-actions">
              <a href="#">
                <img src="<?= $baseUrl ?>/img/document.svg" alt="edit" />
              </a>
              <a href="#">
                <img src="<?= $baseUrl ?>/img/trash.svg" alt="remove" />
              </a>
            </td>
            <td>
              <form action="#" class="status">
                <select name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                  <option value="sent">Sent</option>
                  <option value="canceled">Canceled</option>
                  <option value="canceled">Finish</option>
                </select>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>