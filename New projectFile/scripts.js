const signUpButton=document.getElementById('signUpButton');
const signInButton=document.getElementById('signInButton');
const signInForm=document.getElementById('signInForm');
const signUpForm=document.getElementById('signUpForm');

signUpButton.addEventListener('click',function() {
    signInForm.style.display="none";
    signUpForm.style.display="block";
})
