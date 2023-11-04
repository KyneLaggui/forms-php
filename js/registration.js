// Check and exclamation displays
const validateInput = (checkElementId, exElementId) => {
	const checkElement = document.getElementById(checkElementId);
	const exElement = document.getElementById(exElementId);
	checkElement.style.display = 'inline';
	exElement.style.display = 'none'
}

const invalidateInput = (checkElementId, exElementId) => {
	const checkElement = document.getElementById(checkElementId);
	const exElement = document.getElementById(exElementId);
	checkElement.style.display = 'none';
	exElement.style.display = 'inline'
}

// Other input display
const otherGender = document.querySelector(".other-gender");
const gender = document.querySelector("#gender");

gender.addEventListener("change", () => {
	if (gender.value === 'others') {
		otherGender.style.display = 'block';
	} else {
		otherGender.style.display = 'none';
	}
})
// This is for detecting the default selected value in the gender dropdown on edit details
if (gender.value === 'others') {
	otherGender.style.display = 'block';
} else {
	otherGender.style.display = 'none';
}

// Client side validations
const registrationForm = document.querySelector("#registration-form");

// Input boxes
const password = document.querySelector("#password");
const confirmPassword = document.querySelector("#cpassword");
const contactNumber = document.querySelector("#phone-input");
const email = document.querySelector("#email");
const age = document.querySelector("#age");

// Detecting whether the it is on registration page or edit details page
let fileName = location.href.split("/").slice(-1); 

// For edit details page
let passwordValidations = document.querySelectorAll('.password-change');

const validateAllInput = (e = null) => {
	// Input values
	const passwordValue = password.value;
	const cpasswordValue = confirmPassword.value;

	let hasError = false;
	let changePassword = false;
	let onEditPage = fileName[0] === 'edit-details.php';
	
	if (onEditPage) {
		if (passwordValue !== "" || cpasswordValue !== "") {
			changePassword = true;
		}
	}

	
	passwordValidations.forEach((elem) => {
		if (changePassword) {
			elem.style.display = 'flex';
		} else {
			elem.style.display = 'none';
		}
	})
	

	// Detect if the event is submit hence prevent submission
	if (e !== null) {
		e.preventDefault();
	}
	
	if (!onEditPage || (onEditPage && changePassword)) {
		if ((passwordValue.length < 8 && !onEditPage) || (passwordValue.length < 8 && (onEditPage && changePassword))) {
			invalidateInput('length-check', 'length-ex');
			hasError = true;
		} else {
			validateInput('length-check', 'length-ex');
		}
	
		if ((/[A-Z]/.test(passwordValue) && !onEditPage) || (/[A-Z]/.test(passwordValue) && (onEditPage && changePassword))) {
			validateInput('uppercase-check', 'uppercase-ex');
		} else {
			invalidateInput('uppercase-check', 'uppercase-ex');
			hasError = true;
		}
	
		const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
		if ((specialChars.test(passwordValue) && !onEditPage) || (specialChars.test(passwordValue) && (onEditPage && changePassword))) {
			validateInput('special-check', 'special-ex');
		} else {
			invalidateInput('special-check', 'special-ex')
			hasError = true;
		}
	
		if ((/\d/.test(passwordValue) && !onEditPage) || (/\d/.test(passwordValue) && (onEditPage && changePassword))) {
			validateInput('number-check', 'number-ex');
		} else {
			invalidateInput('number-check', 'number-ex')
			hasError = true;
		}
	
		if ((passwordValue === cpasswordValue && passwordValue !== "" && cpasswordValue !== "" && !onEditPage) 
			|| (passwordValue === cpasswordValue && passwordValue !== "" && cpasswordValue !== "" && (onEditPage && changePassword))) {
			validateInput('match-check', 'match-ex');
		} else {
			invalidateInput('match-check', 'match-ex');
			hasError = true;
		}
	}
	

	if (contactNumber.value.replace(/[^\d]/g, '').length === 12) {
		validateInput('contact-check', 'contact-ex');
	} else {
		invalidateInput('contact-check', 'contact-ex')
		hasError = true;
	} 

	if (/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email.value)) {
		validateInput('email-check', 'email-ex');
	} else {
		invalidateInput('email-check', 'email-ex')
		hasError = true;
	}

	if (age.value >= 13) {
		validateInput('age-check', 'age-ex');
	} else {
		invalidateInput('age-check', 'age-ex')
		hasError = true;
	}
	
	if (!hasError && e && e.type === 'submit') {
		registrationForm.submit();
	}
}

