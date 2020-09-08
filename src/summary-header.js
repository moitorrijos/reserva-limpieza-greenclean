
export default function summaryHeader(values) {
  const ubicacion = document.getElementById('ubicacion')
  const metraje = document.getElementById('metraje')
  const cuartos = document.getElementById('cuartos')
  const propiedad = document.getElementById('propiedad')

  ubicacion.innerHTML = `Ubicación : <span>${values[0]}</span>`
  cuartos.innerHTML = `Habitaciones: <span>${values[1]} ${values[2]}</span>`
  metraje.innerHTML = `Area: <span>${values[3]} m<sup>2</sup></span>`
  propiedad.innerHTML = `Propiedad: <span>${values[4]}</span>`
}