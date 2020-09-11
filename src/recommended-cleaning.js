
export default function recommendedCleaning(areaValue, cleaningType) {
  const limpiezaRecomendada = document.getElementById('limpieza-recomendada')
  const general = document.getElementById('general-4-horas')
  const extendida = document.getElementById('general-extendida-8-horas')
  const firstArea = ['0-100', '101-150', '151-200', '201-250']
  if ( cleaningType ) {
    limpiezaRecomendada.innerText = cleaningType.value
    extendida.checked
  } else if ( firstArea.includes(areaValue) ) {
    limpiezaRecomendada.innerText = general.value
    general.checked = true
  } else {
    limpiezaRecomendada.innerText = extendida.value
    extendida.checked = true
  }
}