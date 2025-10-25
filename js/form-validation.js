// Preview functionality
function previewResume() {
    const form = document.querySelector('form');
    if (validateForm(new Event('submit'))) {
        // Store form data in sessionStorage
        const formData = new FormData(form);
        for (let pair of formData.entries()) {
            sessionStorage.setItem(pair[0], pair[1]);
        }
        
        // Open preview in new window
        window.open('preview.php', '_blank');
    }
}

// Form sections navigation
function initFormNavigation() {
    const sections = document.querySelectorAll('.form-section');
    const nav = document.createElement('div');
    nav.className = 'form-nav';
    
    sections.forEach(section => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'nav-btn';
        button.textContent = section.querySelector('h3, h4').textContent;
        button.onclick = () => section.scrollIntoView({ behavior: 'smooth' });
        nav.appendChild(button);
    });
    
    document.querySelector('.resume-form').prepend(nav);
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', validateForm);
        
        // Add real-time validation for fields
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });
    }
});

function validateField(field) {
    const fieldName = field.name;
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';

    switch(fieldName) {
        case 'fullname':
            if (value === '') {
                errorMessage = 'Full name is required';
                isValid = false;
            } else if (value.length < 2) {
                errorMessage = 'Name must be at least 2 characters long';
                isValid = false;
            }
            break;

        case 'mailid':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                errorMessage = 'Please enter a valid email address';
                isValid = false;
            }
            break;

        case 'mobno':
            const phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(value)) {
                errorMessage = 'Please enter a valid 10-digit mobile number';
                isValid = false;
            }
            break;

        case 'university':
            if (value === '') {
                errorMessage = 'University name is required';
                isValid = false;
            }
            break;

        case 'sscpercent':
        case 'hscpercent':
            const percent = parseFloat(value);
            if (isNaN(percent) || percent < 0 || percent > 100) {
                errorMessage = 'Please enter a valid percentage between 0 and 100';
                isValid = false;
            }
            break;

        case 'sem1pointer':
        case 'sem2pointer':
        case 'sem3pointer':
        case 'sem4pointer':
        case 'sem5pointer':
        case 'sem6pointer':
        case 'sem7pointer':
        case 'sem8pointer':
            const pointer = parseFloat(value);
            if (value !== '' && (isNaN(pointer) || pointer < 0 || pointer > 10)) {
                errorMessage = 'Please enter a valid pointer between 0 and 10';
                isValid = false;
            }
            break;
    }

    // Show/hide error message
    const errorSpan = getOrCreateErrorSpan(field);
    errorSpan.textContent = errorMessage;
    errorSpan.style.display = isValid ? 'none' : 'block';
    
    // Add/remove error class
    field.classList.toggle('error', !isValid);
    
    return isValid;
}

function getOrCreateErrorSpan(field) {
    let errorSpan = field.nextElementSibling;
    if (!errorSpan || !errorSpan.classList.contains('error-message')) {
        errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        errorSpan.style.color = 'red';
        errorSpan.style.fontSize = '12px';
        errorSpan.style.marginTop = '5px';
        field.parentNode.insertBefore(errorSpan, field.nextSibling);
    }
    return errorSpan;
}

function validateForm(event) {
    event.preventDefault();
    
    const form = event.target;
    const fields = form.querySelectorAll('input, select, textarea');
    let isValid = true;

    fields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    // Additional form-level validations
    const gender = form.querySelector('input[name="gender"]:checked');
    if (!gender) {
        isValid = false;
        alert('Please select your gender');
    }

    if (isValid) {
        // If all validations pass, submit the form
        form.submit();
    } else {
        // Scroll to the first error
        const firstError = form.querySelector('.error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Auto-save functionality
let autoSaveTimeout;
document.addEventListener('input', function(e) {
    if (e.target.form) {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            saveFormData(e.target.form);
        }, 1000);
    }
});

function saveFormData(form) {
    const formData = new FormData(form);
    const data = {};
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    localStorage.setItem('resumeFormData', JSON.stringify(data));
}

// Load saved form data
window.addEventListener('load', function() {
    const savedData = localStorage.getItem('resumeFormData');
    if (savedData) {
        const data = JSON.parse(savedData);
        const form = document.querySelector('form');
        if (form) {
            for (let key in data) {
                const field = form.querySelector(`[name="${key}"]`);
                if (field) {
                    if (field.type === 'radio') {
                        const radio = form.querySelector(`[name="${key}"][value="${data[key]}"]`);
                        if (radio) radio.checked = true;
                    } else {
                        field.value = data[key];
                    }
                }
            }
        }
    }
});