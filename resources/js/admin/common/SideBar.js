class SideBar {
    constructor() {
        this.adminSideBar = document.querySelector('nav.admin-sidebar');
        
        if (!this.adminSideBar) { return; }
        
        this.sidebarDropDown = this.adminSideBar.querySelector('.admin-sidebar__dropdown--container');
        this.sidebarDropdownHeading = this.adminSideBar.querySelector('.admin-sidebar__dropdown--heading');
        this.sidebarDropdownList = this.adminSideBar.querySelector('.admin-sidebar__dropdown--list');
        
        this.sidebarDropdownHeading.addEventListener('click', () => {
            this.sidebarDropdownHeading.classList.toggle('active');
            this.sidebarDropdownList.classList.toggle('open');
        });

        this.expandBtn = this.adminSideBar.querySelector('.admin-sidebar__expend-btn');
        this.expandBtn.addEventListener('click', () => {
            this.adminSideBar.classList.toggle('expanded');
        });
    }
}

export { SideBar };