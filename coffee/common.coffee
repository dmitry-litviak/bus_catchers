#((d) ->
#  js = undefined
#  id = "facebook-jssdk"
#  ref = d.getElementsByTagName("script")[0]
#  return  if d.getElementById(id)
#  js = d.createElement("script")
#  js.id = id
#  js.async = true
#  js.src = "//connect.facebook.net/en_US/all.js"
#  ref.parentNode.insertBefore js, ref
#) document
#    
#common =
#  init: ->
#    do @detect_elements
#    do @bind_events   
#    
#  detect_elements: ->
#    @fb = $(".fb")
#    @logout = $(".logout")
#    @social_buttons = $(".social-buttons")
#  
#  bind_events: ->
#    do @check_logged_status
#  
#  check_logged_status: ->
#    window.fbAsyncInit = ->
#      FB.init
#        appId: "134627846735967"
#        channelUrl: "//buscatchers.loc/channel.html"
#        status: true
#        cookie: true
#        xfbml: true
#      FB.getLoginStatus (response) ->
#        if response.status is "connected"
#          do common.init_buttons_fb
#          do common.logout_init
#        else if response.status is "not_authorized"
#          do common.fb_login_click
#        else
#          do common.fb_login_click
#  
#  init_buttons_fb: ->
#    FB.api "/me", (response) ->
#      common.social_buttons.empty()
#      common.social_buttons.append '<button class="btn btn-large fb disabled">Logged as '+response.name+'</button>'
#      common.social_buttons.append "<button class='btn btn-large logout pull-right' type='button'>Logout</button>"
#  
#  fb_login_click: ->
#    @social_buttons.append '<button class="btn btn-large fb">Login with Facebook</button>'
#    @fb.live "click", ->
#      element = $(this)
#      unless element.hasClass("disabled")
#        FB.login ((response) ->
#          if response.authResponse
#            do common.init_buttons_fb
#            do common.logout_init
#          else
#            console.log "User cancelled login or did not fully authorize."
#        ),
#          scope: "email,user_likes"
#          
#  logout_init: ->
#    $(".logout").live "click", ->
#      FB.logout()
#      common.social_buttons.empty()
#      common.social_buttons.append '<button class="btn btn-large fb">Login with Facebook</button>'
#  
#    
#    
#$(document).ready ->
#  do common.init