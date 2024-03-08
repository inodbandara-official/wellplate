document.addEventListener('DOMContentLoaded', function() {
    var bloodSugarLevel = document.getElementById('bloodSugarLevel');
    var age = document.getElementById('age');
    var cheatMeal = document.getElementById('cheatMeal');
    var generateBtn = document.getElementById('generateBtn');
    var message = document.getElementById('message');

    function validateInput() {
        if (bloodSugarLevel.value !== '' && parseInt(bloodSugarLevel.value, 10) >= 0 && age.value !== '') {
            generateBtn.disabled = false;
            message.style.display = 'none';
        } else {
            generateBtn.disabled = true;
        }
    }

    
    bloodSugarLevel.addEventListener('input', validateInput);
    age.addEventListener('change', validateInput);

    generateBtn.addEventListener('click', function() {
        if (generateBtn.disabled) {
            message.textContent = 'Please fill all details correctly';
            message.style.display = 'block';
        } else {
            console.log("Blood Sugar Level: " + bloodSugarLevel.value);
            console.log("Age: " + age.value);
            console.log("Cheat Meal Day: " + (cheatMeal.checked ? "Yes" : "No"));
            alert("Sucessfully generated");

        }
    });
});