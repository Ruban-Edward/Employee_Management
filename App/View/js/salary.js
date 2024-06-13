function addValidation(event) {
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    var los = document.getElementById("los").value;
    var addError = document.getElementById("addError");

    var valid = true;

    if (month === "" || year === "" || los === "") {
        addError.innerHTML = "Please Fill all the Mandatory Fields!";
        valid = false;

    }
    if (!valid) {
        event.preventDefault();
        setTimeout(function() {
            addError.innerHTML = "";
        }, 3000);
    }

    return false;
}