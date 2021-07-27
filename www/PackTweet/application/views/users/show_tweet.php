  <div class>
    <div class="container show-container">
      <div class="title show-title">
        <!-- todo:aタグのリンクは一覧表示のURLにする -->
        <a class="btn-index" href="<?= site_url('tweets'); ?>">←</a>ツイート
      </div>
      <?= form_open('tweets/delete/' . $tweet['tweet_id'], ['method'=>'POST']); ?>
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
  </div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
</body>
</html>