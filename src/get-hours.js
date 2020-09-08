const horarioLimpieza = document.querySelectorAll('.horario-limpieza')
const horarioElegido = document.querySelector('.horario-elegido')

export default function getHours() {
  const horario = Array.from(horarioLimpieza).filter(input => input.checked)[0].value
  horarioElegido.innerText = horario
  return horario
}