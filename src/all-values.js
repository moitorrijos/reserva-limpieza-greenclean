
export default function getValues(inputs, selects) {
  const inputValues = Array
    .from(inputs)
    .filter(input => input.checked)
    .filter(input => input.name !== 'horario-limpieza')
    .map(input => input.value)

  const limpiezaSeleccionada = Array
    .from(inputs)
    .filter(input => input.checked)
    .filter(input => input.name === 'tipo-limpieza')
  
  const selectValues = Array.from(selects)
    .map(select => select.value)

  const new_values = {
    ubicacion: selectValues[0],
    habitaciones: (selectValues[1] + ' ' + selectValues[2]),
    area: selectValues[3],
    tipo_de_propiedad: selectValues[4],
    tipo_de_limpieza: limpiezaSeleccionada[0] ? limpiezaSeleccionada[0].value : ''
  }

  // console.table(new_values)

  const values = {
    input: inputValues,
    select: selectValues
  }

  return values

}
