const tituloTablaEmpresa = document.querySelectorAll('.titulo-tabla-empresa')
const iconCambio = document.querySelector('.icon')
const tablas = document.querySelectorAll('table')
const ti = JSON.parse(localStorage.getItem('ti'))

if (ti) {
    tablas.forEach(item => {
        item.classList.toggle('mostrarTabla')
    })
    tituloTablaEmpresa.forEach(item => {
        item.classList.toggle('activo')
    })
}

iconCambio.onclick = () => {
    tablas.forEach(item => {
        item.classList.toggle('mostrarTabla')
    })

    tituloTablaEmpresa.forEach(item => {
        item.classList.toggle('activo')
    })

    iconCambio.classList.add('rotar')
    setTimeout(() => {
        iconCambio.classList.remove('rotar')
    }, 300)

    const ti = JSON.parse(localStorage.getItem('ti'))
    if (ti) {
        localStorage.setItem('ti',0)
        // console.log('0')
    }else{
        localStorage.setItem('ti',1)
        // console.log('1')
    }
}