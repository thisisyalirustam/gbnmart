$(() => {
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/getcollection",
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
                dataField: "image",
                caption: "Image",
                alignment: "center",
                width: 100,
                cellTemplate: profileCellTemplate // reference AFTER it's defined
            },


            {
                dataField: "name",
                caption: "Name",
                alignment: "left",
            },
            {
                dataField: "description",
                caption: "description",
                alignment: "left",
            },
            {
                dataField: "is_active",
                caption: "Status",
                alignment: "center",
                width: 100,
                cellTemplate(container, options) {
                    const isActive = options.data.is_active;
                    $("<span>")
                        .text(isActive ? "Active" : "Inactive")
                        .css({
                            color: isActive ? "green" : "red",
                            fontWeight: "bold",
                        })
                        .appendTo(container);
                },
            },
            {
                dataField: "show_on_front",
                caption: "Show on Front",
                alignment: "center",
                width: 100,
                cellTemplate(container, options) {
                    const showOnFront = options.data.show_on_front;
                    $("<i>")
                        .addClass(showOnFront ? "bi bi-eye-fill" : "bi bi-eye-slash-fill")
                        .css({
                            color: showOnFront ? "blue" : "gray",
                            fontSize: "1.2em",
                        })
                        .appendTo(container);
                },
            },
            {
    dataField: "products_count",
    caption: "Products",
    alignment: "center",
    width: 100,
    cellTemplate(container, options) {
        const count = options.data.products_count;
        const collectionId = options.data.id;

        // Make it clickable
        $("<a>")
            .attr("href", `/collection/${collectionId}/products`)
            .text(count + " Product" + (count !== 1 ? "s" : ""))
            .css({
                color: "#007bff",
                textDecoration: "underline",
                cursor: "pointer"
            })
            .appendTo(container);
    }
},



            {
                caption: "Actions",
                alignment: "center",
                width: 150,
                cellTemplate(container, options) {
                    const id = options.data.id;

                    // Edit Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#update")
                        .html('<i class="bi bi-pencil-square" style="color: #007bff;"></i>')
                        .appendTo(container);

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
        ],
        onContentReady(e) {
            if (!collapsed) {
                collapsed = true;
                e.component.expandRow(["EnviroCare"]);
            }
        },
    });

});
function profileCellTemplate(container, options) {
    const imageUrl = options.data.image;

    if (imageUrl) {
        $("<img>")
            .attr("src", imageUrl)
            .css({
                width: "50px",
                height: "50px",
                borderRadius: "5px",
            })
            .appendTo(container);
    } else {
        container.text("No Image");
    }
}



let collapsed = false;

// Create Record
$(document).ready(function () {
    $("#addform").on("submit", function (e) {
        e.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const formData = new FormData(this);

        $.ajax({
            url: "/collections_store", //route for create
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
                console.log("Error:", response); // Print the error to console
                alert("Error occurred. Check the console for more details.");
            },
        });
    });

    function submitDeleteForm() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const id = document.querySelector("#deleteid").value;

        $.ajax({
            url: `/collections_delete/${id}`,
            type: "DELETE",
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
            error: function (xhr) {
                console.log("Error:", xhr.responseText);
                alert("An error occurred while deleting the record. Please try again.");
            },
        });
    }

});

function submitDeleteForm() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    const id = document.querySelector("#deleteid").value;

    $.ajax({
        url: `/collections_delete/${id}`,
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            if (response.success) {
                $("#gridContainer").dxDataGrid("instance").refresh();
                $("#delete").modal("hide");
                $("#deleteForm")[0].reset();
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr) {
            console.log("Error:", xhr.responseText);
            toastr.error("An error occurred while deleting the record.");
        },
    });
}



$(document).ready(function () {
    // ... existing code ...

    // Delete functionality



    // Update Modal with Prefilled Data
    update.addEventListener("show.bs.modal", function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute("data-bs-userId");

        fetch(`/collections_update/${id}`)
            .then((response) => response.json())
            .then((data) => {
                const collection = data.product[0];
                document.querySelector("#updateid").value = collection.id;
                document.querySelector("#updatename").value = collection.name;
                document.querySelector("#updatedescription").value = collection.description;
                document.querySelector("#updatestatus").value = collection.is_active ? "1" : "0";
                document.querySelector("#updatesof").value = collection.show_on_front ? "1" : "0";

                // 👇 FIXED: Make sure the image path is complete
                if (collection.image) {
                    const preview = document.querySelector("#updateImagePreview");
                    const previewImg = document.querySelector("#updateImagePreviewImg");

                    // If you're storing relative paths like: 'images/collection_img/file.jpg'
                    previewImg.src = '/' + collection.image;

                    // Optional: Add fallback if image doesn't load
                    previewImg.onerror = function () {
                        previewImg.src = '/images/no-image.png'; // fallback image
                    };

                    preview.style.display = "block";
                }
            });
    });


    // Handle form submission for updating the collection
    $("#updateform").on("submit", function (e) {
        e.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const id = document.querySelector("#updateid").value;
        const formData = new FormData(this);

        $.ajax({
            url: `/collections_update/${id}`,
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
                    $("#update").modal("hide");
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (response) {
                console.log("Error:", response);
                toastr.error("Error occurred while updating collection.");
            },
        });
    });

    // Delete Modal Prefill
    var deleteModal = document.getElementById("delete");
    deleteModal.addEventListener("show.bs.modal", function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute("data-bs-userId");
        document.querySelector("#deleteid").value = id;
    });
});



