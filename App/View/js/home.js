function openModal(action, id = null) {
    const modalTitle = document.getElementById('addModalTitle');
    const modalSubmitBtn = document.getElementById('modalSubmitBtn');
    const form = document.getElementById('addEmp');

    if (action === 'create') {
        modalTitle.textContent = 'New Employee';
        modalSubmitBtn.textContent = 'Add Employee';
        form.action = 'index.php?controller=Employee&action=addEmployee';
        clearForm();
    } else if (action === 'update') {
        modalTitle.textContent = 'Update Employee';
        modalSubmitBtn.textContent = 'Update';
        var emp_id = id['emp_id'];
        form.action = 'index.php?controller=Employee&action=updateEmployee&id=' + emp_id;
        fetchEmployeeData(id);
    } else if (action === 'delete') {
        modalTitle.textContent = 'Delete Employee';
        var emp_id = id['emp_id'];
        displayDeleteMessage(id);
    }
}

function clearForm() {
    const warning = document.getElementById('warning');
    const formDisplay = document.getElementById('form');
    const modalSubmitBtn = document.getElementById("modalSubmitBtn");
    formDisplay.style.display = "block";
    warning.style.display = "none";
    modalSubmitBtn.style.display = "block";
    document.getElementById('name').value = '';
    document.getElementById('dob').value = '';
    document.getElementById('doj').value = '';
    document.getElementById('designation').value = '';
    document.getElementById('salary').value = '';
    document.getElementById('address').value = '';
    document.getElementById('city').value = '';
    document.getElementById('state').value = '';
    document.getElementById('country').value = '';
}

function fetchEmployeeData(id) {
    console.log(id);
    const warning = document.getElementById('warning');
    const formDisplay = document.getElementById('form');
    const modalSubmitBtn = document.getElementById("modalSubmitBtn");
    formDisplay.style.display = "block";
    warning.style.display = "none";
    modalSubmitBtn.style.display = "block";
    document.getElementById('name').value = id['name'];
    document.getElementById('dob').value = id['dob'];
    document.getElementById('doj').value = id['doj'];
    document.getElementById('designation').value = id['d_id'];
    document.getElementById('salary').value = id['salary'];
    document.getElementById('address').value = id['address'];
    document.getElementById('city').value = id['c_id'];
    document.getElementById('state').value = id['s_id'];
    document.getElementById('country').value = id['country_id'];

}

function displayDeleteMessage(id) {
    const warning = document.getElementById('warning');
    const formDisplay = document.getElementById('form');
    const deleteMess = document.getElementById('deleteMess');
    const modalSubmitBtn = document.getElementById("modalSubmitBtn");
    const deleteEmp = document.getElementById("deleteEmp");

    var emp_id = id['emp_id'];
    // Correctly set the action of the delete form
    deleteEmp.action = 'index.php?controller=Employee&action=deleteEmployee&id=' + emp_id;

    formDisplay.style.display = "none";
    warning.style.display = "block"
    modalSubmitBtn.style.display = "none";

    var name = id['name'];
    var capitalized_name = name.charAt(0).toUpperCase() + name.slice(1);
    deleteMess.innerHTML = "Are you sure you want to delete Employee " + capitalized_name + " details?";
}


function addValidation(event) {
    var name = document.getElementById("name").value;
    var dob = document.getElementById("dob").value;
    var doj = document.getElementById("doj").value;
    var designation = document.getElementById("designation").value;
    var salary = document.getElementById("salary").value;
    var city = document.getElementById("city").value;
    var state = document.getElementById("state").value;
    var country = document.getElementById("country").value;
    var addError = document.getElementById("addError");

    var valid = true;

    if (name === "" || dob === "" || doj === "" || designation === "" ||
        city === "" || state === "" || country === "" || salary === "") {
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

function managerDel() {
    swal("Oops !", "Contact Hr to Delete Employee", "warning");
}

function empButton() {
    swal("Sorry !", "You don't have access to Modify details", "warning");
}

function empSal() {
    swal("Sorry !", "You can't see others Salary", "error");

}