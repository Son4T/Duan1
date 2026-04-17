
const menuLinks = document.querySelectorAll('.menu-link');
const toggleCategories = document.querySelector('.toggle-categories');
function showCategories() {
    toggleCategories.classList.add('visible-1');
}
function hideCategories() {
    toggleCategories.classList.remove('visible-1');
}
menuLinks.forEach(link => {
    link.addEventListener('mouseover', showCategories);
    link.addEventListener('mouseleave', () => {
        setTimeout(() => {
            if (!toggleCategories.matches(':hover')) {
                hideCategories();
            }
        }, 100);
    });
});
toggleCategories.addEventListener('mouseover', showCategories);
toggleCategories.addEventListener('mouseleave', hideCategories);


const User = document.querySelector('.user');
const UserManager = document.querySelector('.management-user');
function ShowUserManager() {
    UserManager.classList.add('visible-2');
}
function HideUserManager() {
    setTimeout(()=>{
        if(!User.matches(':hover') &&  !UserManager.matches(':hover')){
            UserManager.classList.remove('visible-2');
        }
    },100)
}
User.addEventListener('mouseover', ShowUserManager);
UserManager.addEventListener('mouseover', ShowUserManager);
User.addEventListener('mouseleave', HideUserManager);
UserManager.addEventListener('mouseleave', HideUserManager);




