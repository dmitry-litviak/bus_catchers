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
  template      : JST['company/comment']
  init: ->
    do @detect_elements
    do @bind_events   
    
  detect_elements: ->
    @timeliness     = $("#timeliness")
    @comfort        = $("#comfort")
    @wifi           = $("#wifi")
    @empty_seating  = $("#empty-seating")
    @cleanliness    = $("#cleanliness")
    @form           = $(".comment-form")
    @comments       = $(".comments-block")
    @company        = $("#company")
    @options =
      success    : @showResponse
  
  bind_events: ->
    do @create_rate
    do @init_form_submit
    do @get_comments
  
  get_comments: ->
    me = @
    $.ajax
      url: SYS.baseUrl + 'company/get_comments'
      data: $.param({id : me.company.val()})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text = "success"
          _.each res.data, (comment) ->
            me.comments.append me.template({comment : comment})
            $("#timeliness" + comment.id).raty
              half: true
              size: 16
              readOnly: true
              starHalf: SYS.baseUrl + "img/stars/star-half.png"
              starOff: SYS.baseUrl + "img/stars/star-off.png"
              starOn: SYS.baseUrl + "img/stars/star-on.png"
              score: comment.timeliness
            $("#comfort" + comment.id).raty
              half: true
              size: 16
              readOnly: true
              starHalf: SYS.baseUrl + "img/stars/star-half.png"
              starOff: SYS.baseUrl + "img/stars/star-off.png"
              starOn: SYS.baseUrl + "img/stars/star-on.png"
              score: comment.comfort
            $("#wifi" + comment.id).raty
              half: true
              size: 16
              readOnly: true
              starHalf: SYS.baseUrl + "img/stars/star-half.png"
              starOff: SYS.baseUrl + "img/stars/star-off.png"
              starOn: SYS.baseUrl + "img/stars/star-on.png"
              score: comment.wifi
            $("#empty-seating" + comment.id).raty
              half: true
              size: 16
              readOnly: true
              starHalf: SYS.baseUrl + "img/stars/star-half.png"
              starOff: SYS.baseUrl + "img/stars/star-off.png"
              starOn: SYS.baseUrl + "img/stars/star-on.png"
              score: comment.empty_seating
            $("#cleanliness" + comment.id).raty
              half: true
              size: 16
              readOnly: true
              starHalf: SYS.baseUrl + "img/stars/star-half.png"
              starOff: SYS.baseUrl + "img/stars/star-off.png"
              starOn: SYS.baseUrl + "img/stars/star-on.png"
              score: comment.cleanliness
    
  showResponse: (responseText, statusText, xhr, $form) ->
    obj = jQuery.parseJSON responseText
    if obj.text is "success"
      raty.comments.prepend raty.template({comment : obj.data})
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
      score: 0
      target    : '#timeliness-input'
      targetType: 'number'
      targetKeep: true
    @comfort.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 0
      target    : '#comfort-input'
      targetType: 'number'
      targetKeep: true
    @wifi.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 0
      target    : '#wifi-input'
      targetType: 'number'
      targetKeep: true
    @empty_seating.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 0
      target    : '#empty-seating-input'
      targetType: 'number'
      targetKeep: true
    @cleanliness.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 0
      target    : '#cleanliness-input'
      targetType: 'number'
      targetKeep: true
    
    
$(document).ready ->
  do raty.init