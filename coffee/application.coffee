loadingMask =
  delay: 100
  spinner : {}
  opts :
    color   : '#bd0d00'
    shape   : 'spiral'
    diameter: 150
    density : 100
    range   : 1.4
    FPS     : 50

  createSpinner: () ->
    if _.isEmpty(@spinner)
      @spinner = new CanvasLoader("search_res_div")
      @spinner.setShape(@opts.shape)
      @spinner.setColor(@opts.color)
      @spinner.setDiameter(@opts.diameter);
      @spinner.setDensity(@opts.density);
      @spinner.setRange(@opts.range);
      @spinner.setFPS(@opts.FPS);

#      loaderObj = document.getElementById("canvasLoader")
#      loaderObj.style.position = "absolute"
#      loaderObj.style["top"] = @spinner.getDiameter() * -0.5 + "px"
#      loaderObj.style["left"] = @spinner.getDiameter() * -0.5 + "px"

  show: (spinner = true) ->
    @createSpinner()
    @spinner.show() if spinner

  hide: ->
    @spinner.hide()