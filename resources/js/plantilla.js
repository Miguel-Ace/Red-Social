const btnSettins = document.querySelector('.btn-settins')
const datosEmpresa = document.querySelector('.datos-empresa')

btnSettins.onclick = () => {
    datosEmpresa.classList.toggle('oculto')
}