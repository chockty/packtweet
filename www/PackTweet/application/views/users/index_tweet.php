<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    <div class="tweet-boxes">
        <? foreach ($tweets as $tweet) : ?>
				<a class="tweet-link" href="<?= site_url('tweets/'. $tweet['id'] . '/show') ?>">
          <div class="tweet-box">
            <div class="user-info"><a href="#"><?= $tweet['user_id'] ?></a></div>
            <div class="tweet-index-content"><?= $tweet['content'] ?></div>
            <div class="tweet-index-created-at"><?= $tweet['created_at'] ?></div>
          </div>
				</a>
        <? endforeach; ?>
    </div>
  </div>
</div>
</body>
</html>
