<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    <div class="tweet-boxes">
      <? if (count($tweets) === 0): ?>
        <div class="no-result-alert">
          <?= $search_word ?>の検索結果はありませんでした。
        </div>
      <? else: ?>
        <? foreach ($tweets as $tweet) : ?>
          <a href="<?= site_url('tweets/'. $tweet['tweet_id'] ) ?>">
            <div class="tweet-box">
              <div class="user-info"><?= $tweet['name'] ?></div>
              <div class="tweet-index-content"><?= $tweet['content'] ?></div>
              <div class="tweet-index-created-at"><?= $tweet['created_at'] ?></div>
            </div>
          </a>
        <? endforeach; ?>
      <? endif ?>
    </div>
      <div class="search-box">
        <?= form_open('tweets', ['method' => 'GET']) ?>
          <?= form_button(['name' => 'submit', 'type' => 'submit', 'content' => '<i class="fas fa-search fa-2x"></i>']) ?>
          <?= form_input(['name' => 'search_word', 'class' => 'input-box', 'value' => $search_word]) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <div class="modal js-modal">
    <div class="modal-bg js-modal-close"></div>
    <div class="modal-content">
      <div>
        <a class="js-modal-close">✖️</a>
      </div>
      <?= form_open('tweets/create', ['class' => 'modal-form']); ?>
        <?= form_textarea(['name' => 'content',  'class' => 'form-control modal-text', 'placeholder' => 'いまどうしてる？', 'cols' => '50', 'rows' => '10', 'maxlength' => 140]); ?>
        <span class="help-block modal-validate"></span>
        <?= form_button(['type' => 'submit', 'class' => 'btn btn-success pull-right modal-submit', 'content' => "ツイートする"]) ?>
      <?= form_close(); ?>
    </div>
  </div>
  </div>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="application/public/js/modal.js"></script>
</body>
</html>
