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

