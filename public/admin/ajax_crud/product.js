//Table DevExtream
$(() => {
    $("#gridContainer").dxDataGrid({
        dataSource: {
            store: {
                type: "odata",
                version: 2,
                url: "/show_product",
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
                dataField: "image",
                caption: "Image",
                alignment: "center",
                dataType: "string",
                width: 100,
                cellTemplate: profileCellTemplate // Reference the function here
            },
            {
                dataField: "name",
                caption: "Name Product",


            },
            {
                dataField: "product_cat.name", // Accessing nested category name
                caption: "Category Name",
            },
            {
                dataField: "product_sub_category.name", // Accessing nested sub-category name
                caption: "Sub-Category Name",
            },
            {
                dataField: "product_brand.name", // Accessing nested brand name
                caption: "Brand Name",
            },
            {
                dataField: "user.name", // Accessing nested user name
                caption: "User Name",
            },

            {
                dataField: "stock_quantity",
                caption: "Stock",
                width: 80,
                alignment: "center",
            },
            {
                dataField: "price",
                caption: "Price",
                width: 80,
                alignment: "center",
            },
            {
                dataField: "discounted_price",
                caption: "Discount Price",
                width: 80,
                alignment: "center",
            },
            {
                dataField: "weight",
                caption: "Weight",
                width: 80,
                alignment: "center",
            },
            {
                dataField: "dimensions",
                caption: "Dimensions",
                width: 80,
                alignment: "center",
            },

            {
                dataField: "status",
                caption: "Status",
                alignment: "center",
                width: 110,
                cellTemplate: function(container, options) {
                    let buttonClass = 'btn-outline-secondary'; // Default class
                    let iconClass = 'bi bi-pencil-square'; // Default icon
                    if (options.data.status === 'active') {
                        buttonClass = 'btn-success';
                        iconClass = 'bi bi-check-circle';
                    } else if (options.data.status === 'pending') {
                        buttonClass = 'btn-warning';
                        iconClass = 'bi bi-exclamation-circle';
                    } else if (options.data.status === 'suspend') {
                        buttonClass = 'btn-danger';
                        iconClass = 'bi bi-x-circle';
                    } else if (options.data.status === 'blocked') {
                        buttonClass = 'btn-dark';
                        iconClass = 'bi bi-block';
                    }
                    $("<button/>")
                        .addClass(`btn ${buttonClass} btn-sm mx-1`)
                        .html(`<i class="${iconClass}"></i> ${options.data.status}`)
                        .on("click", function() {
                            showStatusChangeModal(options.data.id, options.data.status);
                        })
                        .appendTo(container);
                }
            },

            {
                dataField: "sof",
                caption: "Show on Front",
                width: 80,
                alignment: "center",
                cellTemplate: function(container, options) {
                    let buttonClass = options.data.sof === 'Yes' ? 'btn-success' : 'btn-danger';
                    let buttonText = options.data.sof === 'Yes' ? '<i class="bi bi-eye-fill"></i> Yes' : '<i class="bi bi-eye-slash-fill"></i> No';
                    $("<button/>")
                        .addClass(`btn ${buttonClass} btn-sm mx-1`)
                        .html(buttonText)
                        .on("click", function() {
                            showSOFModal(options.data.id, options.data.sof);
                        })
                        .appendTo(container);
                }
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
                        .html('<i class="bi bi-pencil-square" style="color: #007bff;"></i>')
                        .appendTo(container);

                    // Show Button
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#show")
                        .html('<i class="bi bi-eye" style="color: #28a745;"></i>')
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
    const imageUrl = options.data.image; // Get the image URL from the data

    if (imageUrl) {
        // Create an <img> element with the image URL
        $("<img>")
            .attr("src", imageUrl)
            .css({
                width: "50px",
                height: "50px",
                borderRadius: "5px", // Optional: rounded corners
            })
            .appendTo(container); // Append the image to the cell container
    } else {
        // Fallback text if no image is available
        container.text("No Image");
    }
}
let collapsed = false;


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
            url: `/show_product/${id}`, // The resource controller update route
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
            url: `/show_product/${id}`,
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
    fetch(`/show_product/${id}`, {
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
    fetch(`/show_product/${id}`, {
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

//category and sub categorry  auto load code start
$(document).ready(function() {
    $('#p_category').on('change', function() {
        var categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: '/get-subcategories/' + categoryId,  // Ensure this URL matches your route definition
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#p_sub_cat').empty();  // Clear previous subcategories
                    $('#p_sub_cat').append('<option value="">Select Sub Category</option>'); // Add a default option
                    $.each(data, function(key, value) {
                        $('#p_sub_cat').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);  // Add error logging
                    console.log(xhr.responseText);   // Debug response from the server
                }
            });
        } else {
            $('#p_sub_cat').empty();
            $('#p_sub_cat').append('<option value="">Select Sub Category</option>'); // Reset if no category is selected
        }
    });
});
//end of category and sub category  auto load endlet selectedProductId;
function showStatusChangeModal(productId, currentStatus) {
    selectedProductId = productId;
    $('#newStatus').val(currentStatus);
    $('#statusModal').modal('show');
}
function showSOFModal(productId, currentSOF) {
    selectedProductId = productId;
    // Set the select dropdown value based on the current SOF value
    $('#newSOF').val(currentSOF === 'Yes' ? '1' : '0');
    $('#sofModal').modal('show');
}

$(document).ready(function() {
    // Handle the status form submission
    $('#statusForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: `/product/${selectedProductId}/status`,
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#statusModal').modal('hide');
                $("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function(xhr) {
                console.log("Error updating status:", xhr.responseText);
            }
        });
    });

    // Handle the SOF form submission
    $('#sofForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: `/product/${selectedProductId}/sof`,
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#sofModal').modal('hide');
                $("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function(xhr) {
                console.log("Error updating SOF:", xhr.responseText);
            }
        });
    });
});