registrationForm.addEventListener('submit', (e) => {
	validateAllInput(e);
})

age.addEventListener('change', validateAllInput);
email.addEventListener('change', validateAllInput);
contactNumber.addEventListener('change', validateAllInput);
password.addEventListener('change', validateAllInput);
confirmPassword.addEventListener('change', validateAllInput);
// End of client side validations
validateAllInput();

// Auto format input
const phoneNumberInput = document.getElementById('phone-input');
function formatPhoneNumber(value) {
	// Replaces even the addition sign
	let phoneNumber = value.replace(/[^\d]/g, '');
	phoneNumber = "+63" + phoneNumber.slice(2);
	const phoneNumberLength = phoneNumber.length;
	if (phoneNumberLength < 7) {
		return `${phoneNumber.slice(0, 3)} ${phoneNumber.slice(3, 6)}`;
	} 
	if (phoneNumberLength < 10) {
		return `${phoneNumber.slice(0, 3)} ${phoneNumber.slice(3, 6)}-${phoneNumber.slice(6, 9)}`;
	} 
	return `${phoneNumber.slice(0, 3)} ${phoneNumber.slice(3, 6)}-${phoneNumber.slice(6, 9)}-${phoneNumber.slice(9, 13)}`;
}

function phoneNumberFormatter() {
	const formattedInputValue = formatPhoneNumber(phoneNumberInput.value);
	phoneNumberInput.value = formattedInputValue;
}

phoneNumberInput.addEventListener('keydown', phoneNumberFormatter);
phoneNumberInput.addEventListener('focusout', phoneNumberFormatter);

const telNumberInput = document.querySelector('#tel-input');

function formatTelNumber(value) {
	let phoneNumber = value.replace(/[^\d]/g, '');
	return phoneNumber;
}

function telNumberFormatter() {
	const formattedInputValue = formatTelNumber(telNumberInput.value);
	telNumberInput.value = formattedInputValue;
}

telNumberInput.addEventListener('keydown', telNumberFormatter);
telNumberInput.addEventListener('focusout', telNumberFormatter);


const birthdate = document.querySelector("#birthdate");
const ageInput = document.querySelector("#age");
const ageLabel = document.querySelector("#age-label");

function ageFormatter() {
	let today = new Date();
    let birthDate = new Date(birthdate.value);
    let age = today.getFullYear() - birthDate.getFullYear();
    let m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

	ageLabel.style.top = '-14px';
	ageLabel.style.left = '0px';
    ageInput.value = age;
	let event = new Event('change');
	ageInput.dispatchEvent(event);
}

birthdate.addEventListener('input', ageFormatter);
// End of auto format inputs

// Automatic dropdown
const regionSelection = document.querySelector("#region");
const provinceSelection = document.querySelector("#province");
const municipalitySelection = document.querySelector("#municipality");
const barangaySelection = document.querySelector("#barangay");

async function findBarangay(municipalityCode) {
    let response;
    let barangays;
	let currentBarangay;
	if (fileName[0] === 'edit-details.php') {
		currentBarangay = barangaySelection.getAttribute('value');
	}
    if (provinceSelection.value.toLowerCase().replace(/ /g,'').includes('city')) {
        response = await fetch(`https://psgc.gitlab.io/api/cities/${municipalityCode}/barangays.json`);
        barangays = await response.json();
    } else {
        response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${municipalityCode}/barangays.json`);
        barangays = await response.json();
    }
    
    removeOptions(barangaySelection);
    for (let i = 0; i < barangays.length; i++) {
        let newOpt = document.createElement('option');
        newOpt.textContent = barangays[i]['name'];
        newOpt.code = barangays[i]['code'];
        newOpt.value = barangays[i]['name'];
        barangaySelection.appendChild(newOpt);
		if (currentBarangay === barangays[i]['name']) {
			newOpt.selected = 'selected;'
		}
    }
}

async function findMunicipality(provinceCode) {
    removeOptions(municipalitySelection);
	// This section is for edit details webpage
	let currentMunicipality;
	if (fileName[0] === 'edit-details.php') {
		currentMunicipality = municipalitySelection.getAttribute('value')
	}
	// End of section
    if (provinceSelection.value.toLowerCase().replace(/ /g,'').includes('city')) {
        let newOpt = document.createElement('option');
        newOpt.textContent = provinceSelection.value;
        newOpt.value = provinceSelection.value;
        municipalitySelection.appendChild(newOpt)
        municipalitySelection.value = provinceSelection.value
    } else {
        const response = await fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/municipalities.json`);
        const municipalities = await response.json();        
        for (let i = 0; i < municipalities.length; i++) {
            let newOpt = document.createElement('option');
            newOpt.textContent = municipalities[i]['name'];
            newOpt.code = municipalities[i]['code'];
            newOpt.value = municipalities[i]['name'];
            municipalitySelection.appendChild(newOpt);
			if (currentMunicipality === municipalities[i]['name']) {
				newOpt.selected = 'selected;'
			}
        }	
        for (let i = 0; i < municipalities.length; i++) {
            if (municipalities[i]['name'] === municipalitySelection.value) {
                findBarangay(municipalities[i]['code'])
            }
	    }
    }

	
	municipalitySelection.addEventListener('change', () => findBarangay(municipalitySelection[municipalitySelection.selectedIndex].code));
}

