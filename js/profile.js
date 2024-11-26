
function updateProfilePicture(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        document.getElementById("profileImage").src = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}

