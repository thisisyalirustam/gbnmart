//Table DevExtream
$(() => {
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/orders",
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
        columnAutoWidth: true, // Automatically adjusts column widths
        scrolling: {
            mode: "virtual", // Enables virtual scrolling
            useNative: true,
        },
        columns: [
            {
                dataField: "id",
                caption: "Order",
                alignment: "start",
                cellTemplate(container, options) {
                    const orderId = options.data.id;
                    const customerName = options.data.name; // Assuming the data source contains a 'name' field
                    const email = options.data.email;

                    $("<div>")
                        .html(
                            `<strong>#${orderId} by ${customerName}</strong><br><span> <a href="mailto:${email}?subject=Hello%20There&body=This%20is%20a%20pre-filled%20email!">${email}</a></span>`
                        )
                        .appendTo(container);
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
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#update")
                        .html(
                            '<i class="bi bi-pencil-square" style="color: #007bff;"></i>'
                        )
                        .appendTo(container);

                    // Show Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", `/coustomer-orders/${id}`) // Redirect to show route
                        .html('<i class="bi bi-eye" style="color: #28a745;"> Show</i>')
                        .appendTo(container);

                    // Quick Show Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#show")
                        .html(
                            '<i class="bi bi-eye" style="color: #28a745;">Quick Show</i>'
                        )
                        .appendTo(container);

                    // Delete Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#delete")
                        .html(
                            '<i class="bi bi-trash" style="color: #dc3545;"></i>'
                        )
                        .appendTo(container);
                },
            },
            {
                width: 80,
                alignment: "center",
                dataField: "shipping_status",
                caption: "Status",
                cellTemplate(container, options) {
                    const status = options.data.shipping_status || 'Unknown'; // Default to 'Unknown' if undefined
                    let badgeClass = '';

                    // Determine the badge class based on shipping status
                    switch (status) {
                        case 'Pending':
                            badgeClass = 'badge-warning'; // No 'badge' prefix needed
                            break;
                        case 'Process':
                            badgeClass = 'badge-primary';
                            break;
                        case 'Delivered':
                            badgeClass = 'badge-success';
                            break;
                        case 'Return':
                            badgeClass = 'badge-danger';
                            break;
                        case 'Complete':
                            badgeClass = 'badge-secondary';
                            break;
                        default:
                            badgeClass = 'badge-light';
                    }

                    // Create the badge element
                    const badge = $("<span>")
                        .addClass(`badge ${badgeClass}`) // Include the 'badge' class here
                        .text(status)
                        .css({
                            padding: '5px 10px',
                            borderRadius: '5px',
                            display: 'inline-block', // Ensures the badge displays inline
                        });

                    // Append the badge to the container
                    badge.appendTo(container);
                },
            },
            {
                width: 100,
                dataField: "created_at",
                caption: "Order Date",
                alignment: "center",
                dataType: "date",
                format: "dd MMM yyyy", // Formats the date as "25 Nov 2024"
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
            url: `/add-user/${id}`,
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

//show record
var show = document.getElementById("show");
show.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    fetch(`/coustomer-orders/${id}`, {
        method: "Get",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            const user = data.user[0];
            const modelbody = document.querySelector("#show .modal-body");
            modelbody.innerHTML = "";
            modelbody.innerHTML = `

              <div class="row">
                  <div class="col-xl-4">

                      <div class="card">
                          <div
                              class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                              <img src="http://127.0.0.1:8000/uploads/${user.image}"
                                  alt="Profile" class="rounded-circle"
                                  style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                              <h2>${user.name}</h2>
                              <h3>Web Designer</h3>
                              <div class="social-links mt-2">
                                  <a href="#" class="twitter"><i
                                          class="bi bi-twitter"></i></a>
                                  <a href="#" class="facebook"><i
                                          class="bi bi-facebook"></i></a>
                                  <a href="#" class="instagram"><i
                                          class="bi bi-instagram"></i></a>
                                  <a href="#" class="linkedin"><i
                                          class="bi bi-linkedin"></i></a>
                              </div>
                          </div>
                      </div>

                  </div>

                  <div class="col-xl-8">

                      <div class="card">
                          <div class="card-body pt-3">
                              <div class="tab-content pt-2">

                                  <div class="tab-pane fade show active profile-overview"
                                      id="profile-overview" role="tabpanel">
                                      <h5 class="card-title">About</h5>
                                      <p class="small fst-italic">Sunt est soluta
                                          temporibus accusantium neque nam
                                          maiores cumque temporibus. Tempora libero
                                          non est unde veniam est qui dolor.
                                          Ut sunt iure rerum quae quisquam autem
                                          eveniet perspiciatis odit. Fuga sequi
                                          sed ea saepe at unde.</p>

                                      <h5 class="card-title">Profile Details</h5>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-4 label ">Full
                                              Name</div>
                                          <div class="col-lg-9 col-md-8">Kevin
                                              Anderson</div>
                                      </div>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-4 label">
                                              Company</div>
                                          <div class="col-lg-9 col-md-8">Lueilwitz,
                                              Wisoky and Leuschke</div>
                                      </div>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-4 label">Job
                                          </div>
                                          <div class="col-lg-9 col-md-8">Web Designer
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-4 label">
                                              Country</div>
                                          <div class="col-lg-9 col-md-8">USA</div>
                                      </div>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-4 label">
                                              Address</div>
                                          <div class="col-lg-9 col-md-8">A108 Adam
                                              Street, New York, NY 535022</div>
                                      </div>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-4 label">Phone
                                          </div>
                                          <div class="col-lg-9 col-md-8">(436)
                                              486-3538 x29071</div>
                                      </div>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-4 label">Email
                                          </div>
                                          <div class="col-lg-9 col-md-8">
                                              k.anderson@example.com</div>
                                      </div>

                                  </div>
                              </div><!-- End Bordered Tabs -->

                          </div>
                      </div>

                  </div>
              </div>

`;
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
var deleteModal = document.getElementById("delete");
deleteModal.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    document.querySelector("#deleteid").value = id;
});
// end of delete model
