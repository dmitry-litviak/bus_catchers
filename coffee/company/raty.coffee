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
    
raty =
  init: ->
    do @detect_elements
    do @bind_events   
    
  detect_elements: ->
    @timeliness     = $("#timeliness")
    @comfort        = $("#comfort")
    @wifi           = $("#wifi")
    @empty_seating  = $("#empty-seating")
    @cleanliness    = $("#cleanliness")
    @form           = $("#comment-form")
    @options =
      success    : @showResponse
  
  bind_events: ->
    do @create_rate

  showResponse: (responseText, statusText, xhr, $form) ->
    if responseText.text == "success"
      console.log responseText
    else
      console.log responseText

  init_form_submit: ->
    @form.submit (e) =>
      el = $(e.currentTarget)
      el.ajaxSubmit @options
      false

  create_rate: ->
    @timeliness.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 5
      target    : '#timeliness-input'
      targetType: 'number'
      targetKeep: true
    @comfort.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 5
      target    : '#comfort-input'
      targetType: 'number'
    @wifi.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 5
      target    : '#wifi-input'
      targetType: 'number'
    @empty_seating.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 5
      target    : '#empty-seating-input'
      targetType: 'number'
    @cleanliness.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 5
      target    : '#cleanliness-input'
      targetType: 'number'
    
    
$(document).ready ->
  do raty.init