/**
 * Resize function without multiple trigger
 *
 * Usage:
 * $(window).smartresize(function(){
 *     // code here
 * });
 */
var assistant_id;
(function ($, sr) {
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
        var timeout;

        return function debounced() {
            var obj = this, args = arguments;
            function delayed() {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };
    };

    // smartresize
    jQuery.fn[sr] = function (fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };

})(jQuery, 'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');

// Sidebar
$(document).ready(function () {
    // TODO: This is some kind of easy fix, maybe we can improve this
    var setContentHeight = function () {
        /*
         $RIGHT_COL.css('min-height', $(window).height());

         var bodyHeight = $BODY.outerHeight(),
         footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
         leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
         contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;


         contentHeight -= $NAV_MENU.height() + footerHeight;

         $RIGHT_COL.css('min-height', contentHeight);
         */
    };

    $SIDEBAR_MENU.find('a').on('click', function (ev) {
        var $li = $(this).parent();


        // prevent closing menu if we are on child menu
        if (!$li.parent().is('.child_menu')) {
            $SIDEBAR_MENU.find('li').removeClass('active active-sm');
            $SIDEBAR_MENU.find('li ul').slideUp();
        }

        $li.addClass('active');

        $('ul:first', $li).slideDown(function () {
            setContentHeight();
        });

    });

    // toggle small or large menu
    $MENU_TOGGLE.on('click', function () {
        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide();
            $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
        } else {
            $SIDEBAR_MENU.find('li.active-sm ul').show();
            $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
        }

        $BODY.toggleClass('nav-md nav-sm');

        setContentHeight();
    });

    var page = window.location;
    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

    $SIDEBAR_MENU.find('a').filter(function () {
        return this.href == CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function () {
        setContentHeight();
    }).parent().addClass('active');

    // recompute content when resizing
    $(window).smartresize(function () {
        setContentHeight();
    });

    setContentHeight();

    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel: { preventDefault: true }
        });
    }
});
// /Sidebar

// Panel toolbox
$(document).ready(function () {
    $('.collapse-link').on('click', function () {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function () {
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox

// Tooltip
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
});
// /Tooltip

// Progressbar
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar();
}
// /Progressbar

// Switchery
$(document).ready(function () {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#26B99A'
            });
        });
    }
});
// /Switchery

// iCheck
$(document).ready(function () {
    $('body').delegate('#field-implantador_sectorista_id', 'change', function (evt) {
        attr = {};
        post_data = { sectorista_id: $(this).val() };
        div_id = "entidad_list_input_box";
        call_service(post_data, "management", "sectorista_entidad_ajax", div_id, attr);
    });
    $('ul.child_menu').hide();
});
function load_section_dropdown(class_id) {
    attr = {};
    post_data = { class_id: class_id };
    div_id = "section_dropdown";
    call_service(post_data, "reports", "section_dropdown_ajax", div_id, attr);
}
function load_subject_dropdown(section_id) {
    attr = {};
    post_data = { section_id: section_id };
    div_id = "subject_dropdown";
    call_service(post_data, "reports", "subject_dropdown_ajax", div_id, attr);
}

function load_student_dropdown(section_id) {
    attr = {};
    post_data = { section_id: section_id };
    div_id = "student_dropdown";
    call_service(post_data, "Accounts", "student_dropdown_ajax", div_id, attr);
}

function schedule_add_bind() {
    $("#field-schedule_hour").attr("type", "time");
    $("#schedule_entidad_id_input_box").append("<div id='entity_data_html'></div>");
}

