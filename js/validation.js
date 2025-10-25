function validateForm() {
    let isValid = true;
    const errors = [];

    // Validate full name
    const fullname = document.getElementById('fullname').value;
    if (!fullname || fullname.trim() === '') {
        errors.push('Full name is required');
        isValid = false;
    }

    // Validate email
    const email = document.getElementById('mailid').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailRegex.test(email)) {
        errors.push('Valid email address is required');
        isValid = false;
    }

    // Validate mobile number
    const mobno = document.getElementById('mobno').value;
    const phoneRegex = /^[0-9]{10}$/;
    if (!mobno || !phoneRegex.test(mobno)) {
        errors.push('Valid 10-digit mobile number is required');
        isValid = false;
    }

    // Display errors if any
    const errorDiv = document.getElementById('form-errors');
    if (!isValid && errorDiv) {
        errorDiv.innerHTML = errors.map(error => `<div class="alert alert-danger">${error}</div>`).join('');
    }

    return isValid;
}

// Add realtime validation
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateForm();
        });
    });
});