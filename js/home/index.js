// Generated by CoffeeScript 1.4.0
var index;

index = {
  template: JST["home/table"],
  template_text: JST['home/text'],
  init: function() {
    this.detectElements();
    return this.bindEvents();
  },
  detectElements: function() {
    this.form = $('#schedule');
    this.search_res = $('#search_res_div');
    this.read_more = $('.read-more');
    this.info = $('.info-block');
    return this.options = {
      success: this.showResponse,
      beforeSend: function() {
        return loadingMask.show();
      }
    };
  },
  bindEvents: function() {
    this.initFormSubmit();
    this.initTheme();
    return this.company_click();
  },
  company_click: function() {
    this.read_more.popover();
    return this.read_more.click(function(e) {
      var element;
      element = this;
      index.read_more.each(function() {
        if (this !== element) {
          return $(this).popover('hide');
        }
      });
      if ($(".infor").length <= 0) {
        $(".popover-content").append('<a class="infor" href="' + SYS.baseUrl + 'company/info/' + $(element).data('title') + '">Read More</a>');
      }
      return e.preventDefault();
    });
  },
  initTheme: function() {
    return $.extend($.tablesorter.themes.bootstrap, {
      table: "table table-striped",
      header: "bootstrap-header",
      footerRow: "",
      footerCells: "",
      icons: "",
      sortNone: "bootstrap-icon-unsorted",
      sortAsc: "icon-chevron-up",
      sortDesc: "icon-chevron-down",
      active: "",
      hover: "",
      filterRow: "",
      even: "",
      odd: ""
    });
  },
  showResponse: function(responseText, statusText, xhr, $form) {
    var obj;
    loadingMask.hide();
    obj = jQuery.parseJSON(responseText);
    if (obj.text === "success") {
      index.search_res.empty();
      index.search_res.append(index.template({
        schedules: obj.data,
        baseurl: SYS.baseUrl
      }));
      return index.initTable();
    } else {
      index.search_res.empty();
      return index.search_res.append(index.template_text({
        text: obj.errors
      }));
    }
  },
  initTable: function() {
    return $("table").tablesorter({
      theme: "bootstrap",
      widthFixed: true,
      headerTemplate: "{content} {icon}",
      widgets: ["uitheme", "zebra"],
      widgetOptions: {
        zebra: ["even", "odd"]
      },
      headers: {
        5: {
          sorter: false
        },
        6: {
          sorter: false
        }
      }
    });
  },
  initFormSubmit: function() {
    var _this = this;
    return this.form.submit(function(e) {
      var el;
      el = $(e.currentTarget);
      _this.search_res.empty();
      el.ajaxSubmit(_this.options);
      return false;
    });
  }
};

$(document).ready(function() {
  return index.init();
});
