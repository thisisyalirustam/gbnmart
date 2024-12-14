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
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    fetch(`/shipping/${id}`, {
        method: "Get",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            const user = data.shipping[0];
            document.querySelector("#updateid").value = user.id;
            document.querySelector("#country_id").value = shipping.country_id;
            document.querySelector("#updateemail").value = shipping.state_id;
            document.querySelector("#updateuser_type").value = shipping.city_id;
            document.querySelector("#update_charge").value = shipping.charge;
            document.querySelector("#updateuser_type").value = shipping.description;

        });
});




//end update Record model


});
