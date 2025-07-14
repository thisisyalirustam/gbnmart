// //Table DevExtream
// $(() => {
//     $("#gridContainer").dxDataGrid({
//         dataSource: {
//             store: {
//                 type: "odata",
//                 version: 2,
//                 url: "/show_product",
//                 key: "id",
//             },
//         },
//         paging: {
//             pageSize: 10,
//         },
//         pager: {
//             showPageSizeSelector: true,
//             allowedPageSizes: [10, 25, 50, 100],
//         },
//         remoteOperations: false,
//         searchPanel: {
//             visible: true,
//             highlightCaseSensitive: true,
//         },
//         groupPanel: { visible: true },
//         grouping: {
//             autoExpandAll: false,
//         },
//         allowColumnReordering: true,
//         rowAlternationEnabled: true,
//         showBorders: true,
//         width: "100%",
//         columnAutoWidth: true, // Automatically adjusts column widths
//         scrolling: {
//             mode: "virtual", // Enables virtual scrolling
//             useNative: true,
//         },

//         columns: [
//             {
//                 caption: "Select",
//                 alignment: "center",
//                 width: 70,
//                 cellTemplate: function(container, options) {
//                     $('<div>').addClass('d-flex justify-content-center')
//                         .append($('<input>')
//                             .attr('type', 'checkbox')
//                             .attr('class', 'form-check-input product-checkbox')
//                             .attr('data-product-id', options.data.id)
//                         )
//                         .appendTo(container);
//                 }
//             },
//             {
//                 dataField: "image",
//                 caption: "Image",
//                 alignment: "center",
//                 dataType: "string",
//                 width: 100,
//                 cellTemplate: profileCellTemplate // Reference the function here
//             },
//             {
//                 dataField: "status",
//                 caption: "Status",
//                 alignment: "center",
//                 width: 110,
//                 cellTemplate: function (container, options) {
//                     let buttonClass = 'btn-outline-secondary'; // Default class
//                     let iconClass = 'bi bi-pencil-square'; // Default icon
//                     if (options.data.status === 'active') {
//                         buttonClass = 'btn-success';
//                         iconClass = 'bi bi-check-circle';
//                     } else if (options.data.status === 'pending') {
//                         buttonClass = 'btn-warning';
//                         iconClass = 'bi bi-exclamation-circle';
//                     } else if (options.data.status === 'suspend') {
//                         buttonClass = 'btn-danger';
//                         iconClass = 'bi bi-x-circle';
//                     } else if (options.data.status === 'blocked') {
//                         buttonClass = 'btn-dark';
//                         iconClass = 'bi bi-block';
//                     }
//                     $("<button/>")
//                         .addClass(`btn ${buttonClass} btn-sm mx-1`)
//                         .html(`<i class="${iconClass}"></i> ${options.data.status}`)
//                         .on("click", function () {
//                             showStatusChangeModal(options.data.id, options.data.status);
//                         })
//                         .appendTo(container);
//                 }
//             },

//             {
//                 dataField: "sof",
//                 caption: "Show on Front",
//                 width: 80,
//                 alignment: "center",
//                 cellTemplate: function (container, options) {
//                     let buttonClass = options.data.sof === 'Yes' ? 'btn-success' : 'btn-danger';
//                     let buttonText = options.data.sof === 'Yes' ? '<i class="bi bi-eye-fill"></i> Yes' : '<i class="bi bi-eye-slash-fill"></i> No';
//                     $("<button/>")
//                         .addClass(`btn ${buttonClass} btn-sm mx-1`)
//                         .html(buttonText)
//                         .on("click", function () {
//                             showSOFModal(options.data.id, options.data.sof);
//                         })
//                         .appendTo(container);
//                 }
//             },



//             {
//                 caption: "Actions",
//                 alignment: "center",
//                 cellTemplate(container, options) {
//                     const id = options.data.id;

//                     // Edit Button
//                     $("<a>")
//                         .addClass("btn btn-outline-secondary btn-sm mx-1")
//                         .attr("href", "#")
//                         .attr("data-bs-toggle", "modal")
//                         .attr("data-bs-userId", id)
//                         .attr("data-bs-target", "#update")
//                         .html('<i class="bi bi-pencil-square" style="color: #007bff;"></i>')
//                         .appendTo(container);

