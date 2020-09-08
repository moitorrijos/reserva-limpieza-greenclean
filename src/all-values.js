
export default function getValues(inputs, selects) {
  const inputValues = Array
    .from(inputs)
    .filter(input => input.checked)
    .filter(input => input.name !== 'horario-limpieza')
    .map(input => input.value)
  
  const selectValues = Array.from(selects)
    .map(select => select.value)

  const values = {
    input: inputValues,
    select: selectValues
  }

  return values

}
