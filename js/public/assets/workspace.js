(function(){
window.JST = window.JST || {};

window.JST['table'] = _.template('<table class="table table-striped">\n    <thead>\n        <tr>\n            <th>Company name</th>\n            <th>Departure time</th>\n            <th>Arrival time</th>\n            <th>Travel time</th>\n            <th>Cost</th>\n            <th>Link</th>\n        </tr>\n    </thead>\n    <tbody>\n    <% _.each(schedules, function(schedule) { %>\n        <tr>\n            <td><%=schedule.COMPANY_NAME %></td>\n            <td><%=schedule.DEPART_TIME %></td>\n            <td><%=schedule.ARRIVE_TIME %></td>\n            <td><%=schedule.TRIP_LENGTH %></td>\n            <td><%= "$" + schedule.TRIP_COST %></td>\n            <td><%="SOON" %></td>\n        </tr>\n    <% }) %>\n    </tbody>\n</table>');
window.JST['text'] = _.template('<h4 id="search_res_text" style="text-align:center"><%=text %></h4>');
})();