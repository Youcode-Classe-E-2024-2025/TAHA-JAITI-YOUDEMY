const navBar = () => {
    const openBtn = document.getElementById('openNav');
    const mobileNav = document.getElementById('mobileNav');

    if (openBtn && mobileNav){
        openBtn.addEventListener('click', (e) => {
            mobileNav.classList.toggle('hidden');
            mobileNav.classList.toggle('flex');
        });
    }
}

export default navBar