
function AlertMsg(data, type, timedelay) {
    if (type == "danger")
        $("#alertType").text("Error! ");
    else
        $("#alertType").text("Success! ");

    $("#alertdata").html(`<span>${data}</span>`);

    $('#AlertMessage').removeAttr('class').attr('class', '');
    $("#AlertMessage").addClass("alert alert-" + type);
    $("#AlertMessage").show().delay(timedelay).fadeOut();
}

makeAsyncDataSource = function (jsonFile) {
    return new DevExpress.data.CustomStore({
        loadMode: "raw",
        key: "id",
        load: function () {
            return jsonFile;
        }
    });
};

function new_call_service(post_data, url, div_id, loader, func, async = true) {
    var base_path = $("#base_path").val(); // getting base path of site
    $.ajax({
        url: base_path + url, // URL of the web service
        type: 'POST',
        dataType: "json",
        async: async,
        data: post_data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
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
            // console.log(JSON.stringify(jqXHR) + " : " + textStatus + " : " + errorThrown);

            alert("service called function failed url:" + url + ", post data:" + JSON.stringify(post_data) + ", Error: " + errorThrown);
        }
    });
}

function BindDropdown(div_id, url, func, selected, is_multiple, post_data = {}, focus_func = null) {
    new_call_service(post_data, url, null, true, function (data) {
        selection_mode = is_multiple == true ? "multiple" : "single";
        $("#" + div_id).dxDropDownBox({
            value: selected,
            valueExpr: "id",
            deferRendering: false,
            placeholder: "Select",
            displayExpr: function (item) {
                return item && " (" + item.id + ") " + item.name;
            },
            showClearButton: true,
            dataSource: makeAsyncDataSource(JSON.parse(JSON.stringify(data))),
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
                        scrolling: {
                            mode: "infinite"
                        },
                        height: "100%",
                        selection: {
                            mode: selection_mode
                        },
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

function execute_js(data) {
    if (data) {
        $(".execute_js_box").removeData().empty().html(data);
    }
}

function show_progress(percent, text) {
    percent = parseInt(percent * 100);
    // console.log(percent, text);
    $(".progress_bar").text(percent + "% " + text);
    $('.progress_bar').css({
        width: percent + '%'
    });
}

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


function call_service(post_data, file_name, method, div_id, attr, loader = false) {
    $('.formError').remove();
    var base_path = $("#base_path").val(); // getting base path of site
    $.ajax({
        url: base_path + file_name, // URL of the web service
        type: 'post',
        data: post_data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
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

function call_service_with_custom_error(post_data, file_name, method, div_id, attr, loader = false, grid = null) {
    $('.formError').remove();
    var base_path = $("#base_path").val(); // getting base path of site

    $.ajax({
        url: base_path + file_name, // URL of the web service
        type: 'post',
        data: post_data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
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
            var resError = JSON.parse(data);

            if (resError['status'] != 'undefined') {
                if (resError['status'] == 'success') {
                    AlertMsg(resError['message'], 'success', 3000);
                } else if (resError['status'] == 'fail') {
                    var errorMessage = '';
                    $.each(resError['error'], function (index, error) {
                        errorMessage += error + '\n';
                        console.log('error: ' + error);
                        console.log('index: ' + index);
                    });
                    console.log(errorMessage);
                    AlertMsg(errorMessage + '. Operation unsuccessful', 'danger', 3000);
                }
            }

            if (div_id && data) { // check if there is any response id mentioned in call service
                $('#' + div_id).removeData();
                $('#' + div_id).html(data).fadeIn('slow');
            } else if (data) { // if not reponse id, then we should have some js to execute.
                execute_js(data); // this function to execute js script return by view using ajax. (for example: trigger message div to show message.)
            }
            if (attr['func']) {
                attr['func'](data); // calling a dynamic function in variable func
            }

            if (grid) {
                grid.refresh();
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

function BindGrid(div_id, DataList, Columns, Summary, func, remove = false, exported = true, funcdel = null, rowclick_func = null, show_loader = true) {
    DataList = serial_number(DataList);
    Columns.unshift({ dataField: 'SN', dataType: 'number' });
    $("#" + div_id).dxDataGrid({
        dataSource: DataList,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: false,
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
            formats: ['xlsx', 'pdf', 'print'],
            fileName: "Exported Data"
        },
        onExporting(e) {
            if (e.format === 'xlsx') {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet('Companies');
                DevExpress.excelExporter.exportDataGrid({
                    component: e.component,
                    worksheet,
                    autoFilterEnabled: true,
                }).then(() => {
                    workbook.xlsx.writeBuffer().then((buffer) => {
                        saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'data.xlsx');
                    });
                });
            }
            else if (e.format === 'pdf') {
                window.jsPDF = window.jspdf.jsPDF;
                const doc = new jsPDF();
                DevExpress.pdfExporter.exportDataGrid({
                    jsPDFDocument: doc,
                    component: e.component,
                }).then(() => {
                    doc.save('data.pdf');
                });
            } else if (e.format === 'print') {
                print_report(div_id);
            }
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
        paging: { enabled: false },
        rowAlternationEnabled: true,
        allowColumnReordering: true,
        allowColumnResizing: false,
        remoteOperations: false,
        wordWrapEnabled: true,
        columnAutoWidth: true,
        columns: Columns,
        summary: Summary,
        showBorders: true
    });
}

function BindGridSimple(div_id, DataList, Columns, Summary, func, remove = false, exported = true, funcdel = null, rowclick_func = null, show_loader = true) {
    DataList = serial_number(DataList);
    Columns.unshift({ dataField: 'SN', dataType: 'number' });
    $("#" + div_id).dxDataGrid({
        dataSource: DataList,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: false,

        sorting: {
            mode: "multiple"
        },
        loadPanel: {
            enabled: false
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
        paging: { enabled: false },
        rowAlternationEnabled: true,
        allowColumnReordering: true,
        allowColumnResizing: false,
        remoteOperations: false,
        wordWrapEnabled: true,
        columnAutoWidth: true,
        columns: Columns,
        summary: Summary,
        showBorders: true
    });
}


function BindGridMultiple(div_id, DataList, Columns, Summary, func, remove = false, exported = true, funcdel = null, rowclick_func = null, show_loader = true) {
    DataList = serial_number(DataList);
    Columns.unshift({ dataField: 'SN', dataType: 'number' });
    $("#" + div_id).dxDataGrid({
        dataSource: DataList,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: false,
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
            formats: ['xlsx', 'pdf', 'print'],
            fileName: "Exported Data"
        },
        onExporting(e) {
            if (e.format === 'xlsx') {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet('Companies');
                DevExpress.excelExporter.exportDataGrid({
                    component: e.component,
                    worksheet,
                    autoFilterEnabled: true,
                }).then(() => {
                    workbook.xlsx.writeBuffer().then((buffer) => {
                        saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'data.xlsx');
                    });
                });
            }
            else if (e.format === 'pdf') {
                window.jsPDF = window.jspdf.jsPDF;
                const doc = new jsPDF();
                DevExpress.pdfExporter.exportDataGrid({
                    jsPDFDocument: doc,
                    component: e.component,
                }).then(() => {
                    doc.save('data.pdf');
                });
            } else if (e.format === 'print') {
                print_report(div_id);
            }
        },
        // editing: {
        //     mode: "batch",
        //     allowUpdating: true,
        //     allowDeleting: remove,
        //     texts: {
        //         deleteRow: 'Remove',
        //         confirmDeleteMessage: "Are you sure you want to remove"
        //     }
        // },
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
        selection: {
            mode: 'multiple',
            showCheckBoxesMode: 'always'
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
        showBorders: true
    });
}

function BindGridRow(div_id, DataList, Columns, Summary, func, remove = false, exported = true, funcdel = null, rowclick_func = null, show_loader = true) {

    $("#" + div_id).dxDataGrid({
        dataSource: DataList,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: false,
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
            formats: ['xlsx', 'pdf', 'print'],
            fileName: "Exported Data"
        },
        onExporting(e) {
            if (e.format === 'xlsx') {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet('Companies');
                DevExpress.excelExporter.exportDataGrid({
                    component: e.component,
                    worksheet,
                    autoFilterEnabled: true,
                }).then(() => {
                    workbook.xlsx.writeBuffer().then((buffer) => {
                        saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'data.xlsx');
                    });
                });
            }
            else if (e.format === 'pdf') {
                window.jsPDF = window.jspdf.jsPDF;
                const doc = new jsPDF();
                DevExpress.pdfExporter.exportDataGrid({
                    jsPDFDocument: doc,
                    component: e.component,
                }).then(() => {
                    doc.save('data.pdf');
                });
            } else if (e.format === 'print') {
                print_report(div_id);
            }
        },
        editing: {
            mode: "row",
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
        paging: { enabled: false },
        rowAlternationEnabled: true,
        allowColumnReordering: true,
        allowColumnResizing: false,
        remoteOperations: false,
        wordWrapEnabled: true,
        columnAutoWidth: true,
        columns: Columns,
        summary: Summary,
        showBorders: true
    });
}

function BindGridCURD(div_id, DataList, Columns, Summary, update = true, func, remove = false, exported = false, funcdel = null, rowclick_func = null, show_loader = true, add = false, funcinsert = null, funcUpdate = null) {
    $("#" + div_id).dxDataGrid({
        dataSource: DataList,
        showColumnLines: true,
        showRowLines: true,
        paging: { enabled: false },
        rowAlternationEnabled: false,
        headerFilter: {
            visible: true
        },
        groupPanel: {
            visible: true
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
            mode: "row",
            allowAdding: add,
            allowUpdating: update,
            allowDeleting: remove,
            texts: {
                deleteRow: 'Remove',
                confirmDeleteMessage: "Are you sure you want to remove"
            }
        },
        onRowUpdating: function (e) {
            if (funcUpdate) {
                funcUpdate(e);
            }
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
        onRowInserted: function (e) {
            if (funcinsert) {
                funcinsert(e);
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
    });
}

function ajaxFunc(url, formData) {
    var base_path = $("#base_path").val(); // getting base path of site
    $.ajax({
        url: base_path + url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Set content type to false as FormData will handle it
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        cache: false,
        success: function (response) {
            if (response && response.message) {
                AlertMsg(response.message, 'success', 3000);
            }
        },
        error: function (xhr, status, error) {
            // Handle error response
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                // Validation errors received
                var errors = xhr.responseJSON.errors;
                var errorMessage = "Validation errors:\n";
                for (var key in errors) {
                    errorMessage += "- " + errors[key] + "\n";
                }
                // Display error message
                AlertMsg(errorMessage, 'danger', 3000);
            } else {
                // Other types of errors
                AlertMsg("An error occurred while processing the request.", 'danger', 3000);
            }
        }
    });
}
