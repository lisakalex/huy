# from bs4 import BeautifulSoup
# import calendar
#
# body1 = """<!DOCTYPE html>
# <html lang="en">
# <head>
#     <meta charset="utf-8"/>
#     <title>con</title>
#     <link rel="preconnect" href="https://fonts.googleapis.com">
#     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
#     <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
#     <style>
#         body {
#             font-family: "Montserrat", "Gotham ssm 4r", "Gotham ssm a", "Gotham ssm b", Arial, sans-serif;
#             /*font-family: "Ubuntu Mono", monospace;*/
#             /*font-weight: 400;*/
#             /*font-style: normal;*/
#             /*font-size: 3em;*/
#             color: #666666;
#         }
#
#         th {
#             font-family: "Montserrat", "Gotham ssm 4r", "Gotham ssm a", "Gotham ssm b", Arial, sans-serif;
#             /*font-family: "Ubuntu Mono", monospace;*/
#             font-weight: 400;
#             /*font-style: normal;*/
#             /*font-size: 3em;*/
#             color: #666666;
#         }
#
#         .container {
#             width: 700px;
#             margin: auto;
#         }
#
#         .day {
#             /*width: 20px;*/
#             /*height: 20px;*/
#             text-align: center;
#             /*line-height: 20;*/
#             /*float: left;*/
#             margin: 15px;
#             padding: 5px;
#             border-width: 3px;
#             border-radius: 50%;
#
#         }
#
#         .month {
#             /*width: 140px;*/
#             /*height: 140px;*/
#             /*text-align: center;*/
#             /*line-height: 70px;*/
#             margin: 15px;
#             /*padding: 70px 0 0 0;*/
#             font-size: 1.3em;
#         }
#
#         .year {
#             /*width: 670px;*/
#             /*height: 200px;*/
#             /*text-align: center;*/
#             /*line-height: 70px;*/
#             /*margin: 15px;*/
#             /*padding: 70px 0 0 0;*/
#             /*font-size: 1.3em;*/
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
#         /*.year {*/
#         /*    width: 670px;*/
#         /*    height: 150px;*/
#         /*    text-align: center;*/
#         /*    line-height: 150px;*/
#         /*    margin: 100px 15px 0 15px;*/
#         /*    font-size: 2em;*/
#         /*}*/
#
#         .pink {
#             /*color: #ffffff;*/
#             color: #ff33cc;
#             /*background-color: #ff33cc;*/
#             /*border-radius: 50%;*/
#             /*border: 3px;*/
#         }
#
#         .blue {
#             /*color: #ffffff;*/
#             color: #6666ff;
#             /*background-color: #6666ff;*/
#             /*border-radius: 50%;*/
#         }
#
#         .pale {
#             color: #ccc;
#         }
#
#     </style>
# </head>
# <body>
# """
#
# body2 = """</body>
# </html>"""
# hc = calendar.HTMLCalendar()
# # hc.cssclasses = ['mon day', 'tue day', 'wed day', 'thu day', 'fri day', 'sat day', 'sun day']
# hc.cssclasses = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']
# cal = hc.formatyear(2024, width=4)
# # cal = hc.formatyearpage(2024, width=3, css='cal.css', encoding=None)
#
# with open('cal-2.html', 'r', encoding='utf-8') as file:
# soup = BeautifulSoup(cal, features="html.parser")
# year = soup.find_all(class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun', 'noday'])
# year = soup.find_all('td', class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'])
# year = soup.find_all('th')
# year = soup.find_all('td')
# year = soup.find_all(['th', 'td'])
#
# kak = 1
# for i in soup.find_all('td', class_=['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']):
#
#     if kak == 1 or kak == 2:
#         i['class'] = 'day xxxx'
#
#     if kak == 3 or kak == 4:
#         i['class'] = 'day pink'
#
#     if kak == 5 or kak == 6:
#         i['class'] = 'day blue'
#
#     kak += 1
#     if kak > 6:
#         kak = 1
#
# year = soup.find_all(class_=['day', 'noday'])
# soup = BeautifulSoup(str(year), features="html.parser")
# year = soup.find_all(class_=['day', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun', 'noday'])
#
# for i in soup.find_all(class_='noday'):
#     i['class'] = 'day pale'
#
# with open('cal2-2024.html', "w") as file:
#     file.write(body1)
#     file.write(str(soup))
#     file.write(body2)
#
# with open('cal22-2024.html', "w", encoding='utf8') as file:
#     file.write(str(cal))
# k = None
