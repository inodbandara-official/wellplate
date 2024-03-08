const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', () => {
                // Move other dropdowns down
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.querySelector('.content').style.transform = 'translateY(10px)';
                    }
                });
            });

            dropdown.addEventListener('mouseleave', () => {
                // Reset other dropdowns' margin
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.querySelector('.content').style.transform = 'translateY(0)';
                    }
                });
            });
        });