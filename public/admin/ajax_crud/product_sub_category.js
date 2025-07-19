//Table DevExtream
$(() => {
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/show_p_sub_cat",
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
                dataField: "product_cat.name", 
                caption: "Category",
                calculateCellValue: function(data) {
                    return data.product_cat ? data.product_cat.name : "";
                }
            },
           // In the DataGrid columns array, add:
{
    dataField: "image",
    caption: "Image",
    cellTemplate: function(container, options) {
        if (options.value) {
            $('<div>')
                .append(
                    $('<img>')
                        .attr('src', '/storage/' + options.value)
                        .css({ width: '50px', height: '50px', 'object-fit': 'cover' })
                )
                .appendTo(container);
        }
    }
},
            {
                caption: "Actions",
                alignment: "center", // Center-align the buttons
                cellTemplate(container, options) {
                    const id = options.data.id;

                    // Edit Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id) //this id is for load dynaimic on model
                        .attr("data-bs-target", "#update")
                        .html(
                            '<i class="bi bi-pencil-square" style="color: #007bff;"></i>'
                        )
                        .appendTo(container);

                    // Delete Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#delete") // Ensure this matches the modal ID
                        .html(
                            '<i class="bi bi-trash" style="color: #dc3545;"></i>'
                        )
                        .appendTo(container);
                },
            },
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
//end of Table DeveExtream

//create record
$(document).ready(function () {
    $("#addform").on("submit", function (e) {
        e.preventDefault();

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const formData = new FormData(this);

        $.ajax({
            url: "/product-sub-cat", //route for create
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.success) {
                    $("#gridContainer").dxDataGrid("instance").refresh();
                    $("#add").modal("hide");

                    $("#addform")[0].reset();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function (response) {
                console.log("Error:", response);
            },
        });
    });
    // edn of create data

    //update code
    $("#updateform").on("submit", function (e) {
        e.preventDefault();

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const id = document.querySelector("#updateid").value;
        const formData = new FormData(this);
        formData.append("_method", "PUT"); // Append the _method to override with PUT

        $.ajax({
            url: `/product-sub-cat/${id}`, // The resource controller update route
            type: "POST", // Still use POST, but we include _method=PUT in the form data
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.success) {
                    // Refresh the DataGrid to reflect the updated record
                    $("#gridContainer").dxDataGrid("instance").refresh();
                    // Hide the modal
                    $("#update").modal("hide");
                    // Reset the form
                    $("#updateform")[0].reset();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function (response) {
                console.log("Error:", response);
            },
        });
    });
    // end of update code

    //delete code
    $("#deleteForm").on("submit", function (e) {
        e.preventDefault();

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const id = document.querySelector("#deleteid").value;
        const formData = new FormData(this);
        formData.append("_method", "DELETE"); // Method override for DELETE

        $.ajax({
            url: `/product-sub-cat/${id}`,
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
});
//end of delete code


//update Record model
update.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    fetch(`/product-sub-cat/${id}`, {
        method: "Get",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            const product = data.product[0];
            document.querySelector("#updateid").value = product.id;
            document.querySelector("#updatename").value = product.name;
            document.querySelector("#product_cat_id").value = product.product_cat_id;
            
            // Display current image if exists
            const imgElement = document.querySelector("#currentImage");
            if (product.image) {
                imgElement.src = '/storage/' + product.image;
                imgElement.style.display = 'block';
            } else {
                imgElement.style.display = 'none';
            }
        });
});
//end update Record model

//Delete model
var deleteModal = document.getElementById("delete");
deleteModal.addEventListener("show.bs.modal", function (event) {  
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    document.querySelector("#deleteid").value = id;
});
// end of delete model
