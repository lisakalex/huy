#!/home/al/.venv/bin/python3
from bs4 import BeautifulSoup
import calendar
from functools import reduce
import operator
import matplotlib

# xss = [[1, 2, 3], [4, 5, 6], [7], [8, 9], [1, 2, 3], [4, 5, 6], [7], [8, 9]]
# out = reduce(operator.concat, xss)
# jj = sum(xss, [])
c = calendar.Calendar()
# kak = c.yeardayscalendar(2024, 1)
# ku = list(matplotlib.cbook.flatten(kak))
# out = reduce(operator.concat, kak)
# print(kak)
year = 2024
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

# https://www.crummy.com/software/BeautifulSoup/bs4/doc/

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

body2 = """</div>
</body>
</html>"""
# hc = calendar.HTMLCalendar()
# # hc.cssclasses = ['mon day', 'tue day', 'wed day', 'thu day', 'fri day', 'sat day', 'sun day']
# # hc.cssclasses = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']
# cal = hc.formatyear(2024, width=4)
# # cal = hc.formatyearpage(2024, width=3, css='cal.css', encoding=None)
#
# # with open('cal-2.html', 'r', encoding='utf-8') as file:
# soup = BeautifulSoup(cal, features="html.parser")
# # year = soup.find_all(class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun', 'noday'])
# # year = soup.find_all('td', class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'])
# # year = soup.find_all('th')
# # year = soup.find_all('td')
# # year = soup.find_all(['th', 'td'])
#
# shifts = 1
# for i in soup.find_all('td', class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']):
#     if shifts == 1 or shifts == 2:
#         i['class'] = 'day xxxx'
#
#     if shifts == 3 or shifts == 4:
#         i['class'] = 'day pink'
#
#     if shifts == 5 or shifts == 6:
#         i['class'] = 'day blue'
#
#     shifts += 1
#     if shifts > 6:
#         shifts = 1
#
# # ku = soup.find_all('th', class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'])
# for i in soup.find_all('th', class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']):
#     if i.text == 'Mon':
#         ii = i.string = 'M'
#     if i.text == 'Tue':
#         ii = i.string = 'T'
#     if i.text == 'Wed':
#         ii = i.string = 'W'
#     if i.text == 'Thu':
#         ii = i.string = 'T'
#     if i.text == 'Fri':
#         ii = i.string = 'F'
#     if i.text == 'Sat':
#         ii = i.string = 'S'
#     if i.text == 'Sun':
#         ii = i.string = 'S'
# year = soup.find_all(class_=['day', 'noday'])
# soup = BeautifulSoup(str(year), features="html.parser")
# year = soup.find_all(class_=['day', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun', 'noday'])
#
# for i in soup.find_all(class_='noday'):
#     i['class'] = 'day pale'

with open('./a/calendar2-' + str(year) + '.html', "w") as file:
    file.write(body1)
    for d in days:
        file.write(d)
    file.write(body2)

# with open('cal22-2024.html', "w", encoding='utf8') as file:
#     file.write(str(cal))
k = None
