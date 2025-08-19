$(() => {
    const grid = $("#rolesGrid").dxDataGrid({
        dataSource: {
            load() {
                return $.getJSON('/roleall');
            }
        },
        paging: { pageSize: 10 },
        pager: { showPageSizeSelector: true, allowedPageSizes: [10, 25, 50, 100] },
        searchPanel: { visible: true, highlightCaseSensitive: true },
        rowAlternationEnabled: true,
        showBorders: true,
        columns: [
            { dataField: "name", caption: "Name" },
            { dataField: "guard_name", caption: "Guard Name" },
            {
                caption: "Actions",
                alignment: "center",
                cellTemplate(container, options) {
                    const id = options.data.id;

                    $('<button class="btn btn-sm btn-warning mx-1"><i class="bi bi-pencil"></i></button>')
                        .on("click", () => loadEdit(id))
                        .appendTo(container);

                    $('<button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>')
                        .on("click", () => confirmDelete(id))
                        .appendTo(container);
                },
            },
        ]
    }).dxDataGrid("instance");

    // Add Role
    $("#roleForm").on("submit", function(e) {
        e.preventDefault();
        $.post({
            url: "/settings/role",
            data: $(this).serialize(),
            success(res) {
                if (res.success) {
                    grid.refresh();
                    $("#addRole").modal("hide");
                    $("#roleForm")[0].reset();
                }
            }
        });
    });

    // Edit Role
    function loadEdit(id) {
        $.get(`/settings/role/${id}`, function(data) {
            $("#editRoleId").val(data.id);
            $("#editRoleName").val(data.name);
            $("#editRole").modal("show");
        });
    }

    $("#editRoleForm").on("submit", function(e) {
        e.preventDefault();
        const id = $("#editRoleId").val();
        $.ajax({
            url: `/settings/role/${id}`,
            method: "POST", // Laravel needs POST with _method = PUT
            data: $(this).serialize() + '&_method=PUT',
            success(res) {
                if (res.success) {
                    grid.refresh();
                    $("#editRole").modal("hide");
                }
            }
        });
    });

    // Delete Role
    let deleteId = null;
    function confirmDelete(id) {
        deleteId = id;
        $("#deleteRole").modal("show");
    }

    $("#confirmDeleteRole").on("click", function() {
        $.ajax({
            url: `/settings/role/${deleteId}`,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'DELETE'
            },
            success(res) {
                if (res.success) {
                    grid.refresh();
                    $("#deleteRole").modal("hide");
                }
            }
        });
    });
});
