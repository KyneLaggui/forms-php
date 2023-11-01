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


// Client side validations
const registrationForm = document.querySelector("#registration-form");

registrationForm.addEventListener('submit', (e) => {
	e.preventDefault();
	// Input boxes
	const password = document.querySelector("#password");
	const confirmPassword = document.querySelector("#cpassword");
	const contactNumber = document.querySelector("#phone-input");
	const email = document.querySelector("#email");
	const age = document.querySelector("#age");
	// Input values
	const passwordValue = password.value;
	const cpasswordValue = confirmPassword.value;
	let hasError = false;

	if (passwordValue.length < 8) {
		invalidateInput('length-check', 'length-ex');
		hasError = true;
	} else {
		validateInput('length-check', 'length-ex');
	}

	if (/[A-Z]/.test(passwordValue)) {
		validateInput('uppercase-check', 'uppercase-ex');
	} else {
		invalidateInput('uppercase-check', 'uppercase-ex');
		hasError = true;
	}

	const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
	if (specialChars.test(passwordValue)) {
		validateInput('special-check', 'special-ex');
	} else {
		invalidateInput('special-check', 'special-ex')
		hasError = true;
	}

	if (/\d/.test(passwordValue)) {
		validateInput('number-check', 'number-ex');
	} else {
		invalidateInput('number-check', 'number-ex')
		hasError = true;
	}

	if (passwordValue === cpasswordValue) {
		validateInput('match-check', 'match-ex');
	} else {
		invalidateInput('match-check', 'match-ex');
		hasError = true;
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

	if (!hasError) {
		registrationForm.submit();
	}
})

// End of client side validations


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
    }
}

async function findMunicipality(provinceCode) {
    removeOptions(municipalitySelection);
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
	removeOptions(provinceSelection);
	for (let i = 0; i < provinces.length; i++) {
		let newOpt = document.createElement('option');
		newOpt.textContent = provinces[i]['name'];
		newOpt.code = provinces[i]['code'];
		newOpt.value = provinces[i]['name'];
		provinceSelection.appendChild(newOpt);
	}	
    for (let i = 0; i < cities.length; i++) {
		let newOpt = document.createElement('option');
		newOpt.textContent = cities[i]['name'];
		newOpt.code = cities[i]['code'];
		newOpt.value = cities[i]['name'];
		provinceSelection.appendChild(newOpt);
	}

    if (provinceSelection[provinceSelection.selectedIndex].value.toLowerCase().replace(/ /g,'').includes('city')) {
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
	for (let i = 0; i < regions.length; i++) {
		let newOpt = document.createElement('option');
		let clone = newOpt.cloneNode(true);
		newOpt.textContent = regions[i]['name'];
		newOpt.code = regions[i]['code'];
		newOpt.value = regions[i]['name'];
		clone.textContent = regions[i]['name'];
		clone.code = regions[i]['code'];
		clone.value = regions[i]['name'];
		regionSelection.appendChild(newOpt);
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