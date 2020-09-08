import getRoomPriceId from './room-price-id.js'

export default function getPriceData(allSelects, allInputs, quantity) {
  const total = document.getElementById('reserva-limpieza-total')
  const habitaciones = document.getElementById('cantidad-habitaciones')
  const banos = document.getElementById('cantidad-banos')
  quantity = quantity ? parseInt(quantity) : 1
  let optionsSelected = []
  let inputsChecked = []

  Array.from(allSelects).forEach(select => {
    Array.from(select.children).filter(option => {
      if (option.selected) optionsSelected.push(option)
    })
  })

  Array.from(allInputs).filter(input => {
    if (input.checked) inputsChecked.push(input)
  })
  
  const optionPrices = optionsSelected.map(option => {
    if (!option.dataset.price) return 0
    return parseFloat(option.dataset.price)
  })
  
  const inputPrices = Array.from(inputsChecked).map(input => {
    if (!input.dataset.price) return 0
    return parseFloat(input.dataset.price)
  })

  const roomPrices = getRoomPriceId(habitaciones, banos)
  const allPrices = optionPrices.concat(inputPrices)
  allPrices.push(parseFloat(roomPrices.precio))

  const reducer = (accumulator, currentValue) => accumulator + currentValue
  const price = parseFloat(allPrices.reduce(reducer)).toFixed(2)
  const totalPrice = parseFloat(price * quantity).toFixed(2)
  total.innerHTML = `$${totalPrice}`
}