document.addEventListener("DOMContentLoaded", function () {
    let buttons = document.querySelectorAll("button");
    buttons.forEach(button => {
        button.addEventListener("mouseover", () => {
            button.style.boxShadow = "0 0 10px cyan";
        });
        button.addEventListener("mouseout", () => {
            button.style.boxShadow = "none";
        });
    });
});
