index =
  template      : JST["table"]
  template_text : JST['text']
  init: ->
    do @detectElements
    do @bindEvents

  detectElements: ->
    @form       =  $('#schedule')
    @search_res =  $('#search_res_div')
    @options    =
      success    : @showResponse
      beforeSend: () ->
        loadingMask.show()

  bindEvents: ->
    do @initFormSubmit
    do @initTheme

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
      index.search_res.append index.template({schedules : obj.data})
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

  initFormSubmit: ->
    @form.submit (e) =>
      el = $(e.currentTarget)
      @search_res.empty()
      el.ajaxSubmit @options
      false

$(document).ready ->
  do index.init