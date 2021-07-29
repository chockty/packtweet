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
      <? foreach ($tweets as $tweet): ?>
      <a class="mypage-tweet" href="<?= site_url('tweets/' . $tweet['tweet_id']); ?>">
        <div class="form-group show-form-group">
          <?php if ($tweet['retweet_user_name'] && $tweet['retweet_user_name'] != '1'): ?>
              <div class=""><i class="fas fa-retweet">リツイート済み</i></div>
          <?php endif; ?>
          <p class="user-name">&nbsp;<i class="user-name-font"><?= $tweet['name'] ?></i>&nbsp;&nbsp;&nbsp;<?= date('Y年n月d日 ', strtotime($tweet['created_at'])) ?></p>
          <div class="tweet-content mypage-tweet-content"><?= $tweet['content'] ?></div>
        </div>
      </a>
      <? endforeach; ?>
    </div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
</body>
</html>