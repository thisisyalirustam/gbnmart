$(() => {
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/shiping-show",
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
                dataField: "unit.name",
                caption: "Unit",
            },
            {
                dataField: "country.name",
                caption: "Country",
            },
            {
                dataField: "state.name",
                caption: "State",
            },
            {
                dataField: "city.name",
                caption: "City",
            },
            {
                dataField: "charge",
                caption: "Amount",
            },

            {
                dataField: "created_at",
                caption: "Create Date",
                dataType: "date",
                width: 150,

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

                    // Show Button

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
$(document).ready(function (){


    $("#addform").on("submit", function (e) {
        e.preventDefault();

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const formData = new FormData(this);

        $.ajax({
            url: "/shipping", //route for create
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


//update Record model

var update = document.getElementById("update");
update.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var id = button.getAttribute("data-bs-userId"); // Extract the shipping ID from the button's data-bs-userId attribute

    fetch(`/shipping/${id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((response) => response.json())
    .then((data) => {
        console.log(data); // Check the returned data in the console

        const shipping = data.shipping; // Get the shipping data from the response
        
        // Populate the modal form fields
        document.querySelector("#updateid").value = shipping.id; // Set the hidden ID field
        document.querySelector("#update_country_id").value = shipping.country_id; // Set the country
        document.querySelector("#update_state_id").value = shipping.state_id; // Set the state
        document.querySelector("#update_city_id").value = shipping.city_id; // Set the city
        document.querySelector("#update_charge").value = shipping.charge; // Set the shipping charge
        document.querySelector("#update_description").value = shipping.description; // Set the description
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

$("#updateform").on("submit", function (e) {
    e.preventDefault();

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const id = document.querySelector("#updateid").value;
    const formData = new FormData(this);
    formData.append("_method", "PUT"); // Append the _method to override with PUT

    $.ajax({
        url: `/shipping/${id}`, // The resource controller update route
        type: "POST", // Still use POST, but we include _method=PUT in the form data
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {

            $("#gridContainer").dxDataGrid("instance").refresh();
            $(".btn-close").click();
            $("#updateform")[0].reset();
            // Show success toast notification
            toastr.success("Shipping updated successfully!", "Success", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000,
            });
        },
        error: function (response) {
            console.log("Error:", response);

            // Show error toast notification
            toastr.error("An error occurred while updating the product.", "Error", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000,
            });
        },
    });
});

$("#deleteForm").on("submit", function (e) {
    e.preventDefault();

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const id = document.querySelector("#deleteid").value;
    const formData = new FormData(this);
    formData.append("_method", "DELETE"); // Method override for DELETE

    $.ajax({
        url: `/shipping/${id}`,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            if (response.message) {
               
                $("#gridContainer").dxDataGrid("instance").refresh();
                $(".delete-model-disappear").click();
                $("#deleteForm")[0].reset();
                toastr.success(response.message);
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (response) {
            console.log("Error:", response);
        },
    });
});

$(document).on("click", ".delete-btn", function () {
    $("#deleteForm").submit();
});

});
var deleteModal = document.getElementById("delete");
deleteModal.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    document.querySelector("#deleteid").value = id;
});
