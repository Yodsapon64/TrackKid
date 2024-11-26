// Apply flatpickr to the date input field
flatpickr("#kidBirth", {
    dateFormat: "d-m-Y", // Format day-month-year
    locale: "th",        // Thai language
    altInput: true,
    altFormat: "d-m-Y",  // Format display
    onReady: function(selectedDates, dateStr, instance) {
        // Convert year to Buddhist Era
        instance.currentYear += 543;
        instance.redraw();
    },
    onChange: function(selectedDates, dateStr, instance) {
        // Convert selected date year to BE
        let selectedDate = new Date(selectedDates[0]);
        let beYear = selectedDate.getFullYear() + 543;
        let formattedDate = `${selectedDate.getDate()}-${selectedDate.getMonth()+1}-${beYear}`;
        instance.altInput.value = formattedDate;
    }
});