function remote_add_bind() {
    $("#field-assistance_hourstart").attr("type", "time");
    $("#field-assistance_hourfinal").attr("type", "time");
    $("#entity_id_input_box").append("<div id='entity_data_html'></div>");
}
function assistant_add_bind() {
    $("#field-assistance_hourstart").attr("type", "time");
    $("#field-assistance_hourfinal").attr("type", "time");
    $("#assistance_entidad_id_input_box").append("<div id='entity_data_html'></div>");
    $("#assistance_tiposistema_id_input_box").append("<div id='module_data_html'></div>");
}
function entidad_data_ajax_succcess(res) {

    res = JSON.parse(res);
    html = "<b>Coordinates(y,x):</b>" + res['geozone_latitude'] + '/' + res['geozone_longitude'] + ','
        + "<br><b>Codigo de Entidad:</b>" + res['entidad_secejec'] + ','
        + "<br><b>Referencia de la Entidad:</b>" + res['description'] + ','
        + "<br><b>Datos de la Entidad:</b>" + res['entidad_name'];
    $("#entity_data_html").html(html);
    $("#field-assistance_representant_name").val(res['entidad_name_representative']);
    $("#field-assistance_representant_job").val(res['entidad_cargo_representative']);
    $("#field-assistance_representant_phone").val(res['entidad_phone_representative']);
    $("#field-assistance_representant_email").val(res['entidad_email_representative']);
    $("#field-geozone_latitude").val(res['geozone_latitude']);
    $("#field-geozone_longitude").val(res['geozone_longitude']);
    $("#field-geozone_id").val(res['entidad_geozone_id']);
    console.log(res);
}
function show_assistant_popup(html) {
    $("#myModal").modal("show");
    $(".modal-body").html(html);
}
// /iCheck

// Table
$('table input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

var checkState = '';

$('.bulk_action input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
    checkState = 'all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
    checkState = 'none';
    countChecked();
});

function countChecked() {
    if (checkState === 'all') {
        $(".bulk_action input[name='table_records']").iCheck('check');
    }
    if (checkState === 'none') {
        $(".bulk_action input[name='table_records']").iCheck('uncheck');
    }

    var checkCount = $(".bulk_action input[name='table_records']:checked").length;

    if (checkCount) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(checkCount + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}

// Accordion
$(document).ready(function () {
    user_permissions();
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});
function user_permissions(cb) {
    $("#ul_permissions_tab li[id]").each(function (idx, li) {
        if (localStorage.getItem("module")) {
            var permit = JSON.parse(localStorage.getItem("module"))[this.id];
            if (permit == 1) {
                $(this).show();
            }
            else
                $(this).hide();
        }
        else
            $(this).hide();
    });
    if (cb)
        cb();
}
// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
}

makeAsyncDataSource = function (jsonFile) {
    return new DevExpress.data.CustomStore({
        loadMode: "raw",
        key: "ID",
        load: function () {
            return jsonFile;
        }
    });
};

