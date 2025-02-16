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
                cellTemplate: function (container, options) {
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
                        .on("click", function () {
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
                cellTemplate: function (container, options) {
                    let buttonClass = options.data.sof === 'Yes' ? 'btn-success' : 'btn-danger';
                    let buttonText = options.data.sof === 'Yes' ? '<i class="bi bi-eye-fill"></i> Yes' : '<i class="bi bi-eye-slash-fill"></i> No';
                    $("<button/>")
                        .addClass(`btn ${buttonClass} btn-sm mx-1`)
                        .html(buttonText)
                        .on("click", function () {
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
   
    //update code
    // $("#updateProductForm").on("submit", function (e) {
    //     e.preventDefault();

    //     const csrfToken = document
    //         .querySelector('meta[name="csrf-token"]')
    //         .getAttribute("content");
    //     const id = document.querySelector("#updateid").value;
    //     const formData = new FormData(this);
    //     formData.append("_method", "PUT"); // Append the _method to override with PUT
    //     $.ajax({
    //         url: `/product/${id}`, // The resource controller update route
    //         type: "POST", // Still use POST, but we include _method=PUT in the form data
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         headers: {
    //             "X-CSRF-TOKEN": csrfToken,
    //         },
    //         success: function (response) {
    //             if (response.success) {
    //                 // Refresh the DataGrid to reflect the updated record
    //                 $("#gridContainer").dxDataGrid("instance").refresh();
    //                 $("#update").modal("hide");
    //                 $("#updateProductForm")[0].reset();
    //             } else {
    //                 alert("Error: " + response.message);
    //             }
    //         },
    //         error: function (response) {
    //             console.log("Error:", response);
    //         },
    //     });
    // });
    $("#updateProductForm").on("submit", function (e) {
        e.preventDefault();
    
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const id = document.querySelector("#updateid").value;
        const formData = new FormData(this);
        formData.append("_method", "PUT"); // Append the _method to override with PUT
    
        $.ajax({
            url: `/product/${id}`, // The resource controller update route
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
                $("#updateProductForm")[0].reset();
                // Show success toast notification
                toastr.success("Product updated successfully!", "Success", {
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
            url: `/product/${id}`,
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
    fetch(`/product/${id}`, {
        method: "Get",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const product = data[0]; // Access the first product in the array
            document.querySelector("#updateid").value = product.id;
            document.querySelector("#productName").innerText = product.name;
            document.querySelector("#discount").innerText = product.discounted_price;
            document.querySelector("#show_price").innerText = product.price;
            document.querySelector("#show-quantity").value = product.stock_quantity;
            document.querySelector("#discription").innerHTML = product.short_description;
        });
}); 
//end of show record

//update Record model
var update = document.getElementById("update");
update.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-userId");
    fetch(`/product/${id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            const product = data[0]; // Access the first product in the array

            // Populate form fields
            document.querySelector("#updateid").value = product.id;
            document.querySelector("#updatename").value = product.name;
            document.querySelector("#sku").value = product.sku;
            document.querySelector("#p_category").value = product.product_cat_id;
            document.querySelector("#p_sub_cat").value = product.product_sub_category_id;
            document.querySelector("#brand").value = product.product_brand_id;
            document.querySelector("#price").value = product.price;
            document.querySelector("#discount_price").value = product.discounted_price;
            document.querySelector("#quantity").value = product.stock_quantity;
            document.querySelector("#shortDescription").value = product.short_description;
            document.querySelector("#shortDescriptionEditor").innerHTML = product.short_description;
            document.querySelector("#description").value = product.description;
            document.querySelector("#description-editor").innerHTML = product.description;
            document.querySelector("#shippingInfo").value = product.shipping_info;
            document.querySelector("#shippingInfoEditor").innerHTML = product.shipping_info;
            document.querySelector("#weight").value = product.weight;
            document.querySelector("#p_unit").value = product.unit_id;
            document.querySelector("#dimensions").value = product.dimensions;
            document.querySelector("#tags").value = JSON.parse(product.tags).map(tag => tag.value).join(", ");
            document.querySelector("#colors").value = JSON.parse(product.color_options).join(", ");
            document.querySelector("#imageshow").src = product.image;

            // Handle image preview (if applicable)                     
            const imagePreview = document.querySelector("#image-preview");
            imagePreview.innerHTML = ""; // Clear previous images
            JSON.parse(product.images).forEach(image => {
                const img = document.createElement("img");
                img.src = `/images/products/${image}`;
                img.classList.add("img-thumbnail");
                img.style.width = "100px";
                img.style.height = "100px";
                img.style.margin = "5px";
                imagePreview.appendChild(img);
            });
        })
        .catch((error) => {
            console.error("Error fetching product details:", error);
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
// $(document).ready(function () {
//     $('#p_category').on('change', function () {
//         var categoryId = $(this).val();
//         if (categoryId) {
//             $.ajax({
//                 url: '/get-subcategories/' + categoryId,  // Ensure this URL matches your route definition
//                 type: 'GET',
//                 dataType: 'json',
//                 success: function (data) {
//                     $('#p_sub_cat').empty();  // Clear previous subcategories
//                     $('#p_sub_cat').append('<option value="">Select Sub Category</option>'); // Add a default option
//                     $.each(data, function (key, value) {
//                         $('#p_sub_cat').append('<option value="' + value.id + '">' + value.name + '</option>');
//                     });
//                 },
//                 error: function (xhr, status, error) {
//                     console.log("Error: " + error);  // Add error logging
//                     console.log(xhr.responseText);   // Debug response from the server
//                 }
//             });
//         } else {
//             $('#p_sub_cat').empty();
//             $('#p_sub_cat').append('<option value="">Select Sub Category</option>'); // Reset if no category is selected
//         }
//     });
// });
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

$(document).ready(function () {
    // Handle the status form submission
    $('#statusForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: `/product/${selectedProductId}/status`,
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                $('#statusModal').modal('hide');
                $("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function (xhr) {
                console.log("Error updating status:", xhr.responseText);
            }
        });
    });

    // Handle the SOF form submission
    $('#sofForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: `/product/${selectedProductId}/sof`,
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                $('#sofModal').modal('hide');
                $("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function (xhr) {
                console.log("Error updating SOF:", xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $('#p_category').on('change', function() {
        var categoryId = $(this).val();  // Get the selected category ID

        if (categoryId) {
            $.ajax({
                url: '/get-subcategories-brands/' + categoryId,  // URL to fetch subcategories and brands
                type: 'GET',  // GET request
                dataType: 'json',  // Expect JSON response
                success: function(data) {
                    $('#p_sub_cat').empty();
                    $('#p_sub_cat').append('<option value="">Select Sub Category</option>');
                    $.each(data.subcategories, function(key, value) {
                        $('#p_sub_cat').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#brand').empty();
                    $('#brand').append('<option value="">Select Brand</option>');
                    $.each(data.brands, function(key, value) {
                        $('#brand').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                    console.log("Response: " + xhr.responseText);
                }
            });
        } else {
            $('#p_sub_cat').empty();
            $('#p_sub_cat').append('<option value="">Select Sub Category</option>');

            $('#brand').empty();
            $('#brand').append('<option value="">No Brand Yet</option>');
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector('#tags');
    var tagify = new Tagify(input, {
        whitelist: ["iPhone", "MacBook", "Samsung", "PlayStation"],
        maxTags: 10,
        dropdown: {
            maxItems: 20,
            classname: "tags-look",
            enabled: 0,
            closeOnSelect: false
        }
    });
});

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000", // Duration of the toast in milliseconds
};