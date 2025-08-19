$(() => {
    const grid = $("#permissionsGrid").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/settings/permissions/data",
                key: "id",
            },
        },
        paging: { pageSize: 10 },
        pager: { showPageSizeSelector: true, allowedPageSizes: [10, 25, 50, 100] },
        searchPanel: { visible: true, highlightCaseSensitive: true },
        rowAlternationEnabled: true,
        showBorders: true,
        columns: [
            { dataField: "name", caption: "Name" },
            { dataField: "guard_name", caption: "Slug" },
            {
                caption: "Actions",
                alignment: "center",
                cellTemplate(container, options) {
                    const id = options.data.id;

                    $('<button class="btn btn-sm btn-warning mx-1"><i class="bi bi-pencil"></i></button>')
                        .attr("data-id", id)
                        .on("click", () => loadEdit(id))
                        .appendTo(container);

                    $('<button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>')
                        .attr("data-id", id)
                        .on("click", () => confirmDelete(id))
                        .appendTo(container);
                },
            },
        ]
    }).dxDataGrid("instance");

    // Add Permission
    $("#permissionForm").on("submit", function(e) {
        e.preventDefault();
        $.post({
            url: "/settings/permissions",
            data: $(this).serialize(),
            success(res) {
                if (res.success) {
                    grid.refresh();
                    $("#addPermission").modal("hide");
                    $("#permissionForm")[0].reset();
                }
            }
        });
    });

    // Edit Permission
    function loadEdit(id) {
        $.get(`/settings/permissions/${id}`, function(data) {
            $("#editPermissionId").val(data.id);
            $("#editPermissionName").val(data.name);
            $("#editGuardName").val(data.guard_name);
            $("#editPermission").modal("show");
        });
    }

    $("#editPermissionForm").on("submit", function(e) {
        e.preventDefault();
        const id = $("#editPermissionId").val();
        $.ajax({
            url: `/settings/permissions/${id}`,
            method: "PUT",
            data: $(this).serialize(),
            success(res) {
                if (res.success) {
                    grid.refresh();
                    $("#editPermission").modal("hide");
                }
            }
        });
    });

    // Delete Permission
    let deleteId = null;
    function confirmDelete(id) {
        deleteId = id;
        $("#deletePermission").modal("show");
    }

    $("#confirmDelete").on("click", function() {
        $.ajax({
            url: `/settings/permissions/${deleteId}`,
            method: "DELETE",
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success(res) {
                if (res.success) {
                    grid.refresh();
                    $("#deletePermission").modal("hide");
                }
            }
        });
    });
});
