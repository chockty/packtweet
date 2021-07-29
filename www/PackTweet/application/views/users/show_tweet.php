  <div class>
    <div class="container show-container">
      <div class="title show-title">
        <!-- todo:aタグのリンクは一覧表示のURLにする -->
        <a class="btn-index" href="<?= site_url('tweets'); ?>">←</a>ツイート
      </div>
      <?= form_open('tweets/delete/' . $tweet['tweet_id']); ?>
        <div class="form-group show-form-group">
          <p class="user-name">&nbsp;<?= $tweet['name'] ?>&nbsp;&nbsp;さんのツイート&nbsp;</p>
          <div class="tweet-content"><?= $tweet['content'] ?></div>
          <p class="tweet-date"><?= str_replace(['am', 'pm'], ['午前', '午後'], date('a g:i · Y年n月d日 ', strtotime($tweet['created_at']))) ?></p>
        </div>
        <div class="show-icon">
          <?= form_button(['type' => 'submit', 'class' => 'btn btn-delete pull-right', 'content' => "<i class='fas fa-trash-alt fa-2x'></i>"]) ?>
          <a class="btn btn-favo pull-right"><i class="far fa-heart fa-2x"></i></a>
        </div>
      <?= form_close(); ?>
    </div>
    <div class="container show-container">
      <div class="comment-form">
        <?= form_open('tweets/' . $tweet['tweet_id']); ?>
          <?= form_input('content', set_value('content'), ['placeholder' => 'Tweet your reply', 'maxlength' => 140]); ?>
          <?= form_submit('submit', 'Reply'); ?>
        <?= form_close(); ?>
      </div>
      <?= form_error('content', '<span class="login-error">', '</span>'); ?>
    </div>
    <div class="container show-container">
      <? foreach ($comments as $comment) : ?>
        <div class="tweet-box">
          <div class="user-info"><?= $comment['user_name'] ?></div>
          <div class="tweet-index-content"><?= $comment['content'] ?></div>
          <div class="tweet-index-created-at"><?= $comment['created_at'] ?></div>
        </div>
      <? endforeach; ?>
    </div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
</body>
</html>