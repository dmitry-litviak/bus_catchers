// Generated by CoffeeScript 1.4.0
var raty;

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

raty = {
  template: JST['company/comment'],
  init: function() {
    this.detect_elements();
    return this.bind_events();
  },
  detect_elements: function() {
    this.timeliness = $("#timeliness");
    this.comfort = $("#comfort");
    this.wifi = $("#wifi");
    this.empty_seating = $("#empty-seating");
    this.cleanliness = $("#cleanliness");
    this.form = $(".comment-form");
    this.comments = $(".comments-block");
    this.company = $("#company");
    return this.options = {
      success: this.showResponse
    };
  },
  bind_events: function() {
    this.create_rate();
    this.init_form_submit();
    return this.get_comments();
  },
  get_comments: function() {
    var me,
      _this = this;
    me = this;
    return $.ajax({
      url: SYS.baseUrl + 'company/get_comments',
      data: $.param({
        id: me.company.val()
      }),
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        if (res.text = "success") {
          return _.each(res.data, function(comment) {
            me.comments.append(me.template({
              comment: comment
            }));
            $("#timeliness" + comment.id).raty({
              half: true,
              size: 16,
              readOnly: true,
              starHalf: SYS.baseUrl + "img/stars/star-half.png",
              starOff: SYS.baseUrl + "img/stars/star-off.png",
              starOn: SYS.baseUrl + "img/stars/star-on.png",
              score: comment.timeliness
            });
            $("#comfort" + comment.id).raty({
              half: true,
              size: 16,
              readOnly: true,
              starHalf: SYS.baseUrl + "img/stars/star-half.png",
              starOff: SYS.baseUrl + "img/stars/star-off.png",
              starOn: SYS.baseUrl + "img/stars/star-on.png",
              score: comment.comfort
            });
            $("#wifi" + comment.id).raty({
              half: true,
              size: 16,
              readOnly: true,
              starHalf: SYS.baseUrl + "img/stars/star-half.png",
              starOff: SYS.baseUrl + "img/stars/star-off.png",
              starOn: SYS.baseUrl + "img/stars/star-on.png",
              score: comment.wifi
            });
            $("#empty-seating" + comment.id).raty({
              half: true,
              size: 16,
              readOnly: true,
              starHalf: SYS.baseUrl + "img/stars/star-half.png",
              starOff: SYS.baseUrl + "img/stars/star-off.png",
              starOn: SYS.baseUrl + "img/stars/star-on.png",
              score: comment.empty_seating
            });
            return $("#cleanliness" + comment.id).raty({
              half: true,
              size: 16,
              readOnly: true,
              starHalf: SYS.baseUrl + "img/stars/star-half.png",
              starOff: SYS.baseUrl + "img/stars/star-off.png",
              starOn: SYS.baseUrl + "img/stars/star-on.png",
              score: comment.cleanliness
            });
          });
        }
      }
    });
  },
  showResponse: function(responseText, statusText, xhr, $form) {
    var obj;
    obj = jQuery.parseJSON(responseText);
    if (obj.text === "success") {
      return raty.comments.prepend(raty.template({
        comment: obj.data
      }));
    } else {
      return console.log(responseText);
    }
  },
  init_form_submit: function() {
    var _this = this;
    return this.form.submit(function(e) {
      var el;
      el = $(e.currentTarget);
      el.ajaxSubmit(_this.options);
      return false;
    });
  },
  create_rate: function() {
    this.timeliness.raty({
      half: true,
      size: 24,
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png",
      starOff: SYS.baseUrl + "img/stars/star-off-big.png",
      starOn: SYS.baseUrl + "img/stars/star-on-big.png",
      score: 0,
      target: '#timeliness-input',
      targetType: 'number',
      targetKeep: true
    });
    this.comfort.raty({
      half: true,
      size: 24,
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png",
      starOff: SYS.baseUrl + "img/stars/star-off-big.png",
      starOn: SYS.baseUrl + "img/stars/star-on-big.png",
      score: 0,
      target: '#comfort-input',
      targetType: 'number',
      targetKeep: true
    });
    this.wifi.raty({
      half: true,
      size: 24,
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png",
      starOff: SYS.baseUrl + "img/stars/star-off-big.png",
      starOn: SYS.baseUrl + "img/stars/star-on-big.png",
      score: 0,
      target: '#wifi-input',
      targetType: 'number',
      targetKeep: true
    });
    this.empty_seating.raty({
      half: true,
      size: 24,
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png",
      starOff: SYS.baseUrl + "img/stars/star-off-big.png",
      starOn: SYS.baseUrl + "img/stars/star-on-big.png",
      score: 0,
      target: '#empty-seating-input',
      targetType: 'number',
      targetKeep: true
    });
    return this.cleanliness.raty({
      half: true,
      size: 24,
      starHalf: SYS.baseUrl + "img/stars/star-half-big.png",
      starOff: SYS.baseUrl + "img/stars/star-off-big.png",
      starOn: SYS.baseUrl + "img/stars/star-on-big.png",
      score: 0,
      target: '#cleanliness-input',
      targetType: 'number',
      targetKeep: true
    });
  }
};

$(document).ready(function() {
  return raty.init();
});
