#!/home/al/.venv/bin/python3
import calendar
import matplotlib

year = 2024
c = calendar.Calendar()
days = ['<div class="day year">' + str(year) + '</div>']
i = 1
shifts = 1
for d in c.yeardayscalendar(year, 1):
    month = ''
    if i == 1: month = 'January'
    if i == 2: month = 'February'
    if i == 3: month = 'March'
    if i == 4: month = 'April'
    if i == 5: month = 'May'
    if i == 6: month = 'June'
    if i == 7: month = 'July'
    if i == 8: month = 'August'
    if i == 9: month = 'September'
    if i == 10: month = 'October'
    if i == 11: month = 'November'
    if i == 12: month = 'December'
    days.append('<div class="day month-title">' + month + '</div>')
    days.append('<div class="day xxxx">M</div>')
    days.append('<div class="day xxxx">T</div>')
    days.append('<div class="day xxxx">W</div>')
    days.append('<div class="day xxxx">T</div>')
    days.append('<div class="day xxxx">F</div>')
    days.append('<div class="day xxxx">S</div>')
    days.append('<div class="day xxxx">S</div>')

    for dd in list(matplotlib.cbook.flatten(d)):
        if dd > 0:
            if shifts == 1 or shifts == 2:
                days.append('<div class="day xxxx">' + str(dd) + '</div>')

            if shifts == 3 or shifts == 4:
                days.append('<div class="day pink">' + str(dd) + '</div>')

            if shifts == 5 or shifts == 6:
                days.append('<div class="day blue">' + str(dd) + '</div>')

            shifts += 1
            if shifts > 6:
                shifts = 1

        else:
            days.append('<div class="day pale"></div>')

    i = i + 1

body1 = """<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>con</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Montserrat", "Gotham ssm 4r", "Gotham ssm a", "Gotham ssm b", Arial, sans-serif;
            font-size: 3em;
            color: #666666;
        }

        .container {
            width: 700px;
            margin: auto;
        }

        .day {
            width: 70px;
            height: 70px;
            text-align: center;
            line-height: 70px;
            float: left;
            margin: 15px;
        }

        .month-title {
            width: 670px;
            height: 70px;
            text-align: center;
            line-height: 70px;
            margin: 15px;
            padding: 70px 0 0 0;
            font-size: 1.3em;
        }

        .year {
            width: 670px;
            height: 150px;
            text-align: center;
            line-height: 150px;
            margin: 100px 15px 0 15px;
            font-size: 2em;
        }

        .pink {
            color: #ffffff;
            background-color: #ff33cc;
            border-radius: 50%;
        }

        .blue {
            color: #ffffff;
            background-color: #6666ff;
            border-radius: 50%;
        }

        .pale {
            color: #ccc;
        }

    </style>
</head>
<body>
<div class="container">
"""

body2 = """<div class="day pale"></div>
</div>
</body>
</html>"""

with open('calendar-' + str(year) + '.html', "w") as file:
    file.write(body1)
    for d in days:
        file.write(d)
    file.write(body2)
