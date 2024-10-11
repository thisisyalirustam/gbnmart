document.querySelectorAll('.drop-area').forEach((dropArea, index) => {
    const input = dropArea.querySelector('input[type="file"]');
    const preview = dropArea.querySelector('.preview-container');

    dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropArea.classList.add('border-success');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-success');
    });

    dropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dropArea.classList.remove('border-success');
        const files = event.dataTransfer.files;
        handleFiles(files, preview);
    });

    dropArea.addEventListener('click', () => {
        input.click();
    });

    input.addEventListener('change', () => {
        const files = input.files;
        handleFiles(files, preview);
    });
});

function handleFiles(files, preview) {
    preview.innerHTML = '';
    const file = files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = document.createElement('img');
            img.src = event.target.result;
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}


// end of image js

//start of text box 
const textarea = document.getElementById('comments');
const commentsHelp = document.getElementById('commentsHelp');
textarea.addEventListener('input', function() {
    const remaining = 1000 - this.value.length;
    commentsHelp.textContent = `${remaining} characters left`;
});

