/**/

function typeWrite(elemento){
    const textoArray = elemento.innerHTML.split('');
    elemento.innerHTML = '';
    textoArray.forEach((letra, i) =>{
        setTimeout(() =>
            elemento.innerHTML += letra, 75 * i)
    });
    console.log(textoArray);
}
const titulo = document.querySelector('p.text-white');
typeWrite(titulo);