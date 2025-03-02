// Event listener added when the user clicks to upload image
document.getElementById('upload').addEventListener('change', function(event) {
    previewImage(event);
});

// Image Preview Function
function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function() {
        const uploadedAvatar = document.getElementById('uploadedAvatar');
        uploadedAvatar.src = reader.result; // Set the src of the image preview
    }
    if (file) {
        reader.readAsDataURL(file);
    }
}

// Reset Image Preview to the default image
function resetImage() {
    const uploadedAvatar = document.getElementById('uploadedAvatar');
    uploadedAvatar.src = '../assets/img/academy/community.png';  // Reset to default image
    document.getElementById('upload').value = ''; // Reset the input value
}
