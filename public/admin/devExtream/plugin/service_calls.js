/*
 * js file for some generic functions
/*
 *getting form data
 *@param form_id
 */

function get_form_data(form_id) {
  var json = {};
  $('#' + form_id + ' .report_data').each(function () {
    console.log(this.tagName, this.id);
    if (this.tagName == 'SELECT') { // check if form element is select
      //alert(this.multiple == true);
      if (this.multiple == true) { // check if multiple select box can be selected
        select_name = this.id;
        json[select_name] = {};
        $('#' + form_id + ' select[id=' + select_name + '] option:selected').each(function () { // to get value from each selected options
          json[select_name][this.value] = this.value;
        });
      } else {
        json[this.name] = this.value;
      }
    }
    else if (this.tagName == 'DIV') {
      var tag_id = this.id;
      get_dropdown_id_rpt(tag_id, function (ids) {
        json[tag_id] = ids;
      })

    }
    else if (this.type == 'radio') { // check if form element is radio
      if (this.checked == true) {
        json[this.name] = this.value;
      }
    } else if (this.type == 'checkbox') { // check if form element is checkbox
      if (this.checked == true) {
        json[this.name] = this.value;
      }
    } else {
      json[this.name] = this.value;
    }
  });
  return json;
}

/*
 * function to create dynamic tabs for each user
 */

/*
 * call service function
 * @data data posted to service
 * @method webservice name
 * @div_id div "id" to populate hrml
 */
function call_service(post_data, file_name, method, div_id, attr, loader = false) {
  $('.formError').remove();
  post_data['api_key'] = $('#api_key').val();
  var base_path = $('#base_path').val(); // getting base path of site
  $.ajax({
    url: base_path + file_name + '/' + method, // URL of the web service
    type: 'post',
    data: post_data,
    cache: false,
    beforeSend: function () {
      if (loader == true)
        $('.loader').show();
    },
    complete: function () {
      if (loader == true)
        $('.loader').hide();
    },
    // Success function. the 'data' parameter is an array of objects that can be looped over
    success: function (data, textStatus) {
      //$(".progress_bar").hide();
      if (div_id && data) { // check if there is any response id mentioned in call service
        $('#' + div_id).removeData();
        $('#' + div_id).html(data).fadeIn('slow');
      } else if (data) { // if not reponse id, then we should have some js to execute.
        execute_js(data); // this function to execute js script return by view using ajax. (for example: trigger message div to show message.)
      }
      if (attr['func']) {
        attr['func'](data); // calling a dynamic function in variable func
      }
    },
    // Failed to load request. This could be caused by any number of problems like server issues, bad links, etc.
    error: function (jqXHR, textStatus, errorThrown) {
      //$(".progress_bar").hide();
      alert("service called function failed");
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = evt.loaded / evt.total;
          show_progress(percentComplete, "Upload");
        }
      }, false);
      xhr.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = evt.loaded / evt.total;
          show_progress(percentComplete, "Download");
        }
      }, false);
      return xhr;
    }
  });
}
function show_progress(percent, text) {
  percent = parseInt(percent * 100);
  console.log(percent, text);
  $(".progress_bar").text(percent + "% " + text);
  $('.progress_bar').css({
    width: percent + '%'
  });
}
function call_json_service(post_data, file_name, method, div_id, attr) {
  $('.formError').remove();
  post_data['api_key'] = $('#api_key').val();
  var base_path = $('#base_path').val(); // getting base path of site
  $.ajax({
    url: base_path + file_name + '/' + method, // URL of the web service
    type: 'POST',
    dataType: "json",
    data: post_data,
    // Success function. the 'data' parameter is an array of objects that can be looped over
    success: function (data, textStatus) {
      if (div_id && data) { // check if there is any response id mentioned in call service
        $('#' + div_id).removeData();
        $('#' + div_id).html(data).fadeIn('slow');
      } else if (data) { // if not reponse id, then we should have some js to execute.
        execute_js(data); // this function to execute js script return by view using ajax. (for example: trigger message div to show message.)
      }
      if (attr['func']) {
        attr['func'](data); // calling a dynamic function in variable func
      }
    },
    // Failed to load request. This could be caused by any number of problems like server issues, bad links, etc.
    error: function (jqXHR, textStatus, errorThrown) {
      alert("service called function failed");
    }
  });
}
function show_message(message, type) {
  if (type == '' || type == 'message') { // show success messages
    //$('.successbox').hide();//Hide the div
    $(".successbox").removeData().empty().html(message);
    $(".successbox").fadeIn(2000).delay(3000).fadeOut('slow'); //Add a fade in effect that will last for 2000 millisecond
  } else if (type == 'error') { // show error messages
    $(".errormsgbox").removeData().empty().html(message);
    $(".errormsgbox").fadeIn(2000).delay(5000).fadeOut('slow');
  } else if (type == 'warning') {// show warning messages
    $(".warningbox").removeData().empty().html(message);
    $(".warningbox").fadeIn(2000).delay(5000).fadeOut('slow');
  }
  center_align("errormsgbox");
  center_align("warningbox");
  center_align("successbox");
}
function close_message_bind() {
  $('body').delegate('.errormsgbox', 'click', function () {
    $(this).removeData().empty().fadeOut('slow');
  });

  $('body').delegate('.successbox', 'click', function () {
    $(this).removeData().empty().fadeOut('slow');
  });

}
/*
 * function to execute js script using ajax
 */
