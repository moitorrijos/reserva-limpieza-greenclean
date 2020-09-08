
export default function summaryServices(values) {
  const serviceDiv = document.getElementById('servicios')
  const valuesList = values.map( service => {
    return `<li>${service}</li>`
  })
  serviceDiv.innerHTML = valuesList.join('')
}