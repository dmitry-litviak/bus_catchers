index =
  template      : JST["home/table"]
  template_text : JST['home/text']
  init: ->
    do @detectElements
    do @bindEvents

  detectElements: ->
    @form       =  $('#schedule')
    @search_res =  $('#search_res_div')
    @read_more  =  $('.read-more')
    @info       =  $('.info-block')
    @slider     =  $(".slider-range")
    @inp_beg    =  $("#time_beg")
    @inp_end    =  $("#time_end")
    @span_beg   =  $(".time-beg")
    @span_end   =  $(".time-end")
    @options    =
      success    : @showResponse
      beforeSend: () ->
        loadingMask.show()
    @companies = $(".c_name")

  bindEvents: ->
    do @initFormSubmit
    do @initTheme
    do @company_click
    do @all_click
#    do @range_slider_init
  
  range_slider_init: ->
    me = @
    @slider.slider
      range: true
      min: 5
      max: 1435
      step: 5
      values: [ 5, 1435 ],
      slide: (e, ui) ->
        values = []
        _.each ui.values, (num, key) ->
          hours = Math.floor(num / 60)
          minutes = num - (hours * 60)
#          hours = "0" + hours  if hours.toString().length is 1
#          minutes = "0" + minutes  if minutes.toString().length is 1 
          values.push index.format_date hours, minutes
        me.span_beg.html values[0]
        me.span_end.html values[1]
        me.inp_beg.val values[0]
        me.inp_end.val values[1]
        
        
  format_date: (hours, minutes) ->
    ampm = (if hours >= 12 then "pm" else "am")
    hours = hours % 12
    hours = (if hours > 9 then hours else "0"+hours) 
    minutes = (if minutes < 10 then "0" + minutes else minutes)
    strTime = hours + ":" + minutes + " " + ampm  
    
  all_click: ->
    me = @
    $("input:checkbox[name=all]").click ->
      me.companies.removeAttr("checked")
      if $(this).is(":checked")
        me.companies.attr("checked", "checked")
  
  company_click: ->
    @read_more.popover()
    @read_more.click (e) ->
      element = @
      index.read_more.each ->
        if @ != element
          $(@).popover('hide')
          $(".infor").remove()
      if $(".infor").length <= 0
        $(".popover-content").append('<a class="infor" href="'+SYS.baseUrl+'company/info/'+$(element).data('title')+'">Read More</a>')
      e.preventDefault()
#      $('.read-more:not('+element.html()+')').popover('hide')
  
  initTheme: ->
    $.extend $.tablesorter.themes.bootstrap,
      table: "table table-striped"
      header: "bootstrap-header" # give the header a gradient background
      footerRow: ""
      footerCells: ""
      icons: "" # add "icon-white" to make them white; this icon class is added to the <i> in the header
      sortNone: "bootstrap-icon-unsorted"
      sortAsc: "icon-chevron-up"
      sortDesc: "icon-chevron-down"
      active: "" # applied when column is sorted
      hover: "" # use custom css here - bootstrap class may not override it
      filterRow: "" # filter row class
      even: "" # odd row zebra striping
      odd: "" # even row zebra striping

  showResponse: (responseText, statusText, xhr, $form) ->
    loadingMask.hide()
    obj = jQuery.parseJSON responseText
    if obj.text is "success"
      index.search_res.empty()
      index.search_res.append index.template({schedules : obj.data, baseurl : SYS.baseUrl})
      do index.initTable
    else
      index.search_res.empty()
      index.search_res.append index.template_text({text : obj.errors})

  initTable: ->
    $("table").tablesorter
      theme: "bootstrap" # this will
      widthFixed: true
      headerTemplate: "{content} {icon}" # new in v2.7. Needed to add the bootstrap icon!
      widgets: ["uitheme", "zebra"]
      widgetOptions:
        zebra: ["even", "odd"]
      headers:
        5:
          sorter: false
        6:
          sorter: false

  initFormSubmit: ->
    @form.submit (e) =>
      el = $(e.currentTarget)
      @search_res.empty()
      el.ajaxSubmit @options
      false

$(document).ready ->
  do index.init