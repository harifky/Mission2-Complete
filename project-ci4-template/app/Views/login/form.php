<?php ob_start(); ?>
<h2>Form Login</h2>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= base_url('login/auth') ?>">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>
<?php
$content = ob_get_clean();
echo view('layout', ['title' => 'Login', 'content' => $content]);