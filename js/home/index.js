// Generated by CoffeeScript 1.4.0
var index;

index = {
  template: JST["table"],
  template_text: JST['text'],
  init: function() {
    this.detectElements();
    return this.bindEvents();
  },
  detectElements: function() {
    this.form = $('#schedule');
    this.search_res = $('#search_res_div');
    return this.options = {
      success: this.showResponse,
      beforeSend: function() {
        return loadingMask.show();
      }
    };
  },
  bindEvents: function() {
    return this.initFormSubmit();
  },
  showResponse: function(responseText, statusText, xhr, $form) {
    var obj;
    loadingMask.hide();
    obj = jQuery.parseJSON(responseText);
    if (obj.text === "success") {
      index.search_res.empty();
      return index.search_res.append(index.template({
        schedules: obj.data
      }));
    } else {
      index.search_res.empty();
      return index.search_res.append(index.template_text({
        text: obj.errors
      }));
    }
  },
  initFormSubmit: function() {
    var _this = this;
    return this.form.submit(function(e) {
      var el;
      el = $(e.currentTarget);
      el.ajaxSubmit(_this.options);
      return false;
    });
  }
};

$(document).ready(function() {
  return index.init();
});
