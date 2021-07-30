    <div class="container mypage-container">
      <div class="title mypage-title">
        <div class="btn-index-mypage">
          <a class="btn-index" href="<?= site_url('tweets'); ?>">←</a>
        </div>
        <div class="name-tweets-container">
          <span><i class="user-name-font"><?= $_SESSION['name'] ?></i></span>
          <div class="total-tweets"><?= count($tweets) ?>件のツイート</div>
        </div>
      </div>
      <ul class="tab-nav">
        <li class="select-tab">ツイート</li>
        <li>いいね</li>
      </ul>
      <div class="tab-content">
      <? foreach ($tweets as $tweet): ?>
        <a class="mypage-tweet" href="<?= site_url('tweets/' . $tweet['tweet_id']); ?>">
          <div class="form-group show-form-group">
            <?php if ($tweet['retweet_or_not'] && $tweet['retweet_or_not'] != '1'): ?>
                <div class=""><i class="fas fa-retweet">リツイート済み</i></div>
            <?php endif; ?>
            <p class="user-name">&nbsp;<i class="user-name-font"><?= $tweet['name'] ?></i>&nbsp;&nbsp;&nbsp;<?= date('Y年n月d日 ', strtotime($tweet['created_at'])) ?></p>
            <div class="tweet-content mypage-tweet-content"><?= $tweet['content'] ?></div>
          </div>
        </a>
      <? endforeach; ?>
      </div>
      <!-- 以下はダミー(いいねしたツイート表示) -->
      <div class="tab-content is-hidden">
        <a class="mypage-tweet" href="">
          <div class="form-group show-form-group">
            <p class="user-name">&nbsp;<i class="user-name-font">hoge</li>&nbsp;&nbsp;&nbsp;2021年7月30日</p>
            <div class="tweet-content mypage-tweet-content">いいねしたツイートを表示</div>
          </div>
        </a>
      </div>
      <!--  -->
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
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="application/public/js/mypage_tab.js"></script>
  <script src="application/public/js/modal.js"></script>
  <script src="application/public/js/tweet_btn.js"></script>
</body>
</html>