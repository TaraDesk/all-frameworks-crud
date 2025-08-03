const modals = document.querySelectorAll('[id$="-modal"]');
const toggleElements = document.querySelectorAll('[data-toggle]');

toggleElements.forEach(open => {
    const modalId = open.dataset.toggle;
    const modal = document.getElementById(modalId);

    open.addEventListener('click', () => {
        const inputs = modal.querySelectorAll('input')
        if (inputs) {
            inputs.forEach(input => {
                input.disabled = false;
            });
        }

        modal.classList.remove('hidden');
    })
});

modals.forEach(modal => {
    const closeBtn = modal.querySelectorAll('.close');
    const toggleBtn = modal.querySelectorAll('[data-switch');

    closeBtn.forEach(close => {
        close.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    });

    toggleBtn.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const modalId = toggle.dataset.switch;
            const modalTarget = document.getElementById(modalId);

            const inputs = modal.querySelectorAll('input')
            if (inputs) {
                inputs.forEach(input => {
                    input.disabled = false;
                });
            }

            modal.classList.add('hidden');
            modalTarget.classList.remove('hidden');

            const inputsTarget = modalTarget.querySelectorAll('input')
            if (inputsTarget) {
                inputsTarget.forEach(input => {
                    input.disabled = false;
                });
            }
        });
    })

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }        
    });
});

const overlay = document.getElementById('success-overlay');

if (overlay) {
    function closeSuccessOverlay() {
        overlay.style.opacity = '0';
        const modal = overlay.querySelector('.scale-95');
        modal.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 200);
    }

    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            closeSuccessOverlay();
        }
    });
}

const userMenuButton = document.getElementById('user-menu-button');
const userMenu = document.getElementById('user-menu');

if(userMenuButton) {
    userMenuButton.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
    });
    
    document.addEventListener('click', (event) => {
        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });
}

const imagePreviewContainer = document.getElementById('image-preview-container');

if (imagePreviewContainer) {
    const imageInput = document.getElementById('image');
    const imagePreview = imagePreviewContainer.querySelector('img');
    
    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
            imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
}