document.addEventListener('DOMContentLoaded', function () {
    const form_params = document.getElementById('form_params');

    form_params.addEventListener('submit', function (event) {
        const start_date = document.getElementById('start_date');
        const end_date = document.getElementById('end_date');

        function isDateDifferenceValid(startDate, endDate) {
            const diffTime = Math.abs(endDate.getTime() - startDate.getTime());
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays <= 94;
        }

        const startDateObj = new Date(start_date.value);
        const endDateObj = new Date(end_date.value);

        if (!isDateDifferenceValid(startDateObj, endDateObj)) {
            alert("A diferença entre as datas deve ser de no máximo 3 meses");
            event.preventDefault(); // Evita que o formulário seja enviado
        }
    });
});
