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
    me = @
    _.each @stars, (star) ->
      company_id = $(star).data "company"
      $.ajax
        url: SYS.baseUrl + 'compare/get_avg_rating'
        data: $.param({id : company_id})
        type: 'POST'
        dataType: 'json'
        success: (res) =>
          if res.text == "success"
            $(star).raty
              half: true
              size: 24
              starHalf: SYS.baseUrl + "img/stars/star-half-big.png"
              starOff: SYS.baseUrl + "img/stars/star-off-big.png"
              starOn: SYS.baseUrl + "img/stars/star-on-big.png"
              readOnly: true
              score: res.data.rating
              noRatedMsg: "Be the first to leave a review"
              hints: ['bad', 'poor', 'average', 'good', 'excellent']
            $(star).css {'margin' : '0 auto'}
            if res.data.count
              $(star).next().html("(" + res.data.count + ")")
    
    
$(document).ready ->
  do index.init