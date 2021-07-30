$(function() {
  $('.create-tweet').on('click', function () {
      $('.modal').fadeIn(300);
      $('body').addClass('body-fixed');
    });
  $('.js-modal-close').on('click', function() {
    $('.modal').fadeOut(300);
    $('body').removeClass('body-fixed');
    $('.modal-validate').text('');
    $('.modal-text').val('');
    });
  $('.modal-form').submit(function() {
    let input = $('.modal-text').val().length;
    if (input === 0) {
      $('.modal-validate').text('ツイートは必須です');
      return false;
    } else if (input > 140) {
      $('.modal-validate').text('140字以内で入力してください。');
      return false;
    } else {
      return true;
    }
    });
});

