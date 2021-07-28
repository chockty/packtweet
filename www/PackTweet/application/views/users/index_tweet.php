<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    <div class="tweet-boxes">
      <? foreach ($tweets as $tweet) : ?>
        <a href="<?= site_url('tweets/'. $tweet['tweet_id'] ) ?>">
          <div class="tweet-box">
            <div class="user-info"><?= $tweet['name'] ?></div>
            <div class="tweet-index-content"><?= $tweet['content'] ?></div>
            <div class="tweet-index-created-at"><?= $tweet['created_at'] ?></div>
          </div>
        </a>
      <? endforeach; ?>
    </div>
      <div class="search-box">
        <?= form_open('/tweets', ['method' => 'GET']) ?>
          <?= form_button(['name' => 'submit', 'type' => 'submit', 'content' => '<i class="fas fa-search fa-2x"></i>']) ?>
          <?= form_input(['name' => 'search_word', 'class' => 'input-box']) ?>
        <?= form_close() ?>
      </div>
    </div>
</div>
</body>
</html>
