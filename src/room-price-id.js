export default function getRoomPriceId(habitaciones, banos) {
  const precio = gcs_reserva_limpieza.habitaciones.filter(habitacion => {
    if (habitacion.habitaciones === `${habitaciones.value} ${banos.value}`) {
      return habitacion
    }
  })
  return {
    precio: precio[0].precio,
    id: precio[0].dataId
  }
}