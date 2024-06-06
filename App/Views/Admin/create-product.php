<?php
/**
 * @var App\Utils\View $this
 */

$this->extend('dashboard', [
  'title' => 'Create Product',
  'styles' => [
    'global',
    'admin-dashboard'
  ],
  'scripts' => [
    'session-menu-visibility',
    'change-preview-image',
    'img-preview'
  ]
]);
?>

<div id="content-area">
  <div class="content">
    <!-- Organization -->

    <div class="organization">
      <div class="header">
        <h1>Add new product</h1>
        <button type="button" id="choose-session">
          <img src="<?= $baseUrl ?>/img/menu.svg" alt="menu" />
        </button>
      </div>

      <div class="header-bottom">
        <a href="<?= $baseUrl ?>/admin/dashboard/products" class="btn special">Cancel</a>
      </div>
    </div>

    <!-- New Product -->

    <div class="new-product">
      <form action="<?= $baseUrl ?>/admin/create-product" method="post" enctype="multipart/form-data">
        <div class="field">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" placeholder="Product name" />
        </div>

        <div class="field">
          <label for="description">Description:</label>
          <textarea name="description" id="description" placeholder="Describe this product"></textarea>
        </div>

        <div class="field">
          <label for="images">Images (max: 4):</label>
          <input type="file" name="images[]" id="images" multiple />
        </div>

        <div class="field">
          <label for="stock">Stock</label>
          <input type="number" name="stock" id="stock" min="1" value="1" />
        </div>

        <div class="field">
          <label>Sizes (min: 1):</label>
          <div class="check">
            <label>PP<input type="checkbox" name="sizes[]" checked value="PP" /></label>
            <label>P<input type="checkbox" name="sizes[]" checked value="P" /></label>
            <label>M<input type="checkbox" name="sizes[]" checked value="M" /></label>
            <label>G<input type="checkbox" name="sizes[]" checked value="G" /></label>
            <label>GG<input type="checkbox" name="sizes[]" checked value="GG" /></label>
          </div>
        </div>

        <div class="field">
          <label>Add colors (max: 7):</label>
          <div class="add-color">
            <input type="color" id="color-input" />
            <button type="button" id="color-add">
              <img src="<?= $baseUrl ?>/img/add-circle.svg" alt="add" />
            </button>
          </div>

          <ul class="check" id="colors"></ul>
        </div>

        <button type="submit" class="btn special">Create</button>
      </form>

      <div id="img-preview">
        <div id="thumbnails">
          <div class="item"></div>
          <div class="item"></div>
          <div class="item"></div>
          <div class="item"></div>
        </div>
        <div id="main-img"></div>
      </div>
    </div>
  </div>
</div>