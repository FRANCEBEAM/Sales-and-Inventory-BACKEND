function increaseValue() {
  var value = parseInt(document.getElementById('itemQty').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('itemQty').value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('itemQty').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('itemQty').value = value;
}