const frmEmployee = document.querySelector('#frmEmployee');
const inputName = document.querySelector('#name');
const inputLastname = document.querySelector('#lastname');
const inputPosition = document.querySelector('#position');
const inputSalary = document.querySelector('#salary');
const btnCancel = document.querySelector('#btnCancel');
const contentTitle = document.querySelector('#contentTitle');
const btnAction = document.querySelector('#btnAction');
const titleForm = document.querySelector('#titleForm');
const idEmployee = document.querySelector('#idEmployee');


// Tabla
const tblEmployee = document.querySelector('#tblEmployee tbody');


document.addEventListener('DOMContentLoaded', () => {
    frmEmployee.addEventListener('submit', validateEmployee);
    btnCancel.addEventListener('click', () => {
        resetForm();
    });
    list();
});

function validateEmployee(e) {
    e.preventDefault();

    let validations = [
        validate(inputSalary, 'salario', 10),
        validate(inputPosition, 'puesto', 50),
        validate(inputLastname, 'apellido', 50),
        validate(inputName, 'nombre', 50)
    ];

    const errors = validations.filter(v => !v.valid);

    if (errors.length > 0) {
        errors.forEach(err => showAlert(err.msg, 'danger'));
        return;
    }

    sendData();
}

// Enviar datos
async function sendData() {
    const url = new URL('save.php', location.origin);

    const data = new FormData(frmEmployee);
    try {
        const request = await fetch(url, {
            method: 'POST',
            body: data
        });
        const res = await request.json();
        showAlert(res.msg, res.type);
        if ( res.type === 'success') {
            frmEmployee.reset();
            list();
            resetForm();
        }
    } catch (error) {
        console.error(error);
    }
}

//Listar empleados
async function list() {
    const url = new URL('list.php', location.origin);
    try {
        const request = await fetch(url);
        const res = await request.json();

        printHtml(res);

    } catch (error) {
        console.log(error);
    }
}

function printHtml(employees) {
    cleanHtml();
    const fragment = document.createDocumentFragment();
    employees.forEach(employee => {
        const { id, name, lastname, position, salary } = employee;
        const sal = parseFloat(salary).toFixed(2);
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${name}</td>
            <td>${lastname}</td>
            <td>${position}</td>
            <td>$${sal}</td>
            <td>
                <button class="btn btn-info btn-sm" type="button" onclick="loadEdition(${id})"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger btn-sm" type="button"><i class="bi bi-trash"></i></button>
            </td>
        `;
        fragment.appendChild(tr);
    });
    tblEmployee.appendChild(fragment);
}

// Cargar edición
async function loadEdition(id) {
    const url = new URL('edit.php', location.origin);
    try {
        const request = await fetch(url, {
            method: 'POST',
            body: id
        });
        const res = await request.json();
        
        idEmployee.value = res.id;
        inputName.value = res.name;
        inputLastname.value = res.lastname;
        inputPosition.value = res.position;
        inputSalary.value = res.salary;
        changeFormEdit();
        
    } catch (error) {
        console.error(error);
    }
}

// Cabiar formulario para edición
function changeFormEdit() {
    btnCancel.classList.remove('d-none');
    contentTitle.classList.remove('bg-primary');
    contentTitle.classList.add('bg-info');
    titleForm.textContent = 'Editar Empleado';
    btnAction.classList.remove('bg-primary');
    btnAction.classList.add('bg-info');
    btnAction.textContent = 'Guardar Cambios';
}

// Resetear formulario
function resetForm() {
    idEmployee.value = '';
    btnCancel.classList.add('d-none');
    contentTitle.classList.add('bg-primary');
    contentTitle.classList.remove('bg-info');
    titleForm.textContent = 'Crear Empleado';
    btnAction.classList.add('bg-primary');
    btnAction.classList.remove('bg-info');
    btnAction.textContent = 'Crear Empelado';
    frmEmployee.reset();
}

// Limpiar htm previo
function cleanHtml() {
    while ( tblEmployee.firstChild ) {
        tblEmployee.removeChild(tblEmployee.firstChild);
    }
}

// Validar campos
function validate(input, inputText, maxLength) {
    const inputValue = input.value.trim();
    const regex = /^[^\';:"`]+$/;

    if ( inputValue === '' ) {
        return { valid: false, msg: `El ${inputText} es requerido`};
    }

    if (inputValue.length > maxLength) {
        input.value = '';
        return { valid: false, msg: `Has sobrepasado los ${maxLength} permitidos` }
    }

    if ( !regex.test(inputValue) ) {
        input.value = '';
        return { valid: false, msg: 'Estas utilizando caracteres no permitidos' }
    }

    return { valid: true }

}

// Generea las alertas
function showAlert(message, type) {
    const alertNotRepeat = document.querySelector('.alert');
    if ( alertNotRepeat ) alertNotRepeat.remove();

    const div = document.createElement('div');
    div.classList.add('alert', 'py-1', 'text-center', 'fw-bold', 'mt-1', `alert-${type}`);
    div.textContent = message;

    const insertAlert = document.querySelector('.insert-alert');

    insertAlert.insertBefore(div, frmEmployee);

    setTimeout(() => div.remove(), 4000);
}
