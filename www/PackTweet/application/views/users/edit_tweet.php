    <div class>
      <div class="container">
        <div class="title">ツイート編集</div>
        <?= form_open('tweets/' . $tweet['tweet_id'] . '/edit'); ?>
          <div class="form-group">
            <?= form_textarea(['name' => 'content',  'class' => 'form-control', 'value' => $tweet['content'], 'cols' => '50', 'rows' => '10', 'maxlength' => 140]); ?>
            <span class="help-block"><?= form_error('content'); ?></span>
          </div>
          <?= form_button(['type' => 'submit', 'class' => 'btn btn-success pull-right', 'content' => "更新する"]) ?>
        <?= form_close(); ?>
      </div>
    </div>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
  </body>
</html>