async function findProvince(regionCode) {
	const response = await fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces.json`);
	const provinces = await response.json();
    const secondResponse = await fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/cities.json`);
	const cities = await secondResponse.json();

	// This section is for edit details webpage
	let currentProvince;
	if (fileName[0] === 'edit-details.php') {
		currentProvince = provinceSelection.getAttribute('value')
	}
	// End of section

	removeOptions(provinceSelection);

	for (let i = 0; i < provinces.length; i++) {
		let newOpt = document.createElement('option');
		newOpt.textContent = provinces[i]['name'];
		newOpt.code = provinces[i]['code'];
		newOpt.value = provinces[i]['name'];
		provinceSelection.appendChild(newOpt);
		if (currentProvince === provinces[i]['name']) {
			newOpt.selected = 'selected;'
		}
	}	
    for (let i = 0; i < cities.length; i++) {
		let newOpt = document.createElement('option');
		newOpt.textContent = cities[i]['name'];
		newOpt.code = cities[i]['code'];
		newOpt.value = cities[i]['name'];
		provinceSelection.appendChild(newOpt);
		if (currentProvince === cities[i]['name']) {
			newOpt.selected = 'selected;'
		}
	}

    if (provinceSelection[provinceSelection.selectedIndex].value.toLowerCase().replace(/ /g,'').includes('city')) {
		// Empty string since you just need to trigger the function itself
        findMunicipality("");
        findBarangay(provinceSelection[provinceSelection.selectedIndex].code);
    } 

	for (let i = 0; i < provinces.length; i++) {
		if (provinces[i]['name'] === provinceSelection.value) {
			findMunicipality(provinces[i]['code'])
		}
	}
	
	provinceSelection.addEventListener('change', () => findMunicipality(provinceSelection[provinceSelection.selectedIndex].code));
	provinceSelection.addEventListener('change', () => {
        if (provinceSelection[provinceSelection.selectedIndex].value.toLowerCase().replace(/ /g,'').includes('city')) {
            findBarangay(provinceSelection[provinceSelection.selectedIndex].code)
        }
    });
}

async function generateRegions() {
	const response = await fetch(`https://psgc.gitlab.io/api/regions.json`);

	const regions = await response.json();
	// This section is for edit details webpage
	let currentRegion;
	if (fileName[0] === 'edit-details.php') {
		currentRegion = regionSelection.getAttribute('value')
	}
	// End of section
	if (currentRegion) {
		for (let i = 0; i < regions.length; i++) {
			let newOpt = document.createElement('option');
			newOpt.textContent = regions[i]['name'];
			newOpt.code = regions[i]['code'];
			newOpt.value = regions[i]['name'];
			if (currentRegion === regions[i]['name']) {
				newOpt.selected = 'selected;'
			}
			regionSelection.appendChild(newOpt);
		}	
	} else {
		for (let i = 0; i < regions.length; i++) {
			let newOpt = document.createElement('option');
			newOpt.textContent = regions[i]['name'];
			newOpt.code = regions[i]['code'];
			newOpt.value = regions[i]['name'];
			regionSelection.appendChild(newOpt);
		}	
	}
	
	for (let i = 0; i < regions.length; i++) {
		if (regions[i]['name'] === regionSelection.value) {
			findProvince(regions[i]['code'])
		}
	}
}
generateRegions()

regionSelection.addEventListener('change', () => findProvince(regionSelection[regionSelection.selectedIndex].code));

function removeOptions(selection) {
	if (selection.options) {
		var i, L = selection.options.length - 1;
		for(i = L; i >= 0; i--) {
		   selection.remove(i);
		}
	}
 }
 // End of automatic dropdown