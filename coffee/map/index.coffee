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
      zoom: 9
      maxZoom: 18
      minZoom: 3
      center: new google.maps.LatLng(40.752508, -73.993714)
      mapTypeId: google.maps.MapTypeId.ROADMAP
    
    @geocoder      = undefined
    @map           = undefined
    @markers       = []
    
    @image  = new google.maps.MarkerImage("../img/marker-images/image.gif", new google.maps.Size(18, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17))
    @shadow = new google.maps.MarkerImage("../img/marker-images/shadow.png", new google.maps.Size(30, 17), new google.maps.Point(0, 0), new google.maps.Point(9, 17))
    @shape =
      coord: [10, 0, 11, 1, 12, 2, 13, 3, 14, 4, 15, 5, 16, 6, 17, 7, 14, 8, 15, 9, 15, 10, 15, 11, 15, 12, 15, 13, 15, 14, 15, 15, 14, 16, 3, 16, 2, 15, 2, 14, 2, 13, 2, 12, 2, 11, 2, 10, 2, 9, 3, 8, 0, 7, 1, 6, 2, 5, 3, 4, 4, 3, 3, 2, 3, 1, 3, 0, 10, 0]
      type: "poly"
    
    @map_name    = "gmaps-canvas"
    @gmarkers       = []
    
  bind_events: ->
    do @initialize_map
  
  update_ui: (address, latLng) ->
    @gmap_input.autocomplete "close"
    @gmap_input.val address
    @lat_input.val latLng.lat()
    @lng_input.val latLng.lng()
  
  geocode_lookup: (type, value, update) ->
    me = @
    update = (if typeof update isnt "undefined" then update else false)
    request = {}
    request[type] = value
    @geocoder.geocode request, (results, status) ->
      me.gmap_error.html ""
      me.gmap_error.hide()
      if status is google.maps.GeocoderStatus.OK
        if results[0]
          me.update_ui results[0].formatted_address, results[0].geometry.location
        else
          me.gmap_error.html "Sorry, something went wrong. Try again!"
          me.gmap_error.show()
      else
        if type is "address"
          me.gmap_error.html "Sorry! We couldn't find " + value + ". Try a different search term."
          me.gmap_error.show()
        else
          me.gmap_error.html "Woah... that's pretty remote! You're going to have to manually enter a place name."
          me.gmap_error.show()
          me.update_ui "", value
  
  initialize_map: ->
    @map_options.center = new google.maps.LatLng($("#d_lat").val(), $("#d_long").val())  
    gmap = document.getElementById(@map_name)
    @map = new google.maps.Map(gmap, @map_options)
    do @get_markers
  
  get_markers: ->
    me = @
    $.ajax
      url: SYS.baseUrl + 'map/get_markers'
      data: $.param({})
      type: 'POST'
      dataType: 'json'
      success: (res) =>
        if res.text = "success"
          $.each res.data, (i, item) ->
            marker     = new google.maps.Marker(
              position: new google.maps.LatLng(item.lat, item.long)
#              icon    : me.image
#              shadow  : me.shadow
#              shape   : me.shape
            )
            infowindow = new google.maps.InfoWindow(content: "")
            google.maps.event.addListener marker, "click", ->
              $.ajax
                url: SYS.baseUrl + 'map/get_info'
                data: $.param({id : item.id})
                type: 'POST'
                dataType: 'json'
                success: (res) =>
                  if res.text = "success"
                    infowindow.setContent me.template({item: res.data, url : SYS.baseUrl})
                    infowindow.open me.map, marker
                    
            me.markers.push(marker);   
          markerClusterer = new MarkerClusterer(me.map, me.markers,
            maxZoom: 15
            gridSize: 50
            styles: null
          )   
 
$(document).ready ->
  do index.init