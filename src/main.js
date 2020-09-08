import calendar from './calendar.js'
import summaryServices from './summary-services.js'
import summaryHeader from './summary-header.js'
import getValues from './all-values.js'
import getPriceData from './get-price-data.js'
import recommendedCleaning from './recommended-cleaning.js'
import selectSanitization from './sanitization-toggle.js'
import selectCleaningTime from './select-cleaning-time.js'
import noDates from './no-dates.js'
import getHours from './get-hours.js'

document.addEventListener('DOMContentLoaded', () => {
  const formularioReserva = document.forms['formulario-reserva']
  const allInputs = formularioReserva.getElementsByTagName('input')
  const allSelects = formularioReserva.getElementsByTagName('select')
  const cleanArea = document.getElementById('clean-area')
  const habitaciones = document.getElementById('cantidad-habitaciones')
  const profunda8horas = document.querySelectorAll('.profunda-8-horas input')
  const values = getValues(allInputs, allSelects)

  calendar(allSelects, allInputs)
  recommendedCleaning(cleanArea.value)
  summaryHeader(values.select)
  summaryServices(values.input)
  getPriceData(allSelects, allInputs)
  selectSanitization(cleanArea.value)
  selectCleaningTime(habitaciones.value)
  getHours()

  habitaciones.addEventListener('change', () => {
    Array.from(profunda8horas).forEach(input => {
      console.log(input.checked)
    })
  })
  
  formularioReserva.addEventListener('change', () => {
    const values = getValues(allInputs, allSelects)
    summaryHeader(values.select)
    summaryServices(values.input)
    getPriceData(allSelects, allInputs)
    selectCleaningTime(habitaciones.value)
    getHours()
  })
  
  cleanArea.addEventListener('change', () => {
    selectSanitization(cleanArea.value)
    recommendedCleaning(cleanArea.value)
  })

  document.getElementById('ir-a-caja').addEventListener('click', noDates)

})