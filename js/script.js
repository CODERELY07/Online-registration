// login eye 
function toggleShowPassword(passwordField, eyeIcon) {
    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
}

// Add event listeners for both eye icons
document.querySelectorAll(".showPassword1").forEach(function(eyeIcon) {
    eyeIcon.addEventListener("click", function() {
        toggleShowPassword(this.previousElementSibling, this);
    });
});



document.getElementById('Add').onclick = ()=>{
    window.location = "form.php";
}
