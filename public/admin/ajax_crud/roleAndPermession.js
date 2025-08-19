$(() => {
    const grid = $("#rolesGrid").dxDataGrid({
        dataSource: {
            load() {
                return $.getJSON('/roleAndPermessionApi');
            }
        },
        paging: { pageSize: 10 },
        pager: { showPageSizeSelector: true, allowedPageSizes: [10, 25, 50, 100] },
        searchPanel: { visible: true, highlightCaseSensitive: true },
        rowAlternationEnabled: true,
        showBorders: true,
        columns: [
             {
                caption: "Select",
                alignment: "center",
                cellTemplate: function(container, options) {
                    $('<div>').addClass('d-flex justify-content-center')
                        .append($('<input>')
                            .attr('type', 'checkbox')
                            .attr('class', 'form-check-input product-checkbox')
                            .attr('data-permession-id', options.data.id)
                        )
                        .appendTo(container);
                }
            },
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

let selectedPermissionIds = [];

// Update selected permissions
function updateSelectedPermissions() {
    selectedPermissionIds = [];
    $('.product-checkbox:checked').each(function() {
        selectedPermissionIds.push($(this).data('permession-id'));
    });

    const hasSelected = selectedPermissionIds.length > 0;
    $('.btn-group .dropdown-toggle').prop('disabled', !hasSelected);

    if (!hasSelected) {
        $('.btn-group .dropdown-toggle').dropdown('hide');
    }
}

$(document).on('change', '.product-checkbox', function() {
    updateSelectedPermissions();
});

// Assign permissions to roles
$('#roleAssignmentForm').on('submit', function(e) {
    e.preventDefault();

    if (selectedPermissionIds.length === 0) {
        toastr.error('Please select at least one permission', 'Error');
        return;
    }

    const selectedRoles = [];
    $('.collection-checkbox:checked').each(function() {
        selectedRoles.push($(this).val());
    });

    if (selectedRoles.length === 0) {
        toastr.error('Please select at least one role', 'Error');
        return;
    }

    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/settings/assign-role',
        type: "POST",
        data: {
            permission_ids: selectedPermissionIds,
            role_ids: selectedRoles,
            _token: csrfToken
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message, 'Success');
                $('.btn-group .dropdown-toggle').dropdown('hide');

                // Reset
                $('.product-checkbox').prop('checked', false);
                $('.collection-checkbox').prop('checked', false);
                selectedPermissionIds = [];
            } else {
                toastr.error(response.message, 'Error');
            }
        },
        error: function(xhr) {
            toastr.error('An error occurred while assigning roles', 'Error');
            console.error(xhr.responseText);
        }
    });
});


