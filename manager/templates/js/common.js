function generate_day(default_day) {
    let select_day = document.getElementById('select-day');

    let month = parseInt(document.getElementById('select-month').value);
    let year = parseInt(document.getElementById('select-year').value);
    console.log(month);
    let max_day = 0;
    if ([1, 3, 5, 7, 8, 10, 12].includes(month)) {
        max_day = 31;
    } else if ([4, 6, 9, 11].includes(month)) {
        max_day = 30;
    } else {
        if (is_leap_year(year)) {
            max_day = 29;
        } else {
            max_day = 28;
        }
    }

    let day_options = '<option value="" disabled selected hidden>Ngày</option>';
    for (let i = 1; i <= max_day; i++) {
        if (default_day !== undefined && default_day === i) {
            day_options += `<option value="${i}" selected>${i}</option>`
        } else {
            day_options += `<option value="${i}">${i}</option>`
        }
    }
    select_day.innerHTML = day_options;
}

function is_leap_year(year) {
    return (year % 100 === 0) ? (year % 400 === 0) : (year % 4 === 0); 
}