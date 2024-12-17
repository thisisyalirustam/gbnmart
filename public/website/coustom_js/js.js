

//index page

$(document).ready(function(){
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
button.onclick = function() {
// Logic to slide to the previous image
};
});

document.querySelectorAll('.slider-right').forEach(button => {
button.onclick = function() {
// Logic to slide to the next image
};
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Select all Add to Cart buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
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
                    // Update cart count in the header
                    document.getElementById('cart-count').innerText = data.count;

                    // Show success toaster message
                    toastr.success(data.success);
                } else if (data.error) {
                    // Show error toaster message if product already in cart
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





$(document).ready(function() {
    $.ajax({
        url: '/cart-count', // Create a route and method to return the cart count
        method: 'GET',
        success: function(response) {
            $('#cart-count').text(response.count);
        }
    });
});

function toggleWishlist(event) {
    // Prevent default behavior for the anchor tag
    event.preventDefault();

    const wishlistIcon = event.target.closest('a');
    if (!wishlistIcon.classList.contains('clicked')) {
        wishlistIcon.classList.add('clicked');
    } else {
        wishlistIcon.classList.remove('clicked');
    }
    console.log('Product added to wishlist (this is just a demo action).');
}

let timeout = null;
document.querySelectorAll('.card-link').forEach(link => {
    link.addEventListener('click', function(event) {
        if (timeout) {
            clearTimeout(timeout);
        }

        timeout = setTimeout(() => {
            window.location.href = link.href;
        }, 500);
        event.preventDefault(); // Prevent immediate redirection
    });
});
