export class WorksAccordion {
    constructor() {
        this.init();
    }

    init() {
        const accordions = document.querySelectorAll('.js-works-accordion');
        
        accordions.forEach(accordion => {
            const trigger = accordion.querySelector('.js-works-accordion-trigger');
            const content = accordion.querySelector('.js-works-accordion-content');

            trigger.addEventListener('click', () => {
                const isOpen = accordion.classList.contains('is-open');
                
                if (isOpen) {
                    accordion.classList.remove('is-open');
                    content.style.height = '0px';
                } else {
                    accordion.classList.add('is-open');
                    content.style.height = content.scrollHeight + 'px';
                }
            });
        });
    }
}

export function initWork() {
    new WorksAccordion();
}