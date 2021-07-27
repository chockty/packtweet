<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="<?php echo base_url(); ?>">
    <link href="application/public/css/app.css" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <div class>
      <div class="container">
        <div class="title">ツイート投稿</div>
        <?= form_open('tweet/create', array('method'=>'POST')); ?>
          <div class="form-group">
            <?= form_textarea(array('name' => 'content',  'class' => 'form-control', 'placeholder' => 'いまどうしてる？', 'cols' => '50', 'rows' => '10')); ?>
            <span class="help-block"><?= form_error('content'); ?></span>
          </div>
          <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-success pull-right', 'content' => "ツイートする")) ?>
        </form>
        <?= form_close(); ?>
      </div>
    </div>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
  </body>
</html>