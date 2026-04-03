function toggleMenu() {
    var menu = document.getElementById('category-menu');
    menu.classList.toggle('active'); 
}
function toggleLogin() {
    var login = document.getElementById('category-login');
    if (login) {
        login.classList.toggle('active');
    }
}
function toggleuser() {
    var user = document.getElementById('category-user');
    if (user) {
        user.classList.toggle('active');
    }
}