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
        columns: [
            {
                dataField: "name",
                caption: "Name Product",
            },
            {
                dataField: "stock_quantity",
                caption: "Stoke",
            },
            {
                dataField: "price",
                caption: "Price",
            },
            {
                dataField: "discounted_price",
                caption: "Discount Price",
            },
            {
                dataField: "weight",
                caption: "Weight",
            },
            {
                dataField: "dimensions",
                caption: "Dimensions",
            },
            {
                dataField: "dimensions",
                caption: "Dimensions",
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
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#show") // Ensure this matches the modal ID
                        .html(
                            '<i class="bi bi-eye" style="color: #28a745;"></i>'
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

const profileCellTemplate = function (container, options) {
    $("<div/>")
        .append(
            $("<img>", {
                src: options.value, // assuming 'options.value' contains the image URL
                css: {
                    borderRadius: "50%",
                    width: "50px",
                    height: "50px",
                    marginRight: "10px",
                },
            })
        )
        .appendTo(container);
};

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
//end of category and sub category  auto load end
