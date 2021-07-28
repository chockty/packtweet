<div class="login">
  <div class="login-header">
    <i class="fab fa-twitter"></i>
    <h1 class="login-title">新規アカウント作成</h1>
  </div>

  <?= form_open('register', ['method' => 'POST']); ?>
    <p><?= form_input('name', set_value('name'), ['placeholder' => '名前']); ?></p>
    <?= form_error('name', '<span class="login-error">', '</span>'); ?>
    <p><?= form_input('email', set_value('email'), ['placeholder' => 'メールアドレス']); ?></p>
    <?= form_error('email', '<span class="login-error">', '</span>'); ?>
    <p><?= form_password('password', set_value('password'), ['placeholder' => 'パスワード']); ?></p>
    <?= form_error('password', '<span class="login-error">', '</span>'); ?>
    <p><?= form_password('password_confirmation', set_value('password'), ['placeholder' => 'パスワード確認']); ?></p>
    <?= form_error('password_confirmation', '<span class="login-error">', '</span>'); ?>
    <p><?= form_submit('submit', '新規登録'); ?></p>
  <?= form_close(); ?>

  <div class="form-footer">
    <div class="form-footer-container">
      <a href="#" class="form-footer-link">既にアカウントをお持ちの方•ログイン</a>
    </div>
  </div>
</div>
</body>
</html>