//                     // Show Button
//                     $("<a>")
//                         .addClass("btn btn-outline-secondary btn-sm mx-1")
//                         .attr("href", "#")
//                         .attr("data-bs-toggle", "modal")
//                         .attr("data-bs-userId", id)
//                         .attr("data-bs-target", "#show")
//                         .html('<i class="bi bi-eye" style="color: #28a745;"></i>')
//                         .appendTo(container);

//                     // Delete Button
//                     $("<a>")
//                         .addClass("btn btn-outline-secondary btn-sm mx-1")
//                         .attr("href", "#")
//                         .attr("data-bs-toggle", "modal")
//                         .attr("data-bs-userId", id)
//                         .attr("data-bs-target", "#delete")
//                         .html('<i class="bi bi-trash" style="color: #dc3545;"></i>')
//                         .appendTo(container);
//                 },
//             },
//             {
//                 dataField: "name",
//                 caption: "Name Product",


//             },
//             {
//                 dataField: "product_cat.name", // Accessing nested category name
//                 caption: "Category Name",
//             },
//             {
//                 dataField: "product_sub_category.name", // Accessing nested sub-category name
//                 caption: "Sub-Category Name",
//             },
//             {
//                 dataField: "product_brand.name", // Accessing nested brand name
//                 caption: "Brand Name",
//             },
//             {
//                 dataField: "user.name", // Accessing nested user name
//                 caption: "User Name",
//             },

//             {
//                 dataField: "stock_quantity",
//                 caption: "Stock",
//                 width: 80,
//                 alignment: "center",
//             },
//             {
//                 dataField: "price",
//                 caption: "Price",
//                 width: 80,
//                 alignment: "center",
//             },
//             {
//                 dataField: "discounted_price",
//                 caption: "Discount Price",
//                 width: 80,
//                 alignment: "center",
//             },
//             {
//                 dataField: "weight",
//                 caption: "Weight",
//                 width: 80,
//                 alignment: "center",
//             },
//             {
//                 dataField: "dimensions",
//                 caption: "Dimensions",
//                 width: 80,
//                 alignment: "center",
//             },

          
//         ],
//         onContentReady(e) {
//             if (!collapsed) {
//                 collapsed = true;
//                 e.component.expandRow(["EnviroCare"]);
//             }
//         },
//     });
// });
// function profileCellTemplate(container, options) {
//     const imageUrl = options.data.image; // Get the image URL from the data

//     if (imageUrl) {
//         // Create an <img> element with the image URL
//         $("<img>")
//             .attr("src", imageUrl)
//             .css({
//                 width: "50px",
//                 height: "50px",
//                 borderRadius: "5px", // Optional: rounded corners
//             })
//             .appendTo(container); // Append the image to the cell container
//     } else {
//         // Fallback text if no image is available
//         container.text("No Image");
//     }
// }
// let collapsed = false;


// //create record
// $(document).ready(function () {

//     //update code
    
//     $("#updateProductForm").on("submit", function (e) {
//         e.preventDefault();

//         const csrfToken = document
//             .querySelector('meta[name="csrf-token"]')
//             .getAttribute("content");
//         const id = document.querySelector("#updateid").value;
//         const formData = new FormData(this);
//         formData.append("_method", "PUT"); // Append the _method to override with PUT

//         $.ajax({
//             url: `/product/${id}`, // The resource controller update route
//             type: "POST", // Still use POST, but we include _method=PUT in the form data
//             data: formData,
//             contentType: false,
//             processData: false,
//             headers: {
//                 "X-CSRF-TOKEN": csrfToken,
//             },
//             success: function (response) {

//                 $("#gridContainer").dxDataGrid("instance").refresh();
//                 $(".btn-close").click();
//                 $("#updateProductForm")[0].reset();
//                 // Show success toast notification
//                 toastr.success("Product updated successfully!", "Success", {
//                     closeButton: true,
//                     progressBar: true,
//                     positionClass: "toast-top-right",
//                     timeOut: 3000,
//                 });
//             },
//             error: function (response) {
//                 console.log("Error:", response);

