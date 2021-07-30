$(function () {
  let favorite = $('#js-favorite-toggle');
  let favoriteId;
  let csrf_hash = $("#token").val();
  let csrf_name = $("#token").attr('name');

  favorite.on('click', function (e) {
    e.preventDefault();
    let $this = $(this);
    favoriteId = $this.data('tweet_id');
    let postdata = {
      id: favoriteId,
    }
    postdata[csrf_name] = csrf_hash;
    $.ajax({
            url: 'tweets/favorite',
            type: 'POST',
            data: postdata,
    }).done(function (data) {
            console.log(data);
            $this.find('i').toggleClass('far fa-bookmark');
    })
  });
});