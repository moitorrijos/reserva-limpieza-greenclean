import moment from 'moment'

export default function summaryDates(days) {
  moment.locale('es')

  const dates = document.getElementById('fechas')
  let daysList = days.map(selectedDay => `
    <li data-day="${moment(selectedDay).format('YYYYMMDD')}">
      <span class="title-case">
        ${moment(selectedDay).format('dddd D MMMM YYYY')}
      </span>
    </li>
  `)

  dates.innerHTML = daysList.join('')
  
}