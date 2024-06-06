<?php
/**
 * @var App\Utils\View $this
 */

$this->extend('dashboard', [
  'title' => 'Administrators',
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
        <h1>Administrators</h1>
        <button type="button" id="choose-session">
          <img src="<?= $baseUrl ?>/img/menu.svg" alt="menu" />
        </button>
      </div>

      <div class="header-bottom">
        <a href="#" class="btn special">Add administrator</a>

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
    </div>

    <!-- List -->

    <div class="list">
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th class="hide-name">Name</th>
            <th>E-mail</th>
            <th class="hide-level">Level</th>
            <th class="hide-last-acess">Last acess</th>
            <th>Actions</th>
            <th class="hide-status">Status</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td class="hide-name">User name</td>
            <td>user@example.com</td>
            <td class="hide-level">Gold</td>
            <td class="hide-last-acess">12/03/2024 10:30:32</td>
            <td>
              <a href="#">
                <img src="<?= $baseUrl ?>/img/document.svg" alt="edit" />
              </a>
              <a href="#">
                <img src="<?= $baseUrl ?>/img/trash.svg" alt="remove" />
              </a>
              <a href="#">
                <img src="<?= $baseUrl ?>/img/ban.svg" alt="ban" />
              </a>
            </td>
            <td class="hide-status">Offline</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>