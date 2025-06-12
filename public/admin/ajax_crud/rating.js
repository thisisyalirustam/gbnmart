//Table DevExtream
$(() => {
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/orders/rating",
                key: "id",
            },
        },
        paging: {
            pageSize: 10,
        },
        pager: {
            showPageSizeSelector: true,
            allowedPageSizes: [10, 25, 50, 100],
            showInfo: true,
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
        columnAutoWidth: true,
        scrolling: {
            mode: "virtual",
            useNative: true,
        },
        columns: [
            {
                caption: "Actions",
                alignment: "center",
                cellTemplate(container, options) {
                    const id = options.data.id;

                    // Edit Button
                    // Delete Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#delete")
                        .html('<i class="bi bi-trash" style="color: #dc3545;"></i>')
                        .appendTo(container);
                },
            },
            {
                width: 80,
                alignment: "center",
                dataField: "status",
                caption: "Status",
                cellTemplate(container, options) {
                    const status = options.data.status;
                    let statusText = '';
                    let buttonClass = '';

                    // Set initial button text and class based on the status
                    if (status === 0) {
                        statusText = "Pending";
                        buttonClass = "btn-warning";  // Yellow button for pending
                    } else if (status === 1) {
                        statusText = "Active";
                        buttonClass = "btn-success";  // Green button for active
                    }
                    const button = $("<button>")
                        .addClass(`btn ${buttonClass} btn-sm`)
                        .text(statusText)
                        .on("click", function () {
                            const newStatus = status === 0 ? 1 : 0;  // Toggle between 0 and 1
                            $.ajax({
                                url: `/update-status/${options.data.id}`,  // Assuming you pass the ID for the order
                                method: "PATCH",  // Use PATCH for partial update
                                data: {
                                    status: newStatus,  // Send the new toggled status
                                    _token: $('meta[name="csrf-token"]').attr('content')  // Include CSRF token for security
                                },
                                success: function (response) {
                                    if (response.status) {
                                        // Update the button text and class after a successful update
                                        button.text(response.newStatusText);
                                        button.removeClass().addClass(`btn ${response.newButtonClass} btn-sm`);
                                    } else {
                                        alert("Error updating status");
                                    }
                                },
                                error: function () {
                                    alert("Error connecting to the server");
                                }
                            });
                        })
                        .appendTo(container);
                },
            },
            {
                width: 120,
                alignment: "left",
                dataField: "rating",
                caption: "Rating",
                cellTemplate(container, options) {
                    const rating = options.data.rating || 0;
                    const fullStars = Math.floor(rating);
                    const emptyStars = 5 - fullStars;

                    // Create the stars
                    const starContainer = $("<div>").addClass("star-rating");

                    // Full stars (yellow)
                    for (let i = 0; i < fullStars; i++) {
                        $("<i>")
                            .addClass("bi bi-star-fill text-warning")
                            .appendTo(starContainer);
                    }

                    // Empty stars (gray/white)
                    for (let i = 0; i < emptyStars; i++) {
                        $("<i>")
                            .addClass("bi bi-star text-muted")
                            .appendTo(starContainer);
                    }

                    starContainer.appendTo(container);
                },
            },
            {
                alignment: "left",
                dataField: "review",
                caption: "Review",
            },

            {
                width: 120,
                alignment: "left",
                dataField: "order_item_id", // Use order_item_id to access related order and product
                caption: "Customer",
                cellTemplate(container, options) {
                    // Access the related order data (buyer name)
                    const buyerName = options.data.order_item?.order?.name || "Unknown Buyer";

                    // Display the buyer name in the cell
                    $("<span>").text(buyerName).appendTo(container);
                },
            },
            {
                width: 120,
                alignment: "left",
                dataField: "order_item_id", // Use order_item_id to access related order and product
                caption: "Product",
                cellTemplate(container, options) {
                    // Access the related product data (product name)
                    const productName = options.data.order_item?.product?.name || "Unknown Product";

                    // Display the product name in the cell
                    $("<span>").text(productName).appendTo(container);
                },
            }
        ],
        onContentReady(e) {
            if (!collapsed) {
                collapsed = true;
                e.component.expandRow(["EnviroCare"]);
            }
        },
    });
});

let collapsed = false;


//show record
$("#deleteForm").on("submit", function (e) {
    e.preventDefault();

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const id = document.querySelector("#deleteid").value;
    const formData = new FormData(this);
    formData.append("_method", "DELETE"); // Method override for DELETE

    $.ajax({
        url: `/delete-order/${id}`,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            if (response.success) {
                // Refresh the DataGrid to reflect the deleted record
                $("#gridContainer").dxDataGrid("instance").refresh();
                // Hide the modal
                $("#delete").modal("hide");
                // Reset the form
                $("#deleteForm")[0].reset();
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (response) {
            console.log("Error:", response);
        },
    });
});

// Trigger form submission when the delete button is clicked
$(document).on("click", ".delete-btn", function () {
    $("#deleteForm").submit();
});
//end update Record model
var deleteModal = document.getElementById("delete");
deleteModal.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    document.querySelector("#deleteid").value = id;
});

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000",
};