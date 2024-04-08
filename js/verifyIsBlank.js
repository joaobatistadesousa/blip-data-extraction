document.addEventListener('DOMContentLoaded', function () {
    const bot_key = document.getElementById('bot_key');
    const start_date = document.getElementById('start_date');
    const end_date = document.getElementById('end_date');
    const quantity_of_events = document.getElementById('quantity_of_events');
    const event_name = document.getElementById('event_name');
    const form_params = document.getElementById('form_params');

    function isBlank() {
        if (!quantity_of_events) {
            if (bot_key.value === "" || start_date.value === "" || end_date.value === "") {
                alert("Todos os campos devem ser preenchidos");
                return false;
            }
        } else {
            if (bot_key.value === "" || start_date.value === "" || end_date.value === "" || quantity_of_events.value === "" || event_name.value === "") {
                alert("Todos os campos devem ser preenchidos");
                return false;
            }
        }
        return true;
    }

    form_params.addEventListener('submit', function (event) {
        if (!isBlank()) {
            event.preventDefault();
        }
    });
});
