$(function() {
  $('#search-input-box').on('input', function() {
    var input = $(this).val();
    if(input) {
      $('#search-btn').prop('disabled', false);
    } else {
      $('#search-btn').prop('disabled', true);
    }
  });
});
