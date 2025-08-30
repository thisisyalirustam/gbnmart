$(document).ready(function () {
    // DataGrid
    $("#rolesGrid").dxDataGrid({
        dataSource: {
            store: {
                type: "array",
                key: "id",
                data: rolesData
            }
        },
        paging: { pageSize: 10 },
        pager: { showPageSizeSelector: true, allowedPageSizes: [10, 25, 50, 100] },
        searchPanel: { visible: true, highlightCaseSensitive: true },
        rowAlternationEnabled: true,
        showBorders: true,
        columns: [
            { dataField: "name", caption: "Role Name" },
            {
                dataField: "permissions",
                caption: "Assigned Permissions",
                calculateCellValue: function (data) {
                    return data.permissions.map(p => p.name).join(", ");
                }
            },
            {
                caption: "Actions",
                alignment: "center",
                cellTemplate: function (container, options) {
                    const id = options.data.id;
                    $("<button>")
                        .addClass("btn btn-primary btn-sm")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-target", "#assignPermissionsModal")
                        .attr("data-role-id", id)
                        .html('<i class="bi bi-shield-lock"></i> Edit Permissions')
                        .appendTo(container);
                }
            }
        ]
    });

    // Assign Permissions Modal
    const assignPermissionsModal = document.getElementById('assignPermissionsModal');
    assignPermissionsModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const roleId = button.getAttribute('data-role-id');
        const modal = $(this);

        modal.find('.modal-body').html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <p>Loading permissions...</p>
            </div>
        `);

        // Fetch role + all permissions
        fetch(`/role/${roleId}/permissions`, {
            headers: { 'Accept': 'application/json' }
        })
            .then(res => res.json())
            .then(data => {
                modal.find('.modal-body').html(`
                    <h6>${data.role.name}</h6>
                    <form id="assignPermissionsForm">
                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                        <div id="permissionsContainer" style="max-height: 300px; overflow-y:auto;"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                `);

                const container = modal.find('#permissionsContainer');
                data.all_permissions.forEach(perm => {
                    const checked = data.role.permissions.some(p => p.id === perm.id) ? 'checked' : '';
                    container.append(`
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="permissions[]" 
                                value="${perm.id}" id="perm-${perm.id}" ${checked}>
                            <label class="form-check-label" for="perm-${perm.id}">${perm.name}</label>
                        </div>
                    `);
                });

                // Submit handler
                modal.find('#assignPermissionsForm').on('submit', function (e) {
                    e.preventDefault();
                    const permIds = [];
                    $(this).find('input[name="permissions[]"]:checked').each(function () {
                        permIds.push($(this).val());
                    });

                    fetch(`/role/${roleId}/assign-permissions`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        body: JSON.stringify({ permissions: permIds })
                    })
                        .then(res => res.json())
                        .then(resp => {
                            toastr.success(resp.message);
                            $('#rolesGrid').dxDataGrid('instance').refresh();
                            bootstrap.Modal.getInstance(assignPermissionsModal).hide();
                        })
                        .catch(err => toastr.error("Failed to update permissions"));
                });
            })
            .catch(() => {
                modal.find('.modal-body').html(`<div class="alert alert-danger">Failed to load permissions</div>`);
            });
    });
});
