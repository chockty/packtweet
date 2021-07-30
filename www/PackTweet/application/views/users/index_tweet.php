<div class="main-wrap">
  <div class="container index-container">
      <div>
        <? if (count($tweets) === 0): ?>
          <div class="no-result-alert">
            <?= $search_word ?>の検索結果はありませんでした。
          </div>
        <? else: ?>
          <div class="title index-title">
            <div class="name-tweets-container">
              <span>ホーム</span>
            </div>
          </div>
          <?= form_open('tweets/create', ['method'=>'POST']); ?>
            <div class="form-group index-form-group">
              <?= form_textarea(['name' => 'content',  'class' => 'form-control index-form-control tweet-textarea', 'placeholder' => 'いまどうしてる？', 'cols' => '20', 'rows' => '5', 'maxlength' => 140]); ?>
              <span class="help-block index-help-block"><?= form_error('content'); ?></span>
              <button type="submit" class="btn btn-success pull-right tweet-btn" disabled>ツイートする</button>
            </div>
          <?= form_close(); ?>
          <? foreach ($tweets as $tweet): ?>
          <a class="index-tweet" href="<?= site_url('tweets/' . $tweet['tweet_id']); ?>">
            <div class="form-group index-group">
              <?php if ($tweet['retweet_or_not'] && $tweet['retweet_or_not'] != '1'): ?>
                <div class=""><i class="fas fa-retweet">リツイート済み</i></div>
              <?php endif; ?>
              <p class="user-name">&nbsp;<i class="user-name-font"><?= $tweet['name'] ?></i>&nbsp;&nbsp;&nbsp;<?= date('Y年n月d日 ', strtotime($tweet['created_at'])) ?></p>
              <div class="tweet-content mypage-tweet-content"><?= $tweet['content'] ?></div>
            </div>
          </a>
          <? endforeach; ?>
        <? endif ?>
      </div>
      <div class="search-box">
        <?= form_open('tweets', ['method' => 'GET']) ?>
          <button type="submit" name="submit" id="search-btn" disabled><i class="fas fa-search fa-2x"></i></button>
          <?= form_input(['name' => 'search_word', 'class' => 'input-box', 'id' => 'search-input-box', 'value' => $search_word]) ?>
        <?= form_close() ?>
      </div>
  </div>
  <div class="modal js-modal">
    <div class="modal-bg js-modal-close"></div>
    <div class="modal-content">
      <div>
        <a class="js-modal-close">✖️</a>
      </div>
      <?= form_open('tweets/create', ['class' => 'modal-form']); ?>
        <?= form_textarea(['name' => 'content',  'class' => 'form-control modal-text tweet-textarea', 'placeholder' => 'いまどうしてる？', 'cols' => '50', 'rows' => '10', 'maxlength' => 140]); ?>
        <span class="help-block modal-validate"></span>
        <button type="submit", class="btn btn-success pull-right modal-submit tweet-btn" disabled>ツイートする</button>
      <?= form_close(); ?>
    </div>
  </div>
  </div>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="application/public/js/modal.js"></script>
  <script src="application/public/js/search_btn.js"></script>
  <script src="application/public/js/tweet_btn.js"></script>
</body>
</html>
