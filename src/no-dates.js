
export default function noDates() {
  const mensajeError = document.querySelector('.error-message-reserva')

  mensajeError.classList.remove('hidden-button')
  mensajeError.classList.add('animate-error-message')
  mensajeError.innerText = 'Por favor, elige por lo menos una fecha en el calendario para reservar.'
}