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
    
index =
  init: ->
    do @detect_elements
    do @bind_events   
    
  detect_elements: ->
    @stars = $(".stars")
  
  bind_events: ->
    do @create_rate
    
  create_rate: ->
    @stars.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      readOnly: true
      score: 2.5
    
    
$(document).ready ->
  do index.init