
export default function recommendedCleaning(areaValue) {
  const limpiezaRecomendada = document.getElementById('limpieza-recomendada')
  const general = document.getElementById('general-4-horas')
  const extendida = document.getElementById('general-extendida-8-horas')
  // const virus250 = document.getElementById('virus-250')
  // const virus251 = document.getElementById('virus-251')
  const firstArea = ['0-100', '101-150', '151-200', '201-250']
  if (firstArea.includes(areaValue)) {
    limpiezaRecomendada.innerText = general.value
    general.checked = true
    // virus250.classList.remove('hidden-button')
    // virus251.classList.add('hidden-button')
  } else {
    limpiezaRecomendada.innerText = extendida.value
    extendida.checked = true
    // virus251.classList.remove('hidden-button')
    // virus250.classList.add('hidden-button')
  }
}