$(function () {
  let favorite = $('#js-favorite-toggle');
  let csrf_name = favorite.prevAll('input[name="csrf_test_name"]');
  let tweet_id = favorite.prevAll('input[name="tweet_id"]').val();

  favorite.on('click', function (e) {
    e.preventDefault();
    // console.log(csrf_name.val());
    // return console.log(csrf_name.attr('name'))
    // favoriteId = $this.data('tweet_id');
    let postdata = {
      tweet_id: tweet_id,
    }
    postdata[csrf_name.attr('name')] = csrf_name.val();
    $.ajax({
            url: 'tweets/favorite',
            type: 'POST',
            data: postdata,
    }).done(function (data) {
      let $this = $(this);
      let csrf_token = $('input[name="csrf_test_name"]');
      csrf_token.val() = data['csrf_hash'];
			// return console.log('OK');
      console.log(csrf_token);
      $this.find('i').toggleClass('far fa-bookmark');
    })
  });
});