//                 // Show error toast notification
//                 toastr.error("An error occurred while updating the product.", "Error", {
//                     closeButton: true,
//                     progressBar: true,
//                     positionClass: "toast-top-right",
//                     timeOut: 3000,
//                 });
//             },
//         });
//     });
//     // end of update code

//     //delete code
//     $("#deleteForm").on("submit", function (e) {
//         e.preventDefault();

//         const csrfToken = document
//             .querySelector('meta[name="csrf-token"]')
//             .getAttribute("content");
//         const id = document.querySelector("#deleteid").value;
//         const formData = new FormData(this);
//         formData.append("_method", "DELETE"); // Method override for DELETE

//         $.ajax({
//             url: `/product/${id}`,
//             type: "POST",
//             data: formData,
//             contentType: false,
//             processData: false,
//             headers: {
//                 "X-CSRF-TOKEN": csrfToken,
//             },
//             success: function (response) {
//                 if (response.success) {
//                     // Refresh the DataGrid to reflect the deleted record
//                     $("#gridContainer").dxDataGrid("instance").refresh();
//                     // Hide the modal
//                     $(".delet-model").click();
//                     // Reset the form
//                     $("#deleteForm")[0].reset();
//                     toastr.success(response.message);
//                 } else {
//                     alert("Error: " + response.message);
//                 }
//             },
//             error: function (response) {
//                 console.log("Error:", response);
//             },
//         });
//     });

//     // Trigger form submission when the delete button is clicked
     
// });
// //end of delete code

// //show record
// var show = document.getElementById("show");
// show.addEventListener("show.bs.modal", function (event) {
//     var button = event.relatedTarget;
//     var id = button.getAttribute("data-bs-userId");
//     fetch(`/product/${id}`, {
//         method: "Get",
//         headers: {
//             "Content-Type": "application/json",
//         },
//     })
//         .then((response) => response.json())
//         .then((data) => {
//             const product = data[0]; // Access the first product in the array
//             document.querySelector("#updateid").value = product.id;
//             document.querySelector("#productName").innerText = product.name;
//             document.querySelector("#discount").innerText = product.discounted_price;
//             document.querySelector("#show_price").innerText = product.price;
//             document.querySelector("#show-quantity").value = product.stock_quantity;
//             document.querySelector("#discription").innerHTML = product.short_description;
//         });
// });
// //end of show record

// //update Record model
// // var update = document.getElementById("update");

// update.addEventListener("show.bs.modal", function (event) {
//     var button = event.relatedTarget;
//     var id = button.getAttribute("data-bs-userId");

//     // Fetch product details
//     fetch(`/product/${id}`, {
//         method: "GET",
//         headers: {
//             "Content-Type": "application/json",
//         },
//     })
//         .then((response) => response.json())
//         .then((data) => {
//             console.log(data);

//             if (data.length === 0) {
//                 console.error("No product data found.");
//                 return;
//             }

//             const product = data[0]; // Access the first product in the array

//             // Populate form fields
//             document.querySelector("#updateid").value = product.id;
//             document.querySelector("#updatename").value = product.name;
//             document.querySelector("#sku").value = product.sku;
//             document.querySelector("#p_category").value = product.product_cat_id;
//             document.querySelector("#p_sub_cat").value = product.product_sub_category_id;
//             document.querySelector("#brand").value = product.product_brand_id;
//             document.querySelector("#price").value = product.price;
//             document.querySelector("#discount_price").value = product.discounted_price;
//             document.querySelector("#quantity").value = product.stock_quantity;
//             document.querySelector("#shortDescription").value = product.short_description;
//             document.querySelector("#shortDescriptionEditor").innerHTML = product.short_description;
//             document.querySelector("#description").value = product.description;
//             document.querySelector("#description-editor").innerHTML = product.description;
//             document.querySelector("#shippingInfo").value = product.shipping_info;
//             document.querySelector("#shippingInfoEditor").innerHTML = product.shipping_info;
//             document.querySelector("#weight").value = product.weight;
//             document.querySelector("#p_unit").value = product.unit_id;
//             document.querySelector("#dimensions").value = product.dimensions;

