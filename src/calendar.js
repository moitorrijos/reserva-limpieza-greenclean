import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import esLocale from '@fullcalendar/core/locales/es'
import interactionPlugin from '@fullcalendar/interaction'
import momentPlugin from '@fullcalendar/moment'
import moment from 'moment'
import summaryDates from './summary-dates.js'
import getPriceData from './get-price-data.js'

export default function calendar(allSelects, allInputs) {
  const calendarEl = document.getElementById('calendar')
  const currentDay = new Date()
  let days = []
  moment.locale('es')
  const reservados = gcs_reserva_limpieza.limpiezas.map(date => {
    return {
      title: "Reservado",
      start: date,
      allDay: true
    }
  })
  const holidays = gcs_reserva_limpieza.gcs_holidays.map(date => {
    return {
      title: "Feriado",
      start: date,
      allDay: true
    }
  })
  const reservedDates = reservados.concat(holidays)
  const calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, interactionPlugin, momentPlugin ],
    locale: esLocale,
    selectable: true,
    fixedWeekCount: false,
    contentHeight: "auto",
    height: "auto",
    titleFormat: 'MMMM YYYY',
    eventDisplay: 'block',
    headerToolbar: {
      start: 'prev',
      center: 'title',
      end: 'next',
    },
    validRange: {
      start: currentDay
    },
    events: reservedDates,
    dateClick(info) {
      const beforeInfoEvents = calendar.getEvents()
      const eventsThisDay = beforeInfoEvents.filter(event => event.startStr === info.dateStr )
      if (eventsThisDay.length >= 1)  return
      if (info.dayEl.classList.contains('fc-day-sun')) return
      calendar.addEvent({
        title: 'Limpieza',
        start: info.date,
        allDay: true
      })
      const events = calendar.getEvents()
      const myCleaningDays = events.filter(event => {
        if ( event.title !== "Reservado" && event.title !== "Feriado" ) {
          return event
        }
      })
      days = myCleaningDays.map(event => event.startStr)
      summaryDates(days)
      getPriceData(allSelects, allInputs, days.length)
    },
    eventClick(info) {
      const events = calendar.getEvents()
      const event = events.filter(event => event.startStr === info.event.startStr && event.title !== "Reservado" && event.title !== "Feriado")[0]
      if ( info.event.title === "Reservado" && info.event.title === "Feriado" ) return
      event.remove()
      events.splice(events.indexOf(event), 1)
      const myCleaningDays = events.filter( event => {
        if ( event.title !== "Reservado" && event.title !== "Feriado" ) {
          return event
        }
      } )
      days = myCleaningDays.map(event => event.startStr)
      summaryDates(days)
      getPriceData(allSelects, allInputs, days.length)
    }
  })
  
  calendar.render()
}