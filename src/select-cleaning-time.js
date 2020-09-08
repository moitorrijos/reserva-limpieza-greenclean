
export default function selectCleaningTime(habValue) {
  let hab
  switch (habValue) {
    case "1 habitación":
      hab = "1-hab"
      break
    case "2 habitaciones":
      hab = "2-hab"
      break
    case "3 habitaciones":
      hab = "3-hab"
      break
    case "4 habitaciones":
      hab = "4-hab"
      break
    case "5 habitaciones":
      hab = "5-hab"
  }
  const profunda = document.querySelectorAll('.profunda-8-horas')
  Array.from(profunda).forEach(label => {
    if (!label.classList.contains('hidden-button')) {
      label.classList.add('hidden-button')
    }
  })
  const selected = Array.from(profunda).filter(label => {
    if (label.dataset.hab === hab) return label
  })
  selected[0].classList.remove('hidden-button')
}