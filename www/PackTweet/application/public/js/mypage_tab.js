$(function() {
  $('.tab-nav').find('li').click(function(){
    console.log('hoge');
    let index = $(this).index();
    if ($(this).hasClass('select-tab')) {
      return false;
    } else {
      $('.tab-nav').find('.select-tab').removeClass('select-tab');
      $(this).addClass('select-tab');
      $('.tab-content').addClass('is-hidden').eq(index).removeClass('is-hidden');
    }
  });
});

