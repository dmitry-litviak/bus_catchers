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
    @avg_rate       = $(".avg_rate")
    @rating         = $(".rating")
    @options =
      success    : @showResponse
  
  bind_events: ->
    do @init_avg_rate
    do @create_rate
    do @init_form_submit
    do @get_comments
    do @init_votes
    
  init_votes: ->   
    $(".btn-vote").live "click", ->
      element = $(@)
      value = element.parent().find('h1.votes').html()
      sign = '+'
      if element.hasClass('minus')
        sign = '-'
      $.ajax
        url: SYS.baseUrl + 'company/vote'
        data: $.param({comment_id : element.parent().next().data('comment'), user_id : $('#user_id').val(), sign : sign})
        type: 'POST'
        dataType: 'json'
        success: (res) =>
          if res.text = "success"
            if element.hasClass('plus')
              element.next().html value + 1
            else
              element.prev().html value - 1
          else
            console.log res.data
          element.parent().find('.btn-vote').attr( "disabled", "disabled" );
        
  init_avg_rate: ->
    me = @
    company_id = @avg_rate.data "company"
    $.ajax
      url: SYS.baseUrl + 'compare/get_avg_rating'
      data: $.param({id : company_id})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text = "success"
          me.avg_rate.raty
            half: true
            size: 24
            starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
            starOff: SYS.baseUrl + "img/stars/star-off-big.png"
            starOn: SYS.baseUrl + "img/stars/star-on-big.png"
            readOnly: true
            noRatedMsg: "Be the first to leave a review"
            hints: ['bad', 'poor', 'average', 'good', 'excellent']
            score: res.data.rating
#          me.avg_rate.parent().css {'margin' : '0 auto'}
          if res.data.count
              me.avg_rate.next().html("(" + res.data.count + " customer reviews)")
  
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
            me.rate_comment comment
          unless $('#user_id').val()
            $('.btn-vote').attr( "disabled", "disabled" );
    
  showResponse: (responseText, statusText, xhr, $form) ->
    obj = jQuery.parseJSON responseText
    if obj.text is "success"
      raty.comments.prepend raty.template({comment : obj.data})
      raty.rate_comment obj.data
    else
      console.log responseText

  rate_comment: (comment)->
    $("#rating" + comment.id).raty
      half: true
      size: 16
      readOnly: true
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: comment.rating
      noRatedMsg: "Be the first to leave a review"
      hints: ['bad', 'poor', 'average', 'good', 'excellent']
    $("#timeliness" + comment.id).raty
      half: true
      size: 16
      readOnly: true
      starHalf: SYS.baseUrl + "img/stars/star-half.png"
      starOff: SYS.baseUrl + "img/stars/star-off.png"
      starOn: SYS.baseUrl + "img/stars/star-on.png"
      score: comment.timeliness
      noRatedMsg: "Be the first to leave a review"
      hints: ['bad', 'poor', 'average', 'good', 'excellent']
    $("#comfort" + comment.id).raty
      half: true
      size: 16
      readOnly: true
      starHalf: SYS.baseUrl + "img/stars/star-half.png"
      starOff: SYS.baseUrl + "img/stars/star-off.png"
      starOn: SYS.baseUrl + "img/stars/star-on.png"
      score: comment.comfort
      noRatedMsg: "Be the first to leave a review"
      hints: ['bad', 'poor', 'average', 'good', 'excellent']
    $("#wifi" + comment.id).raty
      half: true
      size: 16
      readOnly: true
      starHalf: SYS.baseUrl + "img/stars/star-half.png"
      starOff: SYS.baseUrl + "img/stars/star-off.png"
      starOn: SYS.baseUrl + "img/stars/star-on.png"
      score: comment.wifi
      noRatedMsg: "Be the first to leave a review"
      hints: ['bad', 'poor', 'average', 'good', 'excellent']
    $("#empty-seating" + comment.id).raty
      half: true
      size: 16
      readOnly: true
      starHalf: SYS.baseUrl + "img/stars/star-half.png"
      starOff: SYS.baseUrl + "img/stars/star-off.png"
      starOn: SYS.baseUrl + "img/stars/star-on.png"
      score: comment.empty_seating
      noRatedMsg: "Be the first to leave a review"
      hints: ['bad', 'poor', 'average', 'good', 'excellent']
    $("#cleanliness" + comment.id).raty
      half: true
      size: 16
      readOnly: true
      starHalf: SYS.baseUrl + "img/stars/star-half.png"
      starOff: SYS.baseUrl + "img/stars/star-off.png"
      starOn: SYS.baseUrl + "img/stars/star-on.png"
      score: comment.cleanliness
      noRatedMsg: "Be the first to leave a review"
      hints: ['bad', 'poor', 'average', 'good', 'excellent']
  
  init_form_submit: ->
    @form.submit (e) =>
      el = $(e.currentTarget)
      if @form.valid()
        el.ajaxSubmit @options
      false
      
    @form.validate
      rules:
        "name":
          minlength: 2
          required: true

        "message":
          minlength: 40
          required: true
          
        "title":
          minlength: 3
          required: true

  create_rate: ->
    @rating.raty
      half: true
      size: 24
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
      starOff: SYS.baseUrl + "img/stars/star-off-big.png"
      starOn: SYS.baseUrl + "img/stars/star-on-big.png"
      score: 0
      target    : '#rating'
      targetType: 'number'
      targetKeep: true
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