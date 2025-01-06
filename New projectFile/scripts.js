const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signInForm');
const signUpForm = document.getElementById('signUpForm');

// Ensure elements exist before adding event listeners
if (signUpButton && signInButton && signInForm && signUpForm) {
    signUpButton.addEventListener('click', function () {
        signInForm.style.display = "none";
        signUpForm.style.display = "block";
    });

    signInButton.addEventListener('click', function () {
        signUpForm.style.display = "none";
        signInForm.style.display = "block";
    });
} else {
    console.error("One or more elements are missing. Please check the HTML structure.");
}
