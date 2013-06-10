index = 
  template       : JST["map/info"]
  init: ->
    do @detect_elements
    do @bind_events
  
  detect_elements: ->
    @gmap_input     = $("#gmaps-input-address")
    @gmap_error     = $("#gmaps-error")

    @jmap        = $("#gmaps-canvas")
    @map_options =
      zoom: 13
      maxZoom: 18
      minZoom: 3
      center: new google.maps.LatLng(40.752508, -73.993714)
      mapTypeId: google.maps.MapTypeId.ROADMAP
    
    @map_d         = undefined
    @map_a         = undefined
    @markers_d     = []
    @markers_a     = []
    @info_d        = []
    @info_a        = []
    
    @image  = new google.maps.MarkerImage("../img/marker-images/image.gif", new google.maps.Size(18, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17))
    @shadow = new google.maps.MarkerImage("../img/marker-images/shadow.png", new google.maps.Size(30, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17))
    @shape =
      coord: [10, 0, 11, 1, 12, 2, 13, 3, 14, 4, 15, 5, 16, 6, 17, 7, 14, 8, 15, 9, 15, 10, 15, 11, 15, 12, 15, 13, 15, 14, 15, 15, 14, 16, 3, 16, 2, 15, 2, 14, 2, 13, 2, 12, 2, 11, 2, 10, 2, 9, 3, 8, 0, 7, 1, 6, 2, 5, 3, 4, 4, 3, 3, 2, 3, 1, 3, 0, 10, 0]
      type: "poly"
    
    @map_name_d    = "gmaps-canvas-depart"
    @map_name_a    = "gmaps-canvas-arrive"
    @gmarkers       = []
    @companies = $("input:checkbox[name=companies]")
    
  bind_events: ->
    do @initialize_map
  
  update_ui: (address, latLng) ->
    @gmap_input.autocomplete "close"
    @gmap_input.val address
    @lat_input.val latLng.lat()
    @lng_input.val latLng.lng()
  
  checkbox_click: ->
    @companies.click ->
      do index.clearOverlays
      do index.get_markers
  
  all_click: ->
    me = @
    $("input:checkbox[name=all]").click ->
      me.companies.removeAttr("checked")
      if $(this).is(":checked")
        me.companies.attr("checked", "checked")
      do index.clearOverlays
      do index.get_markers
  
  clearOverlays: ->
    i = 0
    while i < @markers_a.length
      @markers_a[i].setMap null
      i++
    @markers_a = []
    i = 0
    while i < @markers_d.length
      @markers_d[i].setMap null
      i++
    @markers_d = []
  
  initialize_map: ->
    @map_options.center = new google.maps.LatLng($("#d_lat").val(), $("#d_long").val())
    if $("#d_lat").val() == "40"
      @map_options.zoom = 4
    gmap = document.getElementById(@map_name_d)
    @map_d = new google.maps.Map(gmap, @map_options)
    @map_options.center = new google.maps.LatLng($("#a_lat").val(), $("#a_long").val())  
    gmap = document.getElementById(@map_name_a)
    @map_a = new google.maps.Map(gmap, @map_options)
    do @get_markers
    do @checkbox_click
    do @all_click
    google.maps.visualRefresh = true
  
  close_info: (i, map) ->
    if map == "a"
      index.info_a[i].close()
    else
      index.info_d[i].close()
  
  get_markers: ->
    me = @
    companies = []
    $("input:checkbox[name=companies]:checked").each ->
      companies.push($(this).val())
#    console.log companies
    $.ajax
      url: SYS.baseUrl + 'map/get_markers'
      data: $.param({companies : companies})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text = "success"
          $.each res.data, (i, item) ->
            marker_a     = new google.maps.Marker(
              position: new google.maps.LatLng(item.lat, item.long)
              map: me.map_a
            )
            infowindow_a = new google.maps.InfoWindow(content: "")
            me.info_a.push infowindow_a
            info_index = me.info_a.length - 1
            $.ajax
                url: SYS.baseUrl + 'map/get_info'
                data: $.param({id : item.id})
                type: 'POST'
                dataType: 'json'
                success: (res) =>
                  if res.text = "success"
                    infowindow_a.setContent me.template({item: res.data, url : SYS.baseUrl, info_index : info_index, map : "a"})
            google.maps.event.addListener marker_a, "click", ->
              infowindow_a.open me.map_a, marker_a
                    
            marker_d     = new google.maps.Marker(
              position: new google.maps.LatLng(item.lat, item.long)
              map: me.map_d
            )
            infowindow_d = new google.maps.InfoWindow(content: "")
            me.info_d.push infowindow_d
            info_index = me.info_d.length - 1
            $.ajax
                url: SYS.baseUrl + 'map/get_info'
                data: $.param({id : item.id})
                type: 'POST'
                dataType: 'json'
                success: (res) =>
                  if res.text = "success"
                    infowindow_d.setContent me.template({item: res.data, url : SYS.baseUrl, info_index : info_index, map : "d"})
            google.maps.event.addListener marker_d, "click", ->
              infowindow_d.open me.map_d, marker_d
                    
            me.markers_a.push(marker_a);
            me.markers_d.push(marker_d);
            
#          markerClusterer = new MarkerClusterer(me.map_d, me.markers_d,
#            maxZoom: 15
#            gridSize: 50
#            styles: null
#          ) 
#          markerClusterer = new MarkerClusterer(me.map_a, me.markers_a,
#            maxZoom: 15
#            gridSize: 50
#            styles: null
#          )   
 
$(document).ready ->
  do index.init