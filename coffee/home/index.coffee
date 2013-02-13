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

  bindEvents: ->
    do @initFormSubmit

  showResponse: (responseText, statusText, xhr, $form) ->
    obj = jQuery.parseJSON responseText
    if obj.text is "success"
      index.search_res.empty()
      index.search_res.append index.template({schedules : obj.data})
    else
      index.search_res.empty()
      index.search_res.append index.template_text({text : obj.errors})

  initFormSubmit: ->
    @form.submit (e) =>
      el = $(e.currentTarget)
      el.ajaxSubmit @options
      false

$(document).ready ->
  do index.init