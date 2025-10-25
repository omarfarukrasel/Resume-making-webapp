function addNewCollege() {
    const newCollegeInput = document.getElementById('new-college-input');
    const collegeSelect = document.querySelector('select[name="college"]');
    
    if (newCollegeInput.style.display === 'none') {
        newCollegeInput.style.display = 'block';
        collegeSelect.disabled = true;
    } else {
        newCollegeInput.style.display = 'none';
        collegeSelect.disabled = false;
    }
}

function addNewBranch() {
    const newBranchInput = document.getElementById('new-branch-input');
    const branchSelect = document.querySelector('select[name="branch"]');
    
    if (newBranchInput.style.display === 'none') {
        newBranchInput.style.display = 'block';
        branchSelect.disabled = true;
    } else {
        newBranchInput.style.display = 'none';
        branchSelect.disabled = false;
    }
}

// Validate education fields
document.addEventListener('DOMContentLoaded', function() {
    const educationFields = document.querySelectorAll('.education-section input, .education-section select');
    
    educationFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateEducationField(this);
        });
    });
});

function validateEducationField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';

    switch(field.name) {
        case 'ssc_school':
        case 'hsc_college':
        case 'university':
            if (value === '') {
                errorMessage = 'This field is required';
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

        case 'sscdate':
        case 'hscdate':
            if (value === '') {
                errorMessage = 'Please select a date';
                isValid = false;
            }
            break;
    }

    // Show/hide error message
    const errorSpan = getOrCreateErrorSpan(field);
    errorSpan.textContent = errorMessage;
    errorSpan.style.display = isValid ? 'none' : 'block';
    
    // Add/remove error class
    field.classList.toggle('is-invalid', !isValid);
    
    return isValid;
}

function getOrCreateErrorSpan(field) {
    let errorSpan = field.nextElementSibling;
    if (!errorSpan || !errorSpan.classList.contains('invalid-feedback')) {
        errorSpan = document.createElement('div');
        errorSpan.className = 'invalid-feedback';
        field.parentNode.insertBefore(errorSpan, field.nextSibling);
    }
    return errorSpan;
}