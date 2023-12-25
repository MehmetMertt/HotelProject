<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calender</title>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
</head>

<body>
    <input id="datepicker" />
    <script>
    const DateTime = easepick.DateTime;
    const bookedDates = [
        ['2023-12-25', '2023-12-30']
    ].map(d => {
        if (d instanceof Array) {
            const start = new DateTime(d[0], 'YYYY-MM-DD');
            const end = new DateTime(d[1], 'YYYY-MM-DD');

            return [start, end];
        }

        return new DateTime(d, 'YYYY-MM-DD');
    });

    const picker = new easepick.create({
        element: document.getElementById('datepicker'),
        css: [
            'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
        ],
        plugins: ['RangePlugin', 'LockPlugin'],
        LockPlugin: {
            minDate: new Date(),
            minDays: 1,
            inseparable: true,
            filter(date, picked) {
                if (picked.length === 1) {
                    const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                    return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
                }
                console.log(date.inArray(bookedDates, '[)'))
                return date.inArray(bookedDates, '[)');
            },
        }
    });
    </script>
</body>

</html>