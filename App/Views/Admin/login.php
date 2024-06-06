<?php
/**
 * @var App\Utils\View $this
 */

$this->extend('dashboard', [
  'title' => 'Login',
  'styles' => [
    'global',
    'admin-dashboard'
  ],
  'scripts' => [
    'pass-visibility-login'
  ]
]);
?>

<div id="auth">
  <a href="#" class="logo">
    <img src="<?= $baseUrl ?>/img/logo.png" alt="Logo" /><span>Fashion point</span>
  </a>

  <h1>Welcome back!</h1>

  <form action="/admin/login" method="post">
    <div class="input-field">
      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" value="<?= $fields['email'] ?? '' ?>" placeholder="Your e-mail" />

      <p class="form-field-error"><?= $errors['email'] ?? '' ?></p>
    </div>

    <div class="input-field">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="<?= $fields['password'] ?? '' ?>"
        placeholder="Your password" />

      <p class="form-field-error"><?= $errors['password'] ?? '' ?></p>

      <button type="button" id="toggle-pass" class="visibility-pass">
        <img src="<?= $baseUrl ?>/img/eye-off.svg" alt="hide pass" class="hide-pass hide" />
        <img src="<?= $baseUrl ?>/img/eye.svg" alt="show pass" class="show-pass" />
      </button>
    </div>

    <button type="submit" class="btn">Enter</button>
  </form>
</div>