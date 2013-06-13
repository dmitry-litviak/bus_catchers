(function(){
window.JST = window.JST || {};

window.JST['company/comment'] = _.template('\n<hr>\n<div class="row-fluid">\n    <div class="span7">\n        <div class="control-group">\n            <div class="controls">\n                <h3><%= comment.name %></h3>\n            </div>\n        </div>\n        <div class="control-group">\n            <div class="controls">\n                <h5><%= comment.message %></h5>\n            </div>\n        </div>\n    </div>\n    <div class="span5">\n        <div class="row-fluid">\n            <div class="span3">Timeliness:</div>\n            <div id="timeliness<%= comment.id %>" class="span9"></div>\n        </div>\n        <div class="row-fluid">\n            <div class="span3">Comfort:</div>\n            <div id="comfort<%= comment.id %>" class="span9"></div>\n        </div>\n        <div class="row-fluid">\n            <div class="span3">WiFi:</div>\n            <div id="wifi<%= comment.id %>" class="span9"></div>\n        </div>\n        <div class="row-fluid">\n            <div class="span3">Empty seating:</div>\n            <div id="empty-seating<%= comment.id %>" class="span9"></div>\n        </div>\n        <div class="row-fluid">\n            <div class="span3">Cleanliness:</div>\n            <div id="cleanliness<%= comment.id %>" class="span9"></div>\n        </div>\n    </div>\n</div>\n');
window.JST['home/table'] = _.template('<table class="table table-striped">\n    <thead>\n        <tr>\n            <th>Company<i class="tablesorter-icon bootstrap-icon-unsorted"></i></th>\n            <th>Departure time<i class="tablesorter-icon bootstrap-icon-unsorted"></i></th>\n            <th>Arrival time<i class="tablesorter-icon bootstrap-icon-unsorted"></i></th>\n            <th>Travel time<i class="tablesorter-icon bootstrap-icon-unsorted"></i></th>\n            <th>Cost<i class="tablesorter-icon bootstrap-icon-unsorted"></i></th>\n            <th>Link<i class="tablesorter-icon bootstrap-icon-unsorted"></i></th>\n            <th>Map<i class="tablesorter-icon bootstrap-icon-unsorted"></i></th>\n        </tr>\n    </thead>\n    <tbody>\n    <% _.each(schedules, function(schedule) { %>\n        <tr>\n            <td><%=schedule.COMPANY_NAME %></td>\n            <td><%=schedule.DEPART_TIME %></td>\n            <td><%=schedule.ARRIVE_TIME %></td>\n            <td><%=schedule.TRIP_LENGTH %></td>\n            <td><%= "$" + schedule.TRIP_COST %></td>\n            <td><a href="<%= schedule.URL %>" target="_blank">Go</a></td>\n            <td><a href="<%= baseurl %>map?company=<%=schedule.COMPANY_NAME %>&arrive=<%=schedule.ARRIVE_CITY %>&depart=<%=schedule.DEPART_CITY %>">Stations</a></td>\n        </tr>\n    <% }) %>\n    </tbody>\n</table>');
window.JST['home/text'] = _.template('<h4 id="search_res_text" style="text-align:center"><%=text %></h4>');
window.JST['map/info'] = _.template('<div class="info-map">\n    <strong><p class="centered"><%= item[0].company_name %></p></strong>\n    <p class="centered"><%= item[0].description %></p>\n    <p class="centered"><%= item[0].address %></p>\n    <p class="centered"><a href="javascript: index.close_info(<%= info_index %>, \'<%= map %>\')">Close</a></p>\n</div>');
})();