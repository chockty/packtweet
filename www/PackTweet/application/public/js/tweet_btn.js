$(function() {
  // $('#search-input-box').on('input', function() {
  //   var input = $(this).val();
  //   if(input) {
  //     $('#search-btn').prop('disabled', false);
  //   } else {
  //     $('#search-btn').prop('disabled', true);
  //   }
  // });
  $('.tweet-textarea').on('input', function() {
    var input = $(this).val();
    if(input) {
      $('.tweet-btn').prop('disabled', false);
    } else {
      $('.tweet-btn').prop('disabled', true);
    }
  });
});
