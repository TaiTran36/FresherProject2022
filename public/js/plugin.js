$(document).ready(function () {
  $(document).on("click", '#arrow', function () {
    $('ul.inner-list').slideToggle();
  });
  $(document).on("click", '#close_sidebar', function () {
    $('#sidebar').css('right', '-300px');
  });
  $(document).on("click", '#menu', function () {
    $('#sidebar').css('right', '0px');

  });

});