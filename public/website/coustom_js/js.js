

//index page

$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        items: 1, // Show one image at a time
        loop: true, // Loop through images
        margin: 10,
        nav: true, // Show navigation arrows
        autoplay: true, // Enable auto-play
        autoplayTimeout: 3000, // Auto-play interval
        autoplayHoverPause: true // Pause on hover
    });
});
document.querySelectorAll('.slider-left').forEach(button => {
    button.onclick = function () {
    };
});

document.querySelectorAll('.slider-right').forEach(button => {
    button.onclick = function () {
    };
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent page refresh
            const productId = this.getAttribute('data-product-id');
            // Perform the AJAX request
            fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('cart-count').innerText = data.count;
                        toastr.success(data.success);
                    } else if (data.error) {
                        toastr.error(data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

});

document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.addToWishlistButton');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent page refresh
            const productId = this.getAttribute('data-product-id');
            fetch('/wishlist-add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('wishlist-count').innerText = data.wishCount;
                        toastr.success(data.success);
                    } else if (data.error) {
                        toastr.error(data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

});

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000", // Duration of the toast in milliseconds
};

$(document).ready(function () {
    $.ajax({
        url: '/cart-count', // Create a route and method to return the cart count
        method: 'GET',
        success: function (response) {
            $('#cart-count').text(response.count);
            $('#count').text(response.count);
             let cartHtml = '';
                    response.cartitem.forEach(item => {
                        cartHtml += `
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="/storage/${item.first_image}" alt="${item.name}" class="img-fluid">
                                </div>
                                <div class="cart-item-content">
                                    <h6 class="cart-item-title">${item.name}</h6>
                                    <div class="cart-item-meta">${item.quantity} × $${item.price}</div>
                                </div>
                                <button class="cart-item-remove">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>`;
                    });

                    // Update the cart items and total
                    $('.cart-items').html(cartHtml);
                    $('.cart-total-price').text(`$${response.subtotal.toFixed(2)}`);
        }
    });
});
$(document).ready(function () {
    $.ajax({
        url: '/wishlist-count', // Create a route and method to return the cart count
        method: 'GET',
        success: function (response) {
            $('#wishlist-count').text(response.wishCount);
        }
    });
});



let timeout = null;
document.querySelectorAll('.card-link').forEach(link => {
    link.addEventListener('click', function (event) {
        if (timeout) {
            clearTimeout(timeout);
        }

        timeout = setTimeout(() => {
            window.location.href = link.href;
        }, 500);
        event.preventDefault(); // Prevent immediate redirection
    });
});





