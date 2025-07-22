class SvgIcons {
    constructor() {
        this.prefix = '/';
        const svgIcons = document.querySelectorAll('.svg-icon');

        for(const icon of svgIcons) {
            const iconName = SvgIcons.getIconName(icon);

            if(iconName) {
                SvgIcons.createIcon(icon, iconName);
            } else {
                console.error('No icon name found');
            }
        }
    }

    static getIconName(elem) {
        const classNames = elem.className.split(' ');

        for(const iconName of classNames) {
            if(iconName.includes('svg-icon--')) {
                return iconName.split('svg-icon--')[1];
            }
        }
    }

    static createIcon(elem, iconName) {
        if(elem.querySelector('svg')) { return }

        const ns = 'http://www.w3.org/2000/svg';
        const svg = document.createElementNS(ns, 'svg');
        const use = document.createElementNS(ns, 'use');

        svg.setAttribute('width', '30px');
        svg.setAttribute('height', '30px');

        use.setAttribute('href', `/image/svg/sprite-sheet/sprite-sheet-1.svg#${iconName}`);
        svg.appendChild(use);

        elem.appendChild(svg);
    }

    static createSpan(iconName) {
        const span = document.createElement('span');
        span.className = `svg-icon svg-icon--${iconName}`;
        SvgIcons.update(span);

        return span;
    }

    static update(elem) {
        const iconName = SvgIcons.getIconName(elem);
        SvgIcons.createIcon(elem, iconName);
    }

    static updateAll() {
        const svgIcons  = document.querySelector('.svg-icon');
        for(const icon of svgIcons) {
            SvgIcons.update(icon);
        }
    }
}

export { SvgIcons }