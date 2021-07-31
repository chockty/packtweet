$(function () {
  let favoriteBtn = $('#js-favorite-toggle');
  let csrfName = favoriteBtn.prevAll('input[name="csrf_test_name"]');
  let tweetId = favoriteBtn.prevAll('input[name="tweet_id"]').val();

  favoriteBtn.on('click', function (e) {
    e.preventDefault();
    let postdata = {
      tweet_id: tweetId,
    }
    postdata[csrfName.attr('name')] = csrfName.val();
    $.ajax({
            url: 'tweets/favorite',
            type: 'POST',
            data: postdata,
    }).done(function (data) {
      let favoriteIcon = favoriteBtn.find('i');
      $('input[name="csrf_test_name"]').val(data['csrf_hash']);
      if(data['favorite']) {
        favoriteIcon.removeClass('far');
        favoriteIcon.addClass('fas');
      } else {
        favoriteIcon.removeClass('fas');
        favoriteIcon.addClass('far');
      }
    })
  });
});
