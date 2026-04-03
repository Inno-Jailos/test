const form = document.getElementById('statusForm');
const resultBox = document.getElementById('result');

form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const identifierType = document.getElementById('identifierType').value;
  const identifierValue = document.getElementById('identifierValue').value.trim();

  const body = new URLSearchParams({
    identifier_type: identifierType,
    identifier_value: identifierValue,
  });

  resultBox.className = 'alert mt-4';
  resultBox.textContent = 'Checking status...';

  try {
    const response = await fetch('passport_status.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
      },
      body,
    });

    const payload = await response.json();

    if (!response.ok || !payload.success) {
      resultBox.classList.add('alert-danger');
      resultBox.textContent = payload.message || 'Failed to check status.';
      return;
    }

    const { data } = payload;
    resultBox.classList.add('alert-success');
    resultBox.innerHTML = `
      <strong>${data.full_name}</strong><br>
      Application Number: ${data.application_number}<br>
      National ID: ${data.national_id}<br>
      Status: ${data.status}<br>
      Last Update: ${data.last_update}
    `;
  } catch (error) {
    resultBox.classList.add('alert-danger');
    resultBox.textContent = 'Could not connect to the server. Please try again.';
  }
});
