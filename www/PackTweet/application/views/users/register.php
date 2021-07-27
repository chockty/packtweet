<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?= form_open('register') ?>
		<?= form_input('name') ?>
		<?= form_input('email') ?>
		<?= form_input('password', '', ['type' => 'password']) ?>
		<?= form_input('password_confirmation', '', ['type' => 'password']) ?>
		<?= form_submit('submit', 'submit') ?>
	<?= form_close() ?>
</body>
</html>
