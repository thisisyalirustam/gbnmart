


let imageArray = [];
let colors = [];

function handleImageFiles(files) {
    const remainingSlots = 7 - imageArray.length;
    const filesToAdd = Array.from(files).slice(0, remainingSlots);
    filesToAdd.forEach(file => {
        if (imageArray.length < 7) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                document.getElementById('image-preview').appendChild(img);
                imageArray.push(file);
                if (imageArray.length === 7) {
                    document.getElementById('add_image_btn').style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });
}

function addColor() {
    const colorInput = document.getElementById('color_input');
    const colorName = colorInput.value.trim();

    if (colorName === "" || colors.includes(colorName)) {
        alert("Please enter a unique color.");
        return;
    }

    const colorDiv = document.createElement('div');
    colorDiv.style.backgroundColor = colorName;
    colorDiv.style.width = '30px';
    colorDiv.style.height = '30px';
    colorDiv.style.borderRadius = '10%';
    document.getElementById('color-swatches').appendChild(colorDiv);
    colors.push(colorName);
    document.getElementById('colors').value = JSON.stringify(colors);
    colorInput.value = "";
}




    let quillDescription, quillShortDescription, quillShippingInfo;

document.addEventListener('DOMContentLoaded', function () {
    quillDescription = new Quill('#description-editor', {
        theme: 'snow',
        placeholder: 'Enter product description...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered'}, { list: 'bullet' }],
                ['link', 'image', 'video']
            ]
        }
    });

    quillShortDescription = new Quill('#shortDescriptionEditor', {
        theme: 'snow',
        placeholder: 'Enter short product description...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered'}, { list: 'bullet' }],
                ['link', 'image', 'video']
            ]
        }
    });

    quillShippingInfo = new Quill('#shippingInfoEditor', {
        theme: 'snow',
        placeholder: 'Enter shipping information...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered'}, { list: 'bullet' }],
                ['link', 'image', 'video']
            ]
        }
    });
    document.getElementById('addform').onsubmit = function() {
        document.getElementById('description').value = quillDescription.root.innerHTML;
        document.getElementById('shortDescription').value = quillShortDescription.root.innerHTML;
        document.getElementById('shippingInfo').value = quillShippingInfo.root.innerHTML;
        return true; // ensure form submission proceeds after setting values
    };
});

    // On form submit, store the editor content in hidden inputs

// });

document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector('#tags'); // Get the input element
    var tagify = new Tagify(input, {
        whitelist: ["iPhone 13", "MacBook Pro", "Samsung Galaxy", "PlayStation 5", "Nintendo Switch", "Sony Headphones", "Dell XPS", "Canon Camera"],
        maxTags: 10, // Maximum number of tags
        dropdown: {
            maxItems: 20,    // Max items to show in the dropdown
            classname: "tags-look", // Custom classname for the dropdown
            enabled: 0,      // Always show the dropdown
            closeOnSelect: false // Keep the dropdown open after selecting
        }
    });

    // If you need to handle form submission:
    input.form.addEventListener('submit', (e) => {
        e.preventDefault();  // Prevent the native form submission
        console.log(tagify.value.map(item => item.value));  // Log or process the array of tags
    });
});
