document.addEventListener('DOMContentLoaded', function() {
    // Handle M.Sc. section toggle
    const mscCheckbox = document.getElementById('hasMsc');
    const mscDetails = document.getElementById('mscDetails');
    
    if (mscCheckbox && mscDetails) {
        mscCheckbox.addEventListener('change', function() {
            mscDetails.style.display = this.checked ? 'block' : 'none';
            
            // Reset M.Sc. fields when hiding the section
            if (!this.checked) {
                const mscInputs = mscDetails.querySelectorAll('input[type="number"], input[type="month"]');
                mscInputs.forEach(input => {
                    input.value = '';
                });
            }
        });
    }

    // Validate CGPA inputs
    const cgpaInputs = document.querySelectorAll('input[step="0.01"]');
    cgpaInputs.forEach(input => {
        input.addEventListener('input', function() {
            const value = parseFloat(this.value);
            if (value < 0 || value > 10) {
                this.setCustomValidity('CGPA must be between 0 and 10');
            } else {
                this.setCustomValidity('');
            }
        });
    });

    // Calculate overall CGPA
    function calculateOverallCGPA(degreeType) {
        const semesterInputs = document.querySelectorAll(`input[name^="${degreeType}_sem"]`);
        let totalCGPA = 0;
        let validSemesters = 0;

        semesterInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value) && value >= 0 && value <= 10) {
                totalCGPA += value;
                validSemesters++;
            }
        });

        return validSemesters > 0 ? (totalCGPA / validSemesters).toFixed(2) : 0;
    }
});