
export default function selectSanitization(areaValue) {
  const sanitizacionArray = document.querySelectorAll('.limpieza-destacada')
  Array.from(sanitizacionArray).forEach(label => {
    if (!label.classList.contains('hidden-button')) {
      label.classList.add('hidden-button')
    }
    if (label.firstElementChild.checked) {
      label.firstElementChild.checked = false
    }
  })
  const label = Array.from(sanitizacionArray).filter(label => {
    if (label.dataset.area === areaValue) return label
  })
  label[0].classList.remove('hidden-button')
}