//             try {
//                 const tags = JSON.parse(product.tags || "[]");
//                 document.querySelector("#tags").value = tags.map(tag => tag.value).join(", ");
//             } catch (error) {
//                 console.error("Error parsing tags:", error);
//                 document.querySelector("#tags").value = "";
//             }

//             try {
//                 const colors = JSON.parse(product.color_options || "[]");
//                 document.querySelector("#colors").value = colors.join(", ");
//             } catch (error) {
//                 console.error("Error parsing color options:", error);
//                 document.querySelector("#colors").value = "";
//             }

//             const imagePreview = document.querySelector("#image-preview");
//             imagePreview.innerHTML = ""; 

//             try {
//                 const images = JSON.parse(product.images || "[]");
//                 const imagePreview = document.querySelector("#image-preview");
//                 imagePreview.innerHTML = ""; // Clear previous images

//                 images.forEach(image => {
//                     const imgContainer = document.createElement("div");
//                     imgContainer.classList.add("image-container");

//                     const img = document.createElement("img");
//                     img.src = `/images/products/${image}`;
//                     img.classList.add("img-thumbnail");

//                     const removeBtn = document.createElement("button");
//                     removeBtn.type = "button"; // Ensure it's not a submit button
//                     removeBtn.classList.add("remove-btn");
//                     removeBtn.innerHTML = "&times;";
//                     removeBtn.onclick = function (event) {
//                         event.preventDefault(); // Prevent form submission

//                         // Send a request to delete the image
//                         fetch(`/product/${product.id}/delete-image`, {
//                             method: "POST",
//                             headers: {
//                                 "Content-Type": "application/json",
//                                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                             },
//                             body: JSON.stringify({ image: image }),
//                         })
//                             .then((response) => response.json())
//                             .then((data) => {
//                                 if (data.success) {
//                                     imgContainer.remove(); // Remove the image from the UI

//                                     // Show a toast notification
//                                     const toast = new bootstrap.Toast(document.getElementById('toast'));
//                                     document.getElementById('toast-message').innerText = 'Image removed successfully.';
//                                     toast.show();
//                                 } else {
//                                     console.error("Failed to delete image:", data.message);
//                                 }
//                             })
//                             .catch((error) => {
//                                 console.error("Error deleting image:", error);
//                             });
//                     };

//                     imgContainer.appendChild(img);
//                     imgContainer.appendChild(removeBtn);
//                     imagePreview.appendChild(imgContainer);
//                 });
//             } catch (error) {
//                 console.error("Error parsing images:", error);
//             }
//         })
//         .catch((error) => {
//             console.error("Error fetching product details:", error);
//         });
// });
// //end update Record model

// //Delete model
// var deleteModal = document.getElementById("delete");
// deleteModal.addEventListener("show.bs.modal", function (event) {
//     var button = event.relatedTarget;
//     var id = button.getAttribute("data-bs-userId");
//     document.querySelector("#deleteid").value = id;
// });
// // end of delete model

// function showStatusChangeModal(productId, currentStatus) {
//     selectedProductId = productId;
//     $('#newStatus').val(currentStatus);
//     $('#statusModal').modal('show');
// }
// function showSOFModal(productId, currentSOF) {
//     selectedProductId = productId;
//     // Set the select dropdown value based on the current SOF value
//     $('#newSOF').val(currentSOF === 'Yes' ? '1' : '0');
//     $('#sofModal').modal('show');
// }

// $(document).ready(function () {
//     // Handle the status form submission
//     $('#statusForm').on('submit', function (e) {
//         e.preventDefault();
//         $.ajax({
//             url: `/product/${selectedProductId}/status`,
//             type: "POST",
//             data: $(this).serialize(),
//             success: function (response) {
//                 $('#statusModal').modal('hide');
//                 $("#gridContainer").dxDataGrid("instance").refresh();
//             },
//             error: function (xhr) {
//                 console.log("Error updating status:", xhr.responseText);
//             }
//         });
//     });

