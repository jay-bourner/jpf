class Navigation {
    constructor() {
        const mobileNavBtn = document.querySelector('#mobile-nav-btn');

        mobileNavBtn.addEventListener('click', () => {
            const mobileNavLinks = document.querySelector('.mobile-nav-links');
            mobileNavLinks.classList.toggle('active');
        });
    }
}

export { Navigation }