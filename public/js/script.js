/*Product/create.blade.php*/
function toggleImageField() {
    var fileUpload = document.getElementById('fileUpload');
    var imageUrl = document.querySelector('input[name="image"]');
    if (fileUpload.style.display === 'none') {
        fileUpload.style.display = 'block';
        imageUrl.style.display = 'none';
    } else {
        fileUpload.style.display = 'none';
        imageUrl.style.display = 'block';
    }
}

/*Product/update.blade.php*/

function toggleImageField() {
    var fileUpload = document.getElementById('fileUpload');
    var imageUrlInput = document.querySelector('input[name="image"]');
    if (fileUpload.style.display === 'none') {
        fileUpload.style.display = 'block';
        imageUrlInput.style.display = 'none';
        imageUrlInput.value = ''; // Limpiar el valor del campo de entrada de la URL de la imagen
    } else {
        fileUpload.style.display = 'none';
        imageUrlInput.style.display = 'block';
    }
}

// Mostrar la miniatura de la imagen al lado del campo de entrada de la URL
var imageUrlInput = document.getElementById('imageUrl');
var imagePreview = document.getElementById('imagePreview');
imageUrlInput.addEventListener('input', function() {
    imagePreview.src = this.value;
});





