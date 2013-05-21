$ ->
  $(window).scroll ->
    unless $(this).scrollTop() is 0
      $("#toTop").fadeIn()
    else
      $("#toTop").fadeOut()

  $("#toTop").click ->
    $("body,html").animate
      scrollTop: 0
    , 800