////// Devextreme Functions///////////////////////////
function convertDateTime(str, istime = false) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
    var dateval = date.getFullYear() + "-" + mnth + "-" + day;
    var time =
        date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
    var dateTime = dateval;
    if (istime)
        dateTime = dateTime + " " + time;
    return dateTime;
}
function BindDropdownList(div_id, url, func, selected, is_multiple, post_data = {}, focus_func = null) {
    new_call_service(post_data, url, null, true, function (data) {
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

function BindGrid(div_id, DataList, Columns, Summary, func, remove = false, exported = false, funcdel = null, rowclick_func = null, show_loader = true) {
    DataList = serial_number(DataList);
    Columns.unshift({dataField:'SN', dataType:'number'});
    $("#" + div_id).dxDataGrid({
        dataSource: DataList,
        showColumnLines: true,
        showRowLines: true,
        paging: { enabled: false },
        rowAlternationEnabled: false,
        headerFilter: {
            visible: true
        },
        headerFilter: {
            visible: exported
        },
        groupPanel: {
            visible: exported
        },
        loadPanel: {
            enabled: show_loader
        },
        export: {
            enabled: exported,
            fileName: "Exported Data",
            allowExportSelectedData: exported
        },
        editing: {
            mode: "cell",
            allowUpdating: true,
            allowDeleting: remove,
            texts: {
                deleteRow: 'Remove',
                confirmDeleteMessage: "Are you sure you want to remove"
            }
        },
        onRowUpdating: function (e) {
        },

        onRowUpdated: function (e) {
            if (func) {
                func(e);
            }
        },
        onRowRemoving: function (e) {
            if (funcdel) {
                funcdel(e);
            }
        },
        allowColumnReordering: false,
        allowColumnResizing: true,
        remoteOperations: false,
        wordWrapEnabled: true,
        columnAutoWidth: true,
        scrolling: {
            columnRenderingMode: "virtual"
        },
        columns: Columns,
        summary: Summary,
        showBorders: false,
        onRowClick: function (e) {
            if (e.rowType === "data") {
                var rowdata = e.component.editRow(e.rowIndex);
                if (rowclick_func) {
                    rowclick_func(e);
                }
            }
        }
    });
}
function create_date_box(div, type, format, zoomlevel = "month", func = null, maxdate = "") {
    var date = "";
    if (maxdate == "")
        date = new Date();
    else if (maxdate == "no")
        date = "";
    else
        date = maxdate;

    //var firstday = new Date(date.getFullYear(), date.getMonth(), 1);
    //var lastday = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    $("#" + div).dxDateBox({
        type: type,//"date",
        pickerType: "calendar",
        displayFormat: format,//"MM/yyyy",
        max: date,
        value: date,
        maxZoomLevel: zoomlevel,//"year"
        onValueChanged: function (e) {
            //var previousValue = e.previousValue;
            //var newValue = e.value;
            if (func)
                func(e);
        }
    });
}

function ReportGrid(div_id, DataList, Columns, Summary, option_param = {}) {
    //height = $(window).height() - $('#' + div_id).position().top - 120;
    //$('#' + div_id).css("max-height", height + "px");
    DataList = serial_number(DataList);
    Columns.unshift({dataField:'SN', dataType:'number'});
    
    $("#" + div_id).dxDataGrid({
        dataSource: DataList,
        showColumnLines: true,
        showRowLines: true,

        searchPanel: {
            visible: true,
            width: 240,
            placeholder: "Search..."
        },
        headerFilter: {
            visible: true
        },
        groupPanel: {
            visible: true
        },
        sorting: {
            mode: "multiple"
        },
        loadPanel: {
            enabled: false
        },
        export: {
            enabled: true,
            fileName: "Exported Data"
        },
        paging: { enabled: false },
        rowAlternationEnabled: true,
        allowColumnReordering: true,
        allowColumnResizing: false,
        remoteOperations: false,
        wordWrapEnabled: true,
        columnAutoWidth: true,
        columns: Columns,
        summary: Summary,
        showBorders: false,
        onToolbarPreparing: function (e) {
            var dataGrid = e.component;
            e.toolbarOptions.items.unshift({
                location: "after",
                widget: "dxButton",
                options: {
                    icon: "print",
                    onClick: function () {
                        print_report(div_id, option_param);
                        //sale_report_Print();
                    }
                }
            }/*,{
                location: "after",
                widget: "dxButton",
                options: {
                    icon: "pdffile",
                    onClick: function() {
						pdf_report(div_id,option_param);
                    }
                }
			}*/);
        }
    });
}
function get_dropdown_id(div_id) {
    id = 0;
    try {
        var ddl = $("#" + div_id).dxDropDownBox("instance").option("value");
        id = ddl != null && ddl != "" ? ddl[0] : 0;
    } catch (e) { }
    return id;
}
function get_dropdown_name(div_id) {
    id = '';
    try {
        var id = $("#" + div_id).dxDropDownBox("instance").option("text");
    } catch (e) { }
    return id;
}
function convertDate(str, timestr = true) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
    var dateval = date.getFullYear() + '-' + mnth + '-' + day;
    var time = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
    var dateTime;
    if (timestr)
        dateTime = dateval + ' ' + time;
    else
        dateTime = dateval;
    return dateTime;
}
function current_date() {
    var date = new Date(),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
    var dateval = date.getFullYear() + '-' + mnth + '-' + day;
    return dateval;
}


