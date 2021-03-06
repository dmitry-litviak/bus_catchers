// Generated by CoffeeScript 1.4.0
var index;

$(function() {
  $(window).scroll(function() {
    if ($(this).scrollTop() !== 0) {
      return $("#toTop").fadeIn();
    } else {
      return $("#toTop").fadeOut();
    }
  });
  return $("#toTop").click(function() {
    return $("body,html").animate({
      scrollTop: 0
    }, 800);
  });
});

index = {
  init: function() {
    this.detect_elements();
    return this.bind_events();
  },
  detect_elements: function() {
    return this.stars = $(".stars");
  },
  bind_events: function() {
    return this.create_rate();
  },
  create_rate: function() {
    var me;
    me = this;
    return _.each(this.stars, function(star) {
      var company_id,
        _this = this;
      company_id = $(star).data("company");
      return $.ajax({
        url: SYS.baseUrl + 'compare/get_avg_rating',
        data: $.param({
          id: company_id
        }),
        type: 'POST',
        dataType: 'json',
        success: function(res) {
          if (res.text === "success") {
            $(star).raty({
              half: true,
              size: 24,
              starHalf: SYS.baseUrl + "img/stars/star-half-big.png",
              starOff: SYS.baseUrl + "img/stars/star-off-big.png",
              starOn: SYS.baseUrl + "img/stars/star-on-big.png",
              readOnly: true,
              score: res.data.rating,
              noRatedMsg: "Be the first to leave a review",
              hints: ['bad', 'poor', 'average', 'good', 'excellent']
            });
            $(star).css({
              'margin': '0 auto'
            });
            if (res.data.count) {
              return $(star).next().html("(" + res.data.count + ")");
            }
          }
        }
      });
    });
  }
};

$(document).ready(function() {
  return index.init();
});
