
export default function getValues(inputs, selects) {
  const inputValues = Array
    .from(inputs)
    .filter(input => input.checked)
    .filter(input => input.name !== 'horario-limpieza')
    .map(input => input.value)
  
  const selectValues = Array.from(selects)
    .map(select => select.value)

  const new_values = {
    ubicacion: selectValues[0],
    habitaciones: (selectValues[1] + ' ' + selectValues[2]),
    area: selectValues[3],
    tipo_de_propiedad: selectValues[4],
    tipo_de_limpieza: inputValues[0]
  }

  console.table(new_values)

  const values = {
    inputs: inputValues,
    selects: selectValues
  }

  return values

}