//     // Handle the SOF form submission
//     $('#sofForm').on('submit', function (e) {
//         e.preventDefault();
//         $.ajax({
//             url: `/product/${selectedProductId}/sof`,
//             type: "POST",
//             data: $(this).serialize(),
//             success: function (response) {
//                 $('#sofModal').modal('hide');
//                 $("#gridContainer").dxDataGrid("instance").refresh();
//             },
//             error: function (xhr) {
//                 console.log("Error updating SOF:", xhr.responseText);
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $('#p_category').on('change', function () {
//         var categoryId = $(this).val();  // Get the selected category ID

//         if (categoryId) {
//             $.ajax({
//                 url: '/get-subcategories-brands/' + categoryId,  // URL to fetch subcategories and brands
//                 type: 'GET',  // GET request
//                 dataType: 'json',  // Expect JSON response
//                 success: function (data) {
//                     $('#p_sub_cat').empty();
//                     $('#p_sub_cat').append('<option value="">Select Sub Category</option>');
//                     $.each(data.subcategories, function (key, value) {
//                         $('#p_sub_cat').append('<option value="' + value.id + '">' + value.name + '</option>');
//                     });
//                     $('#brand').empty();
//                     $('#brand').append('<option value="">Select Brand</option>');
//                     $.each(data.brands, function (key, value) {
//                         $('#brand').append('<option value="' + value.id + '">' + value.name + '</option>');
//                     });
//                 },
//                 error: function (xhr, status, error) {
//                     console.log("Error: " + error);
//                     console.log("Response: " + xhr.responseText);
//                 }
//             });
//         } else {
//             $('#p_sub_cat').empty();
//             $('#p_sub_cat').append('<option value="">Select Sub Category</option>');

//             $('#brand').empty();
//             $('#brand').append('<option value="">No Brand Yet</option>');
//         }
//     });
// });

// document.addEventListener("DOMContentLoaded", function () {
//     var input = document.querySelector('#tags');
//     var tagify = new Tagify(input, {
//         whitelist: ["iPhone", "MacBook", "Samsung", "PlayStation"],
//         maxTags: 10,
//         dropdown: {
//             maxItems: 20,
//             classname: "tags-look",
//             enabled: 0,
//             closeOnSelect: false
//         }
//     });
// });

// toastr.options = {
//     "closeButton": true,
//     "progressBar": true,
//     "positionClass": "toast-top-right",
//     "timeOut": "3000", // Duration of the toast in milliseconds
// };
// Define getOrderDay for the custom filter
function getOrderDay(date) {
    return new Date(date).getDay();
}

// Initialize DataGrid
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
        columnAutoWidth: true,
        scrolling: {
            mode: "virtual",
            useNative: true,
        },
        filterRow: { visible: true },
        filterPanel: { visible: true },
        headerFilter: { visible: true },
        
        filterBuilderPopup: {
            position: {
                of: window, at: 'top', my: 'top', offset: { y: 10 },
            },
        },
        columns: [
            {
                caption: "Select",
                alignment: "center",
                cellTemplate: function(container, options) {
                    $('<div>').addClass('d-flex justify-content-center')
                        .append($('<input>')
                            .attr('type', 'checkbox')
                            .attr('class', 'form-check-input product-checkbox')
                            .attr('data-product-id', options.data.id)
                        )
                        .appendTo(container);
                }
            },
                
            {
               
                caption: "Image",
                alignment: "center",
                dataType: "string",
                width: 100,
                cellTemplate: profileCellTemplate
            },
            {
                
                caption: "Status",
                alignment: "center",
                width: 110,
                cellTemplate: function (container, options) {
                    let buttonClass = 'btn-outline-secondary';
                    let iconClass = 'bi bi-pencil-square';
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
                    $("<button>")
                        .addClass(`btn ${buttonClass} btn-sm mx-1`)
                        .html(`<i class="${iconClass}"></i> ${options.data.status}`)
                        .on("click", function () {
                            showStatusChangeModal(options.data.id, options.data.status);
                        })
                        .appendTo(container);
                }
            },
            {
                
                caption: "Show on Front",
                width: 80,
                alignment: "center",
                cellTemplate: function (container, options) {
                    let buttonClass = options.data.sof === 'Yes' ? 'btn-success' : 'btn-danger';
                    let buttonText = options.data.sof === 'Yes' ? '<i class="bi bi-eye-fill"></i> Yes' : '<i class="bi bi-eye-slash-fill"></i> No';
                    $("<button>")
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
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#update")
                        .html('<i class="bi bi-pencil-square" style="color: #007bff;"></i>')
                        .appendTo(container);
                    $("<a>")
                        .addClass("btn btn-outline-secondary btn-sm mx-1")
                        .attr("href", "#")
                        .attr("data-bs-toggle", "modal")
                        .attr("data-bs-userId", id)
                        .attr("data-bs-target", "#show")
                        .html('<i class="bi bi-eye" style="color: #28a745;"></i>')
                        .appendTo(container);
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
                dataField: "name",
                caption: "Name Product",
            },
            {
                dataField: "product_cat.name",
                caption: "Category Name",
            },
            {
                dataField: "product_sub_category.name",
                caption: "Sub-Category Name",
            },
            {
                dataField: "product_brand.name",
                caption: "Brand Name",
            },
            {
                dataField: "user.name",
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
        ],
        onContentReady(e) {
            if (!collapsed) {
                collapsed = true;
                e.component.expandRow(["EnviroCare"]);
            }
        },
    });
});

