
export default function selectedDays(events) {
  return events.map(event => event.startStr)
}