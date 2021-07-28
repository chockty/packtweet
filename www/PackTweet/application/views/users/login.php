    <div class="login">
      <div class="login-header">
        <i class="fab fa-twitter"></i>
        <h1 class="login-title">PackTweetにログイン</h1>
      </div>

      <?= form_open('login', ['class' => 'login-container']); ?>
        <span class="login-error"><?= $this->session->flashdata('msg'); ?></span>
        <?= form_error('email', '<span class="login-error">', '</span>'); ?>
        <?= form_error('password', '<span class="login-error">', '</span>'); ?>
        <p><?= form_input('email', set_value('email'), ['placeholder' => 'メールアドレス']); ?></p>
        <p><?= form_password('password', set_value('password'), ['placeholder' => 'パスワード']); ?></p>
        <p><?= form_submit('submit', 'ログイン'); ?></p>
      <?= form_close(); ?>

      <div class="form-footer">
        <div class="form-footer-container">
          <a href="#" class="form-footer-link">パスワードをお忘れですか？</a>
          <span>•</span>
          <a href="#" class="form-footer-link">アカウント作成</a>
        </div>
      </div>
    </div>
  </body>
</html>