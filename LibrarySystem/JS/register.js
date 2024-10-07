document.addEventListener('DOMContentLoaded', () => {
    const fname = document.getElementById('first_name');
    const lname = document.getElementById('last_name');
    const pesel = document.getElementById('pesel');
    const libraryCardNumber = document.getElementById('library_card_number');
    const phone = document.getElementById('phone_number');
    const formMessage = document.querySelector(".errors");
    const form = document.querySelector("form");

    const namePattern = /^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/; // Only letters
    const phonePattern = /^\d{9,}$/; 

    form.addEventListener("submit", e => {
        e.preventDefault();
        let formErrors = [];

        //First Name Check
        if (!namePattern.test(fname.value) || fname.value.length < 2) {
            formErrors.push("Please enter a valid first name (letters only, at least 2 characters)");
        }

        if (!namePattern.test(lname.value) || lname.value.length < 3) {
            formErrors.push("Please enter a valid last name (letters only, at least 3 characters)");
        }

        // PESEL Check
        if (pesel.value.length !== 11 || !/^\d{11}$/.test(pesel.value)) {
            formErrors.push("PESEL must be exactly 11 digits");
        }

        //Phone Number Check 
        if (!phonePattern.test(phone.value)) {
            formErrors.push("Phone number must contain at least 9 digits");
        }

        if (formErrors.length === 0) {
            form.submit(); 
        } else {
            formMessage.style.display = "block";
            formMessage.innerHTML = `
                <h3 class="form-error-title">Please fix the following errors:</h3>
                <ul class="form-error-list" style="list-style: none; padding: 0;">
                    ${formErrors.map(el => `<li>${el}</li>`).join("")}
                </ul>
            `;
        }
    });
});
