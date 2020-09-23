import calendar from './calendar.js'
import summaryServices from './summary-services.js'
import summaryHeader from './summary-header.js'
import getValues from './all-values.js'
import getPriceData from './get-price-data.js'
import recommendedCleaning from './recommended-cleaning.js'
import selectSanitization from './sanitization-toggle.js'
import selectCleaningType from './select-cleaning-type.js'
import isDeepCleaningChecked from './is-deep-cleaning-checked.js'
import noDates from './no-dates.js'
import getHours from './get-hours.js'

document.addEventListener('DOMContentLoaded', () => {
  const formularioReserva = document.forms['formulario-reserva']
  const allInputs = formularioReserva.getElementsByTagName('input')
  const allSelects = formularioReserva.getElementsByTagName('select')
  const cleanArea = document.getElementById('clean-area')
  const habitaciones = document.getElementById('cantidad-habitaciones')
  const profunda8horas = document.querySelectorAll('.profunda-8-horas')
  const values = getValues(allInputs, allSelects)

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
    getHours()
  })

  getHours()  

  document.getElementById('ir-a-caja').addEventListener('click', noDates)

})