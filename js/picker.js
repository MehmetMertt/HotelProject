<script>
const testDates = <?php echo json_encode($alletermine); ?>;
const bookedDates = [];

for (var i = 0; i < testDates.length; i++) {
    var vonSplit = testDates[i].von.split(".");
    var newVon = new Date(+vonSplit[2], vonSplit[1] - 1, +vonSplit[0]);

    var bisSplit = testDates[i].bis.split(".");
    var newBis = new Date(+bisSplit[2], bisSplit[1] - 1, +bisSplit[0]);

    // const start = new Date(newVon); // Assuming von is a valid date string
    //const end = new Date(newBis); // Assuming bis is a valid date string
    bookedDates[i] = [newVon, newBis];
}


const DateTime = easepick.DateTime;
bookedDates.map(d => {
    if (d instanceof Array) {
        const start = new DateTime(d[0], 'MM.DD.YYYY');
        const end = new DateTime(d[1], 'MM.DD.YYYY');

        return [start, end];
    }

    return new DateTime(d, 'MM.DD.YYYY');
});

const picker = new easepick.create({
    element: document.getElementById('datepicker'),
    css: [
        'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
        'https://easepick.com/css/demo_hotelcal.css',
    ],
    plugins: ['RangePlugin', 'LockPlugin'],
    RangePlugin: {
        tooltipNumber(num) {
            return num - 1;
        },
        locale: {
            one: 'night',
            other: 'nights',
        },
    },
    LockPlugin: {
        minDate: new Date(),
        minDays: 2,
        inseparable: true,
        filter(date, picked) {
            if (picked.length === 1) {
                const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
            }

            return date.inArray(bookedDates, '[)');
        },
    }
});
</script>
