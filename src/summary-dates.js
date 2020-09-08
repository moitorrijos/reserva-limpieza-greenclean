import moment from 'moment'
import getIds from './get-ids.js'
import noDates from './no-dates.js'
import sendData from './send-data.js'

export default function summaryDates(days) {
  const payButton = document.getElementById('ir-a-caja')
  const formularioReserva = document.forms['formulario-reserva']
  const allInputs = formularioReserva.getElementsByTagName('input')
  const allSelects = formularioReserva.getElementsByTagName('select')
  const allIds = getIds(allSelects, allInputs)
  moment.locale('es')

  payButton.removeEventListener('click', noDates)
  
  const dates = document.getElementById('fechas')
  let daysList = days.map(selectedDay => `
    <li>
      <span class="title-case">${moment(selectedDay).format('dddd D MMMM YYYY')}</span></li>
  `)

  dates.innerHTML = daysList.join('')
  
  const daysCount = daysList.length

  if (!daysList.length) {
    console.log('Por favor seleccione por lo menos una fecha en el calendario.')
    return
  } else {
    payButton.addEventListener('click', () => sendData(payButton, gcs_reserva_limpieza, allIds, daysCount, days))
  }
}