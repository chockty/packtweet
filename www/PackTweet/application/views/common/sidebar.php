<nav class="navbar navbar-fixed-left">
	<div class="container">
		<div class="navbar-header navbar-left-header"></div>
		<div class="navbar-collapse collapse">
			<ul class="nav-left-list">
				<li>
					<a href="#"><i class="fab fa-twitter fa-2x"></i></a>
				</li>
				<li>
					<a href="#"><i class="fas fa-home"></i>&nbsp;&nbsp;ホーム</a>
				</li>
				<li>
					<a href="#"><i class="fas fa-hashtag"></i>&nbsp;&nbsp;話題を検索</a>
				</li>
				<li>
					<a href="#"><i class="far fa-bell"></i>&nbsp;&nbsp;通知</a>
				</li>
				<li>
					<a href="#"><i class="far fa-envelope"></i>&nbsp;&nbsp;メッセージ</a>
				</li>
				<li>
					<a href="<?= site_url('tweets/mypage'); ?>"><i class="far fa-user"></i>&nbsp;&nbsp;プロフィール</a>
				</li>
				<li>
					<button class="btn btn-gradient">ツイートする</button>
				</li>
				<li>
					<?= form_open('logout', ['method' => 'GET']) ?>
						<?= form_button(['name' => 'logout', 'class' => 'btn btn-gradient logout-btn', 'content' => 'ログアウトする']) ?>
					<?= form_close() ?>
				</li>
			</ul>
		</div>
	</div>
</nav>
