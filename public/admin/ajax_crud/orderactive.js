//Table DevExtream
$(() => {
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/orders/activeJson",
                key: "id",
            },
        },
        paging: {
            pageSize: 10, // Default page size, can be adjusted dynamically
        },
        pager: {
            showPageSizeSelector: true,
            allowedPageSizes: [10, 25, 50, 100], // Allows users to select page size
            showInfo: true, // Optionally, show the page info like "Page 1 of 10"
        },
        remoteOperations: false, // Set to true if your server supports paging
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
            mode: "virtual", // Virtual scrolling, great for large data sets
            useNative: true,
        },
        columns: [
            {
                dataField: "id",
                caption: "Order",
                alignment: "start",
                cellTemplate(container, options) {
                    const orderId = options.data.id;
                    const customerName = options.data.name;
                    const email = options.data.email;
                    $("<div>").html(
                        `<strong>#${orderId} by ${customerName}</strong><br><span> <a href="mailto:${email}?subject=Hello%20There&body=This%20is%20a%20pre-filled%20email!">${email}</a></span>`
                    ).appendTo(container);
                },
            },
            {
                caption: "Actions",
                alignment: "center",
                cellTemplate(container, options) {
                    const id = options.data.id;

                    // Edit Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", `/update-order/${id}`)
                        // .attr("data-bs-toggle", "modal")
                        // .attr("data-bs-userId", id)
                        // .attr("data-bs-target", "#update")
                        .html('<i class="bi bi-pencil-square" style="color: #007bff;"></i>')
                        .appendTo(container);

                    // Show Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", `/coustomer-orders/${id}`)
                        .html('<i class="bi bi-eye" style="color: #28a745;"> Show</i>')
                        .appendTo(container);

                    // Quick Show Button
                    $("<a>")
                    .addClass("btn btn-outline-secondary btn-sm mx-1")
                    .attr("href", "#")
                    .attr("data-bs-toggle", "modal")
                    .attr("data-bs-userId", id) // Add the dynamic user ID to the button
                    .attr("data-bs-target", "#show") // Link to the modal
                    .html('<i class="bi bi-eye" style="color: #28a745;">Quick Show</i>')
                    .appendTo(container); // Append the button to the container element
                

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
                dataField: "shipping_status",
                caption: "Status",
                cellTemplate(container, options) {
                    const status = options.data.shipping_status || 'Unknown';
                    let badgeClass = '';
                    switch (status) {
                        case 'Pending': badgeClass = 'badge-warning'; break;
                        case 'Process': badgeClass = 'badge-primary'; break;
                        case 'Delivered': badgeClass = 'badge-success'; break;
                        case 'Return': badgeClass = 'badge-danger'; break;
                        case 'Complete': badgeClass = 'badge-secondary'; break;
                        default: badgeClass = 'badge-light';
                    }
                    $("<span>").addClass(`badge ${badgeClass}`).text(status).css({
                        padding: '5px 10px',
                        borderRadius: '5px',
                    }).appendTo(container);
                },
            },
            {
                width: 100,
                dataField: "created_at",
                caption: "Order Date",
                alignment: "center",
                dataType: "date",
                format: "dd MMM yyyy",
            },
            {
                width: 120,
                alignment: "center",
                dataField: "phone",
                caption: "Phone",
            },
            {
                alignment: "center",
                dataField: "address",
                caption: "Address",
            },
            {
                width: 80,
                alignment: "center",
                dataField: "city",
                caption: "City",
            },
            {
                width: 80,
                alignment: "center",
                dataField: "subtotal",
                caption: "Sub Total",
            },
            {
                width: 80,
                alignment: "center",
                dataField: "discount",
                caption: "Discount",
            },
            {
                width: 80,
                alignment: "center",
                dataField: "shipping",
                caption: "Shipping",
            },
            {
                width: 80,
                alignment: "center",
                dataField: "grand_total",
                caption: "Amount",
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


// ... (rest of your existing code)


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
            url: "/add-user", //route for create
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
            url: `/add-user/${id}`, // The resource controller update route
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
            url: `/coustomer-orders/${id}`,
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
                    $(".delet-model").click();
                    // Reset the form
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
    var deleteModal = document.getElementById("delete");
    deleteModal.addEventListener("show.bs.modal", function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute("data-bs-userId");
        document.querySelector("#deleteid").value = id;
    });
    // Trigger form submission when the delete button is clicked
    $(document).on("click", ".delete-btn", function () {
        $("#deleteForm").submit();
    });
});
//end of delete code

//show record
var show = document.getElementById("show");

show.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var id = button.getAttribute("data-bs-userId"); // Fetch the order ID from button

    // Fetch order data from the backend
    fetch(`/quick-show/${id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (!data.success || !data.data) {
            console.error("No order data found.");
            return;
        }

        const order = data.data;
        document.getElementById("order-id").textContent = `#${order.id}`;
        document.getElementById("customer-name").textContent = order.name;
        document.getElementById("order-total").textContent = `$${order.grand_total}`;
        document.getElementById("shipping-address").textContent = order.address;
        document.getElementById("order-status").textContent = order.shipping_status;
        document.getElementById("payment-method").textContent = order.payment_method;
        const productTableBody = document.querySelector("#product-table tbody");
        productTableBody.innerHTML = ""; 

        order.items.forEach(item => {
            const firstImage = item.product.images;
            const row = document.createElement("tr");
            const imageUrl = `../images/products/${firstImage}`;
            row.innerHTML = `
            <td><img src="${imageUrl}" alt="${item.product.name}" width="50"></td>
                <td>${item.product.name}</td>
                <td>${item.quantity}</td>
                <td>$${item.price}</td>
                <td>$${(item.quantity * parseFloat(item.price)).toFixed(2)}</td>
            `;

            productTableBody.appendChild(row);
        });
    })
    .catch((error) => {
        console.error("Error fetching order details:", error);
    });
});



//end of show record

//update Record model
var update = document.getElementById("update");
update.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    fetch(`/add-user/${id}`, {
        method: "Get",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            const user = data.user[0];
            document.querySelector("#updateid").value = user.id;
            document.querySelector("#updatename").value = user.name;
            document.querySelector("#updateemail").value = user.email;
            document.querySelector("#updateuser_type").value = user.user_type;
            document.querySelector("#imageshow").src = `/uploads/${user.image}`;
        });
});
//end update Record model

//Delete model

// end of delete model
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000", 
};