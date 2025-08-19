$(document).ready(function() {
    // Table DevExtreme Configuration
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/user-management",
                key: "id",
            },
        },
        paging: {
            pageSize: 10,
        },
        pager: {
            showPageSizeSelector: true,
            allowedPageSizes: [10, 25, 50, 100],
        },
        remoteOperations: false,
        searchPanel: {
            visible: true,
            highlightCaseSensitive: true,
        },
        groupPanel: { visible: true },
        grouping: {
            autoExpandAll: false,
        },
        allowColumnReordering: true,
        rowAlternationEnabled: true,
        showBorders: true,
        width: "100%",
        columns: [
            {
                dataField: "name",
                caption: "Name",
            },
            {
                dataField: "email",
                caption: "Email",
            },
            {
                dataField: "user_type",
                caption: "User Type",
            },
            {
                dataField: "role_names",
                caption: "Current Roles",
                width: 200
            },
            {
                dataField: "image",
                caption: "Profile",
                dataType: "string",
                width: 150,
                cellTemplate: function(container, options) {
                    $("<div/>")
                        .append(
                            $("<img>", {
                                src: options.value,
                                css: {
                                    borderRadius: "50%",
                                    width: "50px",
                                    height: "50px",
                                    marginRight: "10px",
                                },
                            })
                        )
                        .appendTo(container);
                }
            },
            {
                caption: "Actions",
                alignment: "center",
                cellTemplate: function(container, options) {
                    const id = options.data.id;
                    
                    // Assign Roles Button
                    $("<button>")
                        .addClass("btn btn-primary btn-sm")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-target", "#assignRolesModal")
                        .attr("data-user-id", id)
                        .html('<i class="bi bi-person-gear"></i> Assign Roles')
                        .appendTo(container);
                }
            }
        ],
        onContentReady: function(e) {
            if (!window.gridCollapsed) {
                window.gridCollapsed = true;
                e.component.expandRow(["EnviroCare"]);
            }
        }
    });

    // Assign Roles Modal Handling
    const assignRolesModal = document.getElementById('assignRolesModal');
    
    assignRolesModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-user-id');
        
        // Show loading state
        const modal = $(this);
        modal.find('.modal-body').html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading user data...</p>
            </div>
        `);
        
        // Fetch user data with roles
        fetch(`/user/${userId}/roles`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Populate modal content
            modal.find('.modal-body').html(`
                <div class="text-center mb-3">
                    ${data.user_image ? 
                        `<img src="${data.user_image}" alt="User Image" class="rounded-circle" width="80" height="80">` : 
                        '<div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">' +
                        '<i class="bi bi-person-fill text-white" style="font-size: 2rem;"></i></div>'}
                    <h5 class="mt-2">${data.user.name}</h5>
                    <p class="text-muted">${data.user.email}</p>
                </div>
                
                <form id="assignRolesForm">
                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                    <h6 class="mb-3">Select Roles:</h6>
                    <div id="rolesContainer" class="mb-3" style="max-height: 300px; overflow-y: auto;"></div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            `);
            
            // Populate roles checkboxes
            const rolesContainer = modal.find('#rolesContainer');
            data.all_roles.forEach(role => {
                const isChecked = data.user.roles.some(r => r.id === role.id);
                
                rolesContainer.append(`
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="roles[]" 
                               value="${role.id}" id="role-${role.id}" ${isChecked ? 'checked' : ''}>
                        <label class="form-check-label" for="role-${role.id}">
                            ${role.name}
                            ${role.description ? `<small class="text-muted d-block">${role.description}</small>` : ''}
                        </label>
                    </div>
                `);
            });
            
            // Handle form submission
modal.find('#assignRolesForm').on('submit', function(e) {
    e.preventDefault();
    
    const submitButton = modal.find('button[type="submit"]');
    submitButton.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Saving...
    `);
    
    // Get selected role IDs
    const roleIds = [];
    $(this).find('input[name="roles[]"]:checked').each(function() {
        roleIds.push($(this).val());
    });
    
    fetch(`/user/${userId}/assign-roles`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            roles: roleIds
        })
    })
    .then(async response => {
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Failed to update roles');
        }
        
        return data;
    })
    .then(data => {
        toastr.success(data.message || 'Roles updated successfully');
        $('#gridContainer').dxDataGrid('instance').refresh();
        bootstrap.Modal.getInstance(assignRolesModal).hide();
    })
    .catch(error => {
        console.error('Error details:', error);
        toastr.error(error.message || 'An error occurred while updating roles');
    })
    .finally(() => {
        submitButton.prop('disabled', false).text('Save Changes');
    });
});
        })
        .catch(error => {
            modal.find('.modal-body').html(`
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i> 
                    Failed to load user data. Please try again.
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            `);
            console.error('Error fetching user roles:', error);
        });
    });
    
    // Initialize Toastr for notifications
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
});