function get_dropdown_ids(div_id) {
    id = [];
    try {
        var id = $("#" + div_id).dxDropDownBox("instance").option("value");
    } catch (e) { }
    return id;
}
function get_dropdown_names(div_id) {
    id = '';
    try {
        var id = $("#" + div_id).dxDropDownBox("instance").option("text").trim();
    } catch (e) { }
    return id;
}
function get_grid_list(div_id) {
    var rows = $('#' + div_id).dxDataGrid('instance').getVisibleRows();
    var cartdata = [];
    for (var key in rows) {
        if (rows[key].rowType == "data") {
            console.log(rows[key].data);
            cartdata.push(rows[key].data);
        }
    }
    return cartdata;
}
function get_grid_summary(div_id, field) {
    var val = $('#' + div_id).dxDataGrid('instance').getTotalSummaryValue(field);
    val = val ? val : 0;
    return val;
}
function show_model_path(post_data, url, title, func, size_class = null) {
    //modal-xl, modal-lg, modal-sm (def)
    new_call_service(post_data, url, null, null, function (data) {
        show_model(title, data.html);
        if (size_class != null) {
            $(".modal-dialog").addClass(size_class);
        }
        if (func) {
            func(data);
        }
    })
}
function show_model(title, html, size_class = null) {
    //modal-xl, modal-lg, modal-sm (def)
    $("#myModalTitle").html(title);
    $("#myModalBody").html(html);
    if (size_class != null) {
        $(".modal-dialog").addClass(size_class);
    }
    $('#myModal').modal('show');
}
function hide_modal() {
    $("#myModal").modal("hide");
}
////// End Devextreme Functions///////////////////////////
//// dynamic funcstion by sarwar
function grid_cols_and_summerycol(data, hidecol = [], groupcol = [], Summarycols = [], allowEditing = []) {
    var columns = [];
    var group_index = 0;

    for (key in data) {
        if (hidecol.includes(key))
            columns.push({ dataField: key, dataType: "string", allowEditing: false, "visible": false });
        else if (groupcol.includes(key)) {
            columns.push({ dataField: key, dataType: "string", allowEditing: false, "visible": true, groupIndex: group_index });

            Summarycols.push({ column: key, summaryType: "count", displayFormat: "Count: {0}" });
            group_index++;
        }
        else if (allowEditing.includes(key))
            columns.push({ dataField: key, dataType: "string", allowEditing: true });
        else
            columns.push({ dataField: key, dataType: "string", allowEditing: false });

        if (Summarycols.includes(key))
            Summarycols.push({ column: key, summaryType: "sum", displayFormat: "Sum: {0}", "showInGroupFooter": false, "alignByColumn": true });
    }
    Summary = {
        recalculateWhileEditing: true,
        totalItems: Summarycols,
        groupItems: Summarycols,
    };
    var datacol = [];
    datacol["Columns"] = columns;
    datacol["Summary"] = Summary;
    return datacol;
}
function fill_receipt(input_div, output_div, datalist, call_back = null) {
    $("#" + output_div).html("");
    $("#" + input_div).show();
    var inpur_clone = $("#" + input_div).clone();
    $("#" + input_div).hide();
    for (s = 0; s < datalist.length; s++) {
        var data = datalist[s];
        var replica = inpur_clone;
        replica.find("#" + input_div).removeAttr('id');
        //Creating Label
        var all_labels = replica.find('[data-type="receipt-label"]');
        for (i = 0; i < all_labels.length; i++) {
            var ele = all_labels[i];
            console.log(ele.id, data[ele.id]);
            if (ele.id != "" || ele.id != undefined || ele.id != null)
                replica.find("#" + ele.id).text(data[ele.id]);
        }
        //Creating Images
        var all_imgs = replica.find('[data-type="receipt-img-base64"]');
        for (i = 0; i < all_imgs.length; i++) {
            var ele = all_imgs[i];
            if (ele.id != "" || ele.id != undefined || ele.id != null)
                replica.find("#" + ele.id).attr("src", "data:image/jpg;base64," + data[ele.id]);
        }
        //Creating Tables
        var all_table = replica.find('[data-type="receipt-table"]');
        for (i = 0; i < all_table.length; i++) {
            var ele = all_table[i];
            if (ele.id != "" || ele.id != undefined || ele.id != null) {
                var groupcol = $(ele).data("groupcol") == undefined ? [] : $(ele).data("groupcol");
                var hidecol = $(ele).data("hidecol") == undefined ? [] : $(ele).data("hidecol");
                var table_classes = $(ele).data("classes") == undefined ? [] : $(ele).data("classes");
                constructTable(data[ele.id], function (table) {
                    replica.find("#" + ele.id).html(table);
                }, table_classes, hidecol, groupcol);
            }
        }
        //Creating Charts
        var all_charts = replica.find('[data-type="receipt-chart"]');
        for (i = 0; i < all_charts.length; i++) {
            var ele = all_charts[i];
            var id = $(ele).data("chartid");
            allcharsad = $('body').find('[data-chartid]');
            var chart_info = data[id];
            var type = $(ele).data("charttype");
            if (type == "line") {
                replica.find('[data-chartid="' + id + '"]').attr("data-yvalue", JSON.stringify(chart_info["yvalue"]));
                replica.find('[data-chartid="' + id + '"]').attr("data-xvalue", JSON.stringify(chart_info["xvalue"]));
            }
            else if (type == "pie") {
                replica.find('[data-chartid="' + id + '"]').attr("data-values", JSON.stringify(chart_info["values"]));
                replica.find('[data-chartid="' + id + '"]').attr("data-labels", JSON.stringify(chart_info["labels"]));
            }
            replica.find('[data-chartid="' + id + '"]').attr("id", id + "_" + allcharsad.length);
        }
        $('#' + output_div).append(replica.html());
    }
    var charts_count = $('body').find('[data-type="receipt-chart"]');
    for (i = 0; i < charts_count.length; i++) {
        var ele = charts_count[i];
        var div = ele.id;
        constructchart(div);
    }
}
function constructchart(div) {
    if (div == "")
        return;
    var ele = $("#" + div);
    var charttype = $(ele).data("charttype");

    var chartdata = {};
    var chartoptions = {};
    if (charttype == "pie") {
        var Data = $(ele).data("values") == undefined ? [] : $(ele).data("values");
        var lab = $(ele).data("labels") == undefined ? [] : $(ele).data("labels");
        chartdata = {
            datasets: [{
                data: Data,
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"]
            }],
            labels: lab,

        };
        chartoptions = {
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        render: 'label',
                        arc: true,
                        fontColor: '#000',
                        position: 'outside'
                    }
                }
            }
        };
    }
    else if (charttype == "line") {
        var xValues = $(ele).data("xvalue") == undefined ? [] : $(ele).data("xvalue");
        var yValues = $(ele).data("yvalue") == undefined ? [] : $(ele).data("yvalue");
        chartdata = {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: yValues
            }]
        };
        chartoptions = {
            legend: false,
            responsive: true,
            maintainAspectRatio: false
        };
    }
    var ctx = document.getElementById(div).getContext('2d');
    new Chart(ctx, {
        type: charttype,
        data: chartdata,
        options: chartoptions
    });
}
function constructTable(list, callback_done, tableclasses = [], hide_cols = [], grouped_col = []) {
    var create_groups = [];
    var table = $('<table/>');
    if (tableclasses != null) {
        for (var i = 0; i < tableclasses.length; i++)
            table.addClass(tableclasses[i]);
    }
    var tbody = $('<tbody/>');
    var thead = $('<thead/>');
    for (var i = 0; i < list.length; i++) {
        var row = $('<tr/>');
        var tbrow = list[i];
        if (i == 0) {
            for (var key in tbrow) {
                if (grouped_col.includes(key) || hide_cols.includes(key)) { }
                else
                    row.append($('<td/>').html(key));
            }
            thead.append(row);
        }
        else {

            for (var key in tbrow) {
                var val = tbrow[key] == null ? "" : tbrow[key];
                var colspanval = Object.keys(list[0]).length - 1;
                if (hide_cols.includes(key)) { }
                else if (grouped_col.includes(key)) {
                    if (!create_groups.includes(val)) { /// chack grouping
                        tbody.append($('<tr/>').append($('<td/>').attr('colspan', colspanval).attr('class', "text-center").html(val)));
                        create_groups.push(val);
                    }
                }
                else
                    row.append($('<td/>').html(val));
            }
            tbody.append(row);
        }
    }
    table.append(thead);
    table.append(tbody);
    callback_done(table);
}

//// End DYnamic FUnctions By Sarwar
