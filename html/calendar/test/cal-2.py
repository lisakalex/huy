from calendar_view.calendar import Calendar
from calendar_view.core.event import EventStyles

#
# calendar = Calendar.build()
# calendar.add_event(day_of_week=0, start='08:00', end='17:00', style=EventStyles.GRAY)
# calendar.add_event(day_of_week=5, start='09:00', end='12:00', style=EventStyles.RED)
# calendar.add_event(day_of_week=5, start='10:00', end='13:00', style=EventStyles.BLUE)
# calendar.add_event(day_of_week=6, start='15:00', end='18:00')
# calendar.save("simple_view.png")
#
# config = CalendarConfig(
#     lang='en',
#     title='Yoga Class Schedule',
#     dates='Mo - Fr',
#     hours='8 - 22',
#     mode=None,
#     show_date=True,
#     show_year=False,
#     legend=True,
# )
# import calendar
# hc = calendar.HTMLCalendar()
# print(hc.cssclass_month)
# month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
# thisdict = dict(name="John", age=36, country="Norway")

month = {
    "January": 31,
    "February": 29,
    "March": 31,
    "April": 30,
    "May": 31,
    "June": 30,
    "July": 31,
    "August": 31,
    "September": 30,
    "October": 31,
    "November": 30,
    "December": 31
}
# print("""<!DOCTYPE html>
# <html lang="en">
# <head>
#     <meta charset="UTF-8">
#     <title>con</title>
#     <style>
#         body {
#             font-family: "Montserrat", "Gotham ssm 4r", "Gotham ssm a", "Gotham ssm b", Arial, sans-serif;
#             font-size: 3em;
#             color: #666666;
#         }
#
#         .container {
#             width: 700px;
#             margin: auto;
#         }
#
#         .day {
#             width: 70px;
#             height: 70px;
#             text-align: center;
#             line-height: 70px;
#             float: left;
#             margin: 15px;
#         }
#
#         .month-title {
#             width: 670px;
#             height: 70px;
#             text-align: center;
#             line-height: 70px;
#             margin: 15px;
#             padding: 70px 0 0 0;
#             font-size: 1.3em;
#         }
#
#         .year {
#             width: 670px;
#             height: 150px;
#             text-align: center;
#             line-height: 150px;
#             margin: 100px 15px 0 15px;
#             font-size: 2em;
#         }
#
#         .pink {
#             color: #ffffff;
#             background-color: #ff33cc;
#             border-radius: 50%;
#         }
#
#         .blue {
#             color: #ffffff;
#             background-color: #6666ff;
#             border-radius: 50%;
#         }
#
#         .pale {
#             color: #ccc;
#         }
#
#     </style>
# </head>
# <body>
# <div class="container">
#     <div class="day year">2024</div>""")
for k, v in month.items():
    #     print("<div class=\"day month-title\">" + i + "</div>\n" +
    # """<div class="day xxxx">M</div>
    # <div class="day xxxx">T</div>
    # <div class="day xxxx">W</div>
    # <div class="day xxxx">T</div>
    # <div class="day xxxx">F</div>
    # <div class="day xxxx">S</div>
    # <div class="day xxxx">S</div>"""
    #           )
    # i = 1
    kak = 1
    for i in range(1, v + 1):


        if kak == 1 or kak == 2:
            print("<div class=\"day xxxx\">" + str(i) + "</div> <!-- " + k + "-->")

        if kak == 3 or kak == 4:
            print("<div class=\"day pink\">" + str(i) + "</div> <!-- " + k + "-->")

        if kak == 5 or kak == 6:
            print("<div class=\"day blue\">" + str(i) + "</div> <!-- " + k + "-->")

        kak += 1
        if kak > 6:
            kak = 1

# print("""<div class="day xxxx"></div>
# </div>
# </body>
# </html>""")
