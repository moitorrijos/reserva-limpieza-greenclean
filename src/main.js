import summaryServices from './summary-services.js'
import calendar from './calendar.js'
import summaryHeader from './summary-header.js'
import getValues from './all-values.js'
import getPriceData from './get-price-data.js'
import recommendedCleaning from './recommended-cleaning.js'
import selectSanitization from './sanitization-toggle.js'
import selectCleaningType from './select-cleaning-type.js'
import isDeepCleaningChecked from './is-deep-cleaning-checked.js'
import noDates from './no-dates.js'
import getHours from './get-hours.js'
import getIds from './get-ids.js'
import sendData from './send-data.js'

document.addEventListener('DOMContentLoaded', () => {
  const formularioReserva = document.forms['formulario-reserva']
  const allInputs = formularioReserva.getElementsByTagName('input')
  const allSelects = formularioReserva.getElementsByTagName('select')
  const cleanArea = document.getElementById('clean-area')
  const habitaciones = document.getElementById('cantidad-habitaciones')
  const profunda8horas = document.querySelectorAll('.profunda-8-horas')
  const general4horas = document.getElementById('general-4-horas')
  const horario1pm = document.getElementById('hora-100-pm')
  const values = getValues(allInputs, allSelects)
  const fechasList = document.querySelector('ul.fechas')
  const payButton = document.getElementById('ir-a-caja')
  let days = []
  let allIds = []
  const terminosCondiciones = document.getElementById('terminos-condiciones')

  calendar(allSelects, allInputs)

  const eventoReservado = Array.from(document.querySelectorAll('a.fc-daygrid-event'))
  eventoReservado.forEach( evento => evento.classList.add('evento-reservado') )
  
  recommendedCleaning(cleanArea.value)
  summaryHeader(values.select)
  summaryServices(values.input)
  getPriceData(allSelects, allInputs)
  selectSanitization(cleanArea.value)
  selectCleaningType(habitaciones.value)
  
  habitaciones.addEventListener('change', () => {
    isDeepCleaningChecked(profunda8horas, habitaciones)
  })

  cleanArea.addEventListener('change', () => {
    const deepCleaning = Array
      .from(profunda8horas)
      .filter( label => label.firstElementChild.checked )[0]

    if (deepCleaning && deepCleaning !== undefined) {
      recommendedCleaning(cleanArea.value, deepCleaning.firstElementChild)
    } else {
      recommendedCleaning(cleanArea.value, false)
      selectSanitization(cleanArea.value)
    }
  })

  formularioReserva.addEventListener('change', () => {
    const values = getValues(allInputs, allSelects)
    summaryHeader(values.select)
    summaryServices(values.input)
    getPriceData(allSelects, allInputs)
    selectCleaningType(habitaciones.value)
    getHours(allSelects, allInputs)
    if (!general4horas.checked) {
      horario1pm.disabled = true
    } else {
      horario1pm.disabled = false
    }
  })

  getHours(allSelects, allInputs)

  const config = { childList: true, subtree: true };

  const newDaysArray = function(mutationsList) {
    mutationsList.forEach(mutation => {
      if (mutation.type === 'childList') {
        days = Array.from(mutation.target.children).map(child => child.dataset.day)
        allIds = getIds(allSelects, allInputs)
      }
    })
  };

  // Create an observer instance linked to the newDaysArray function
  const observer = new MutationObserver(newDaysArray);

  // The newDaysArray fires whenever there is a "mutation" in fechasList (ul.fechas element)
  observer.observe(fechasList, config);

  // Toggle pay button when terms and conditions is accepted.
  terminosCondiciones.addEventListener('change', () => {
    if (terminosCondiciones.checked) {
      payButton.disabled = false;
    } else {
      payButton.disabled = true;
    }
  })

  payButton.addEventListener('click', () => {
    if (days.length === 0 || allIds.length === 0) {
      noDates()
      return
    } else {
      sendData(payButton, gcs_reserva_limpieza, allIds, days.length, days)
    }
  })

})