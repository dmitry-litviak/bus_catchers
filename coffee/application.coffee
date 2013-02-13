#SYS.spinerUrl = SYS.baseUrl + 'img/spinner.gif'
#
#class uploader
#  options:
#    url      : SYS.baseUrl + "uploader/temp"
#    dataType : 'json'
#
#  constructor: (o) ->
#    $.extend @, o
#    do @init
#
#  init: ->
#    @selector.fileupload @options
#
#    @selector.bind 'fileuploadadd', (e, data) =>
#      @addCallback?(e, data)
#      $(e.currentTarget).data('fileupload')._trigger('sent', e, data)
#
#    @selector.bind 'fileuploadprogress', (e, data) =>
#      progress = parseInt(data.loaded / data.total * 100, 10)
#      @progressCallback?(progress)
#
#    @selector.bind 'fileuploaddone', (e, data) =>
#      @doneCallback?(e, data)
#
#    #will be need if will be using IE
#    #@selector.bind 'fileuploadalways', (e, data) =>
#    #  @doneCallback?(e, data)
#
#class LazyPagination
#  direction: 'next'
#  offset: 0
#
#  constructor: ->
#    do @detectElements
#    do @_bindEvent
#
#  setDirection: (direction) ->
#    @direction = direction
#
#  detectElements: ->
#    @button = $('.pager > li > a')
#
#  recountOffset: ->
#    @offset = $('fieldset.places').length
#
#  _bindEvent: ->
#    @button.on 'click', =>
#      do @recountOffset
#      do @_getItem
#      false
#
#  _getItem: ->
#    $.ajax
#      url: "#{SYS.baseUrl}trips/ajax_get_trip"
#      dataType: 'json'
#      data: $.param
#        offset: @offset, direction: @direction
#      beforeSend: -> do $('.spiner').show
#      complete  : -> do $('.spiner').hide
#      success: (res) =>
#        if res.text is 'success'
#          $('fieldset:last').after res.data
#        else
#          @button.parent().addClass 'disabled'
#          @button.off 'click'
#          (new Alert).setLayout('main').setStatus('info').setMessage('Nothing more, sorry').render()
#
#
#class Alert
#  prepend_selector: $('body')
#  setStatus: (status) ->
#    @status = status
#    switch status
#      when ("success")
#        @strong = "Well done!"
#      when ("error")
#        @strong = "Oh snap!"
#      when ("info")
#        @strong = "Info!"
#      else
#        @strong = "Info!"
#    @
#
#  @hideAll: ->
#    $(".alert").remove()
#
#  setLayout: (layout = "main") ->
#    switch layout
#      when ("main")
#        @prepend_selector = ".my-container"
#      when ("admin")
#        @prepend_selector = ".span8"
#      else
#        @prepend_selector = ".my-container"
#    @
#
#  setMessage: (message) ->
#    @message = message
#    @
#
#  render: ->
#    $(".alert").remove()
#    html = "<div class=\"alert alert-" + @status + "\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>" + @strong + "</strong> " + @message + "</div>"
#    $(@prepend_selector).prepend html
#
#
#days_diff = (date1, date2) ->
#  one_day = 1000 * 60 * 60 * 24
#  #month1 = date1.getMonth() - 1
#  #month2 = date1.getMonth() - 1
#  date1.getMonth() - 1
#  date1.getMonth() - 1
#  res = Math.ceil((date2.getTime() - date1.getTime()) / (one_day))
#  res = 0 if res <= 0
#  res
#
#  #_Diff gives the diffrence between the two dates.