function execute_js(data) {
  if (data) {
    $(".execute_js_box").removeData().empty().html(data);
  }
}
/*
 * function to hide other response divs
 */
function hide_reponse_dives(div_id) {
  if (div_id == 'response') {
    $('#table-response-container').hide();
    $('#response-container ul').hide();
    $('.profile_list').hide();
    $('#response').show();
  }
}
function time() {
  return Math.round(+new Date() / 1000);
}
function new_call_service(post_data, url, div_id, loader, func, async = true) {
  var base_path = $('#BasePath').val(); // getting base path of site
  $.ajax({
    url: base_path + url, // URL of the web service
    type: 'POST',
    dataType: "json",
    async: async,
    data: post_data,
    beforeSend: function () {
      if (loader == true)
        $('.loader').show();
    },
    complete: function () {
      if (loader == true)
        $('.loader').hide();
    },
    success: function (data, textStatus) {
      if (func) {
        func(data); // calling a dynamic function in variable func
      } else if (div_id && data) { // check if there is any response id mentioned in call service
        $('#' + div_id).removeData();
        $('#' + div_id).html(data).fadeIn('slow');
      } else if (data) { // if not reponse id, then we should have some js to execute.
        execute_js(data); // this function to execute js script return by view using ajax. (for example: trigger message div to show message.)
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(JSON.stringify(jqXHR) + " : " + textStatus + " : " + errorThrown);

      alert("service called function failed url:" + url + ", post data:" + JSON.stringify(post_data) + ", Error: " + errorThrown);
    }
  });
}

function BindDropdownList(div_id, url, func, selected, is_multiple, post_data = {}, focus_func = null) {
  call_service(post_data, url, null, null, function (data) {
    selection_mode = is_multiple == true ? "multiple" : "single";
    $("#" + div_id).dxDropDownBox({
      value: selected,
      valueExpr: "ID",
      deferRendering: false,
      placeholder: "Select",
      displayExpr: function (item) {
        return item && " (" + item.ID + ") " + item.Name;
      },
      showClearButton: true,
      dataSource: makeAsyncDataSource(JSON.parse(JSON.stringify(data.list))),
      contentTemplate: function (e) {
        var value = e.component.option("value"),
          $dataGrid = $("<div>").dxDataGrid({
            dataSource: e.component.option("dataSource"),
            allowColumnReordering: true,
            allowColumnResizing: true,
            columns: data['columns'],
            filterRow: {
              visible: true,
              applyFilter: "auto"
            },
            headerFilter: {
              visible: true
            },
            scrolling: { mode: "infinite" },
            height: "100%",
            selection: { mode: selection_mode },
            selectedRowKeys: selected,
            onSelectionChanged: function (selectedItems) {
              var keys = selectedItems.selectedRowKeys;
              e.component.option("value", keys);
              if (func) {
                func(selectedItems);
              }
            }
          });
        var databaseDataGrid = $dataGrid.dxDataGrid("instance");
        e.component.on("valueChanged", function (args) {

        });
        dataGrid = $dataGrid.dxDataGrid("instance");
        return $dataGrid;
      }
    });
  })
}
function get_dropdown_id_rpt(div_id, cb = null) {
  id = 0;
  try {

    var ddl = $("#" + div_id).dxDropDownBox("instance").option("value");
    id = ddl.toString();//ddl != null && ddl != "" ? ddl[0] : 0;
    if (cb)
      cb(id);

  } catch (e) { }
  return id;
}
function get_dropdown_id(div_id) {
  console.log(1, div_id);
  id = 0;
  try {

    var ddl = $("#" + div_id).dxDropDownBox("instance").option("value");
    id = ddl.toString();//ddl != null && ddl != "" ? ddl[0] : 0;

  } catch (e) { }
  return id;
}
function get_dropdown_name(div_id) {
  id = '';
  try {
    var id = $("#" + div_id).dxDropDownBox("instance").option("text").trim();
    id = id.substr(id.indexOf(' ') + 1);
  } catch (e) { }
  return id;
}
function get_dropdown_ids(div_id, isstring = false) {
  var id = "";
  var ids = "";
  try {
    var id = $("#" + div_id).dxDropDownBox("instance").option("value");
    //if (isstring)
    ids = id.toString();
  } catch (e) { }

  return ids;
}
function get_dropdown_names(div_id) {
  id = '';
  try {
    var id = $("#" + div_id).dxDropDownBox("instance").option("text").trim();
  } catch (e) { }
  return id;
}
/* for ajax based page*/



