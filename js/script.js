const toggleSwitch = document.getElementById('toggleSwitch');
const statusText = document.getElementById('status');

toggleSwitch.addEventListener('change', () => {
  if (toggleSwitch.checked) {
    statusText.textContent = 'Switch is ON';
  } else {
    statusText.textContent = 'Switch is OFF';
  }
});