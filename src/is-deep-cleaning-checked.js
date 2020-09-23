export default function isDeepCleaningChecked(profunda8horas, habitaciones) {
  const isChecked = Array
    .from(profunda8horas)
    .filter(label => label.firstElementChild.checked).length
  Array.from(profunda8horas).forEach(label => {
    let hab
    switch (habitaciones.value) {
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
    label.firstElementChild.checked = false
    if ( isChecked && label.dataset.hab === hab ) {
      label.firstElementChild.checked = true
    }
  })
}