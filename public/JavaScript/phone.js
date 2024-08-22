document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector("#countryCode");
    var iti = window.intlTelInput(input, {
        initialCountry: "pk", // Set initial country to Pakistan
        separateDialCode: true,
        preferredCountries: ["pk", "us", "gb"], // Add any preferred countries
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // Handle country code input change
    input.addEventListener('input', function() {
        var countryCode = input.value.replace(/\D/g, '');
        if (countryCode.length > 0) {
            var countryData = iti.getCountryData();
            var country = countryData.find(function(country) {
                return country.dialCode.startsWith(countryCode);
            });
            if (country) {
                iti.setCountry(country.iso2);
            }
        }
    });

    // Handle country change event
    input.addEventListener("countrychange", function() {
        var selectedCountryData = iti.getSelectedCountryData();
        document.getElementById('phoneNumber').placeholder = "Enter phone number"; // Reset placeholder
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector("#countryCodee");
    var iti = window.intlTelInput(input, {
        initialCountry: "pk", // Set initial country to Pakistan
        separateDialCode: true,
        preferredCountries: ["pk", "us", "gb"], // Add any preferred countries
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // Handle country code input change
    input.addEventListener('input', function() {
        var countryCode = input.value.replace(/\D/g, '');
        if (countryCode.length > 0) {
            var countryData = iti.getCountryData();
            var country = countryData.find(function(country) {
                return country.dialCode.startsWith(countryCode);
            });
            if (country) {
                iti.setCountry(country.iso2);
            }
        }
    });

    // Handle country change event
    input.addEventListener("countrychange", function() {
        var selectedCountryData = iti.getSelectedCountryData();
        document.getElementById('phoneNumberr').placeholder = "Enter phone number"; // Reset placeholder
    });
});