// Function to handle collection update
function updateProductCollection(productId, collection) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $.ajax({
        url: `/product/${productId}/collection`,
        type: 'POST',
        data: { collection: collection, _token: csrfToken },
        success: function(response) {
            $("#gridContainer").dxDataGrid("instance").refresh();
            toastr.success('Collection updated successfully!', 'Success', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
        },
        error: function(xhr) {
            const errorMessage = xhr.responseJSON?.message || 'Error updating collection';
            toastr.error(errorMessage, 'Error', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
        }
    });
}

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
let selectedProductId;

// Update product form submission
$(document).ready(function () {
    $("#updateProductForm").on("submit", function (e) {
        e.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const id = document.querySelector("#updateid").value;
        const formData = new FormData(this);
        formData.append("_method", "PUT");
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
                $("#gridContainer").dxDataGrid("instance").refresh();
                $(".btn-close").click();
                $("#updateProductForm")[0].reset();
                toastr.success("Product updated successfully!", "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                });
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.message || 'An error occurred while updating the product.';
                toastr.error(errorMessage, "Error", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                });
            },
        });
    });

    // Delete product form submission
    $("#deleteForm").on("submit", function (e) {
        e.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const id = document.querySelector("#deleteid").value;
        const formData = new FormData(this);
        formData.append("_method", "DELETE");
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
                    $("#gridContainer").dxDataGrid("instance").refresh();
                    $(".delet-model").click();
                    $("#deleteForm")[0].reset();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message, 'Error');
                }
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Error deleting product';
                toastr.error(errorMessage, 'Error');
            },
        });
    });

    // Show modal
    $('#show').on('show.bs.modal', function (event) {
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
                const product = data[0];
                document.querySelector("#updateid").value = product.id;
                document.querySelector("#productName").innerText = product.name;
                document.querySelector("#discount").innerText = product.discounted_price;
                document.querySelector("#show_price").innerText = product.price;
                document.querySelector("#show-quantity").value = product.stock_quantity;
                document.querySelector("#discription").innerHTML = product.short_description;
            });
    });

    // Update modal
    $('#update').on('show.bs.modal', function (event) {
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
                if (data.length === 0) {
                    console.error("No product data found.");
                    return;
                }
                const product = data[0];
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
                try {
                    const tags = JSON.parse(product.tags || "[]");
                    document.querySelector("#tags").value = tags.map(tag => tag.value).join(", ");
                } catch (error) {
                    console.error("Error parsing tags:", error);
                    document.querySelector("#tags").value = "";
                }
                try {
                    const colors = JSON.parse(product.color_options || "[]");
                    document.querySelector("#colors").value = colors.join(", ");
                } catch (error) {
                    console.error("Error parsing color options:", error);
                    document.querySelector("#colors").value = "";
                }
                const imagePreview = document.querySelector("#image-preview");
                imagePreview.innerHTML = "";
                try {
                    const images = JSON.parse(product.images || "[]");
                    images.forEach(image => {
                        const imgContainer = document.createElement("div");
                        imgContainer.classList.add("image-container");
                        const img = document.createElement("img");
                        img.src = `/images/products/${image}`;
                        img.classList.add("img-thumbnail");
                        const removeBtn = document.createElement("button");
                        removeBtn.type = "button";
                        removeBtn.classList.add("remove-btn");
                        removeBtn.innerHTML = "×";
                        removeBtn.onclick = function (event) {
                            event.preventDefault();
                            if (confirm('Are you sure you want to delete this image?')) {
                                fetch(`/product/${product.id}/delete-image`, {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    },
                                    body: JSON.stringify({ image: image }),
                                })
                                    .then((response) => response.json())
                                    .then((data) => {
                                        if (data.success) {
                                            imgContainer.remove();
                                            const toast = new bootstrap.Toast(document.getElementById('toast'));
                                            document.getElementById('toast-message').innerText = 'Image removed successfully.';
                                            toast.show();
                                        } else {
                                            console.error("Failed to delete image:", data.message);
                                        }
                                    })
                                    .catch((error) => {
                                        console.error("Error deleting image:", error);
                                    });
                            }
                        };
                        imgContainer.appendChild(img);
                        imgContainer.appendChild(removeBtn);
                        imagePreview.appendChild(imgContainer);
                    });
                } catch (error) {
                    console.error("Error parsing images:", error);
                }
            })
            .catch((error) => {
                console.error("Error fetching product details:", error);
            });
    });

    // Delete modal
    $('#delete').on('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute("data-bs-userId");
        document.querySelector("#deleteid").value = id;
    });

    // Status and SOF form submissions
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

    // Category change handler
    $('#p_category').on('change', function () {
        var categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: '/get-subcategories-brands/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#p_sub_cat').empty();
                    $('#p_sub_cat').append('<option value="">Select Sub Category</option>');
                    $.each(data.subcategories, function (key, value) {
                        $('#p_sub_cat').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#brand').empty();
                    $('#brand').append('<option value="">Select Brand</option>');
                    $.each(data.brands, function (key, value) {
                        $('#brand').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
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

    // Tagify initialization
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

// Status and SOF modal handlers
function showStatusChangeModal(productId, currentStatus) {
    selectedProductId = productId;
    $('#newStatus').val(currentStatus);
    $('#statusModal').modal('show');
}

// Store selected product IDs
let selectedProductIds = [];

// Function to update selected products
function updateSelectedProducts() {
    selectedProductIds = [];
    $('.product-checkbox:checked').each(function() {
        selectedProductIds.push($(this).data('product-id'));
    });
    
    // Enable/disable the collection dropdown based on selection
    const hasSelectedProducts = selectedProductIds.length > 0;
    $('.btn-group .dropdown-toggle').prop('disabled', !hasSelectedProducts);
    
    if (!hasSelectedProducts) {
        $('.btn-group .dropdown-toggle').dropdown('hide');
    }
}

// Checkbox click handler
$(document).on('change', '.product-checkbox', function() {
    updateSelectedProducts();
});

// Collection form submission
$('#collectionAssignmentForm').on('submit', function(e) {
    e.preventDefault();
    
    if (selectedProductIds.length === 0) {
        toastr.error('Please select at least one product', 'Error');
        return;
    }
    
    const selectedCollections = [];
    $('.collection-checkbox:checked').each(function() {
        selectedCollections.push($(this).val());
    });
    
    if (selectedCollections.length === 0) {
        toastr.error('Please select at least one collection', 'Error');
        return;
    }
    
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    url: '/products/assign-collections', // Use Laravel's route helper
    type: "POST",
    data: {
        product_ids: selectedProductIds,
        collection_ids: selectedCollections,
        _token: csrfToken
    },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message, 'Success');
                $('.btn-group .dropdown-toggle').dropdown('hide');
                // Clear selections
                $('.product-checkbox').prop('checked', false);
                $('.collection-checkbox').prop('checked', false);
                selectedProductIds = [];
            } else {
                toastr.error(response.message, 'Error');
            }
        },
        error: function(xhr) {
            toastr.error('An error occurred while assigning collections', 'Error');
            console.error(xhr.responseText);
        }
    });
   
});

function showSOFModal(productId, currentSOF) {
    selectedProductId = productId;
    $('#newSOF').val(currentSOF === 'Yes' ? '1' : '0');
    $('#sofModal').modal('show');
}

// Toastr options
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000",
};