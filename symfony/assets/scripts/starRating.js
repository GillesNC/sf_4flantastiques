export default function starRating() {
    const starGroups = document.querySelectorAll('.form-star');
    starGroups.forEach(group => {
        const labels = group.querySelectorAll('label');

        labels.forEach((label, index) => {
            label.addEventListener('click', () => {
                labels.forEach((l, i) => {
                    if (i <= index) {
                        l.classList.add('active');
                    } else {
                        l.classList.remove('active');
                    }
                });
            });

            label.addEventListener('mouseenter', () => {
                labels.forEach((l, i) => {
                    if (i <= index) {
                        l.classList.add('hover');
                    } else {
                        l.classList.remove('hover');
                    }
                });
            });
        });

        group.addEventListener('mouseleave', () => {
            labels.forEach(l => l.classList.remove('hover'));
        });
    });
}
