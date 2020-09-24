import getPriceData from './get-price-data'

const horarioLimpieza = document.querySelectorAll('.horario-limpieza')
const horarioElegido = document.querySelector('.horario-elegido')
const fechas = document.querySelector('ul#fechas')

export default function getHours(allSelects, allInputs) {
  const horario = Array.from(horarioLimpieza).filter(input => input.checked)[0].value
  const quantity = fechas.childElementCount
  horarioElegido.innerText = horario
  getPriceData(allSelects, allInputs, quantity)
}