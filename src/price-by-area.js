
export default function priceByArea() {
  const cleanArea = document.getElementById('clean-area')
  const reservaLimpiezaTotal = document.getElementById('reserva-limpieza-total')
  const firstArea = ['0-100', '101-150', '151-200', '201-250']

  if (firstArea.includes(cleanArea.value)) {
    console.log('hello')
  }
}