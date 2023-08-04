
//habilitar el menu de navegacion
document.addEventListener('DOMContentLoaded', function () {//cuando el documento este cargado escuchamos
    eventListeners();
    darkMode();

});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    //creamos una funcion para poder manuipular el menu
    mobileMenu.addEventListener('click', menuResponsivo);



    //Contacto inteacccio con los datos del contacto
    //Seleccionamos todos lo imputs que tengan la etiqueta name pero a su vez filtramos por la name
    const formaContacto = document.querySelectorAll('input[name="contacto[contacto]"]');//utilizamos el selector de Atributos para poder seleccionar la forma de contacto

    //nota importante: el addEventListener no esta disponible cuanos usuamos document.querySelectorAll nos dara error, por eso en este caso usamos un foreach ay que tenemos mas de un valor  en formaCointacto 

    //Recorrremos el array para realizar un addEventListener de cada input
    formaContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));


}


function mostrarMetodosContacto(e) {

    //console.log('seleccionando');

    // //     //console.log('Seleccionando ...');

    // console.log(e.target.value);

    const contactoDiv = document.querySelector('#contacto');
    // // //    //contactoDiv.textContent = 'Diste Click';

    if (e.target.value === 'telefono') {

        //console.log('diste telefono');
        contactoDiv.innerHTML = `
        <label for="telefono">Numero Telefono:</label>
        <input type="tel" placeholder="Tu teléfono" id="telefono"  maxlength="9" name="contacto[telefono]" />

        <p>Elija la fecha y la hora para ser contactado</p>

                <!--Fecha-->
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="contacto[fecha]" />
    
                <!--Hora-->
                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]"/><!--Establecemos el minimo y maximo de horas-->
        `;


    } else {

        contactoDiv.innerHTML = `
        <!--email-->
        <label for="email">Email:</label>
        <input type="email" placeholder="Tu email" id="email" name="contacto[email]"/>
        
        `;
    }




}

function menuResponsivo() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');//el toggle hace los  mismo que el if de abajo en una sola linea

    //     //añdismo un clase nueva ya credada en css para mostrar los elaces
    //    if(navegacion.classList.contains('mostrar')){//comprobamos que la clase exista
    //     navegacion.classList.remove('mostrar');//si existe la eliminamos
    //    }else{
    //     navegacion.classList.add('mostrar');//sino la creamos
    //    }
}


/*****funcion de dark Mode***************** */
function darkMode() {

    //cambiar el modo oscuro de forma automatico detectando las preferencias del modo oscuro del sistema opertivo 
    const prefiereDarkMode = window.matchMedia('(prefers-colors-schema:dark)');//con esta sabemos la preferencias de dark mode del sistema del usuario, devulev tru o false
    //console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');

    } else {
        document.body.classList.remove('dark-mode');
    }


    //cambiar de forma automatica cuando el usuario cambia el modo en su sistema operativo
    prefiereDarkMode.addEventListener('change', function () {

        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');

        } else {
            document.body.classList.remove('dark-mode');
        }

    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function () {

        document.body.classList.toggle('dark-mode');




    });



}





