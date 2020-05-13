// Variables
const form = document.getElementById('register');
const btnSend =  document.getElementById('btnSend');
 
const name = document.getElementById('name');
const lastName = document.getElementById('lastName');
const email = document.getElementById('email');
const password = document.getElementById('password');
const terms = document.getElementById('terms');

const formIsValid ={
    name: false,
    lastName: false,
    email: false,
    password: false,
    terms: false,
}


eventlisteners();

function eventlisteners(){
    
    document.addEventListener('DOMContentLoaded', inicioAPP);
    email.addEventListener('blur', validarCampo);
    name.addEventListener('blur', validarCampo);
    lastName.addEventListener('blur', validarCampo);
    password.addEventListener('blur', validarCampo);
    terms.addEventListener('blur', validarCampo);
    btnSend.addEventListener('click',enviarRegistro);

    form.addEventListener('submit', (e)=>{
        e.preventDefault();
    })

    console.log('begin');
}



// Funciones
function inicioAPP(){
    //deshabilita el envio
    //btnSend.disabled = true;
   /* name.oninvalid = function(event) {
        event.target.setCustomValidity('Nombre requerido');
    }
    lastName.oninvalid = function(event) {
        event.target.setCustomValidity('Apellido requerido');
    }
    password.oninvalid = function(event) {
        event.target.setCustomValidity('Contraseña requerida');
    }*/
}

// Valida que el campo tenga algo
function validarCampo(){

    // Se valida la longitud del texto y que no este vacio
   if (this.type !== 'checkbox') {
    validarLongitud(this);
   } else {
        formIsValid[this.id] = this.checked;
   }
    
    console.log(this.type);
    console.log(this.id);

    let errores = document.querySelectorAll('.error');

    //validar unicamente email
    if(this.type === 'email'){
        validarEmail(this);
    }

    if(email.value !== '' && name.value !== '' && lastName.value !== '' && password.value !== '' ) {
        if(errores.length === 0){
            //btnSend.disabled = false;
        }
    }
}

function validarLongitud(campo){
    let span = document.getElementById('span_'+campo.id);
    if(campo.value.length >0) {
        campo.classList.remove('error');
        span.classList.add('error-span');
        formIsValid[campo.id]=true;
    } else {
        campo.classList.add('error');
        span.classList.remove('error-span');
        span.innerText = 'Campo obligatorio'
        formIsValid[campo.id]=false;
    }
   // console.table(formIsValid);
}

function  validarEmail(campo){
    const email = campo.value;
    const message_email = 'Vaya, no parece un e-mail válido… ¿Están la @ y el . en su sitio?';

  
    if (email !== '') {
    let span = document.getElementById('span_'+campo.id);
        //if(mensaje.indexOf('@') !== -1) {
        let regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (regex.test(email)){
            campo.classList.remove('error')
            span.classList.add('error-span');
            formIsValid[campo.id]=true;
        } else {
            campo.classList.add('error')
            span.classList.remove('error-span');
            span.innerText = message_email;
            formIsValid[campo.id]=false;
            campo.oninvalid = function(event) {
                event.target.setCustomValidity(message_email);
            }
        }
    }
}

function enviarRegistro(e){
   // console.log(e);
   // console.log('Click');
    name.blur;
    lastName.blur;
    email.blur;
    password.blur;
    const opcionesForm = Object.values(formIsValid);
    
    let validar = opcionesForm.filter(values => values == false);
    console.log(validar.length);
    console.table(validar)
}

// resetear el formulario
function resetFormulario(e){
    // formEnviar.reset();
   // e.preventDefault();
}