const errorMessage = document.querySelector('.error-message-reserva')
const horarioLimpieza = document.querySelectorAll('.horario-limpieza')
const loadingAnimation = document.querySelector('.loading-checkout')

export default function sendData(gcs_reserva_limpieza, allIds, daysCount, days) {
  loadingAnimation.style.display = 'block'
  if (errorMessage.classList.contains('animate-error-message')) errorMessage.classList.remove('animate-error-message')
  errorMessage.classList.add('hidden-button')
  function showErrorMessage() {
    loadingAnimation.style.display = 'none'
    errorMessage.innerText = 'Ha ocurrido un error. Por favor inténtelo más tarde o contáctenos para ayudarle.'
    errorMessage.classList.remove('hidden-button')
    errorMessage.classList.add('animate-error-message')
  }
  const hour = Array.from(horarioLimpieza).filter(input => input.checked)[0].value
  jQuery.ajax({
    type : "post",
    dataType : "json",
    url : gcs_reserva_limpieza.ajaxurl,
    data : {
      action: "gcs_go_to_cart",
      allIds: allIds,
      quantity: daysCount,
      days: days,
      hour: hour,
      security: gcs_reserva_limpieza.security
    },
    success: function(response) {
      if (response.success) {
        window.location = gcs_reserva_limpieza.redirect;
      } else {
        console.log(response)
        showErrorMessage()
      }
    },
    error: function() {
      showErrorMessage()
    }
  })
}