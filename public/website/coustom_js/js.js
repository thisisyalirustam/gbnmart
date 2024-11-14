function toggleDropdown(categoryId) {
    var submenu = document.getElementById('submenu' + categoryId);
    var isActive = submenu.classList.contains('active-submenu');

    // Close all open submenus
    var allSubmenus = document.querySelectorAll('.submenu');
    allSubmenus.forEach(function(menu) {
        menu.classList.remove('active-submenu');
    });

    // Reset all chevron icons to downward
    var allToggles = document.querySelectorAll('.dropdown-toggle');
    allToggles.forEach(function(toggle) {
        var icons = toggle.querySelectorAll('i');
        icons[0].style.display = 'inline';  // Chevron down
        icons[1].style.display = 'none';    // Chevron up
    });

    // Toggle the current submenu and icon, if it was not active before
    if (!isActive) {
        submenu.classList.add('active-submenu');
        var icons = submenu.previousElementSibling.querySelectorAll('i');
        icons[0].style.display = 'none';   // Chevron down
        icons[1].style.display = 'inline'; // Chevron up
    }
}

function getSelectedSizes() {
    var sizes = [];
    document.querySelectorAll('.sidebar__item__size input[type="checkbox"]:checked').forEach(function(item) {
        sizes.push(item.parentNode.textContent.trim());
    });
    alert('Selected Sizes: ' + sizes.join(', '));
}

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

                    // Optionally show a success message
                    alert(data.success);
                } else if (data.error) {
                    alert(data.error); // Show error message if product already in cart
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});





$(document).ready(function() {
    $.ajax({
        url: '/cart-count', // Create a route and method to return the cart count
        method: 'GET',
        success: function(response) {
            $('#cart-count').text(response.count);
        }
    });
});

