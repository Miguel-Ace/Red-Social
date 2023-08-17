const selectBuscadorEmpresa = document.querySelector('.buscador-empresa')
const losTd = document.querySelectorAll('tbody tr')

selectBuscadorEmpresa.addEventListener('change', () => {
    losTd.forEach(td => {
        const idEmpresaTd = td.querySelector('td:nth-child(2)')
        const idEmpresaSelect = selectBuscadorEmpresa.value
        
        if (idEmpresaSelect == idEmpresaTd.textContent) {
            td.style.display = ''
            console.log();
        }else{
            td.style.display = 'none'
        }
    })
})