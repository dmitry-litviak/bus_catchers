// Generated by CoffeeScript 1.4.0

$(function() {
  $(window).scroll(function() {
    if ($(this).scrollTop() !== 0) {
      return $("#toTop").fadeIn();
    } else {
      return $("#toTop").fadeOut();
    }
  });
  return $("#toTop").click(function() {
    return $("body,html").animate({
      scrollTop: 0
    }, 800);
  });
});
