const path = window.location.href;
const links = document.querySelectorAll(".nav-link")

links.forEach((link) => {
    link.classList.remove("active");
    if (link.href === path) {
        link.classList.add("active");
    }
})
