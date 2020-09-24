import getRoomPriceId from './room-price-id.js'

export default function getIds(allSelects, allInputs) {
  const banos = document.getElementById('cantidad-banos')
  const habitaciones = document.getElementById('cantidad-habitaciones')
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

  const optionIds = optionsSelected.map(option => {
    if (!option.dataset.id) return null
    return option.dataset.id
  })

  const inputIds = Array.from(inputsChecked).map(input => {
    if (!input.dataset.id) return null
    return input.dataset.id
  })

  const roomIds = getRoomPriceId(habitaciones, banos)

  if (inputsChecked[0].className !== 'input-profunda-8-horas') {
    optionIds.push(roomIds.id)
  }
  
  const allIds = optionIds.concat(inputIds)

  return allIds
}