from bs4 import BeautifulSoup

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
year = []
year1 = []
for k, v in month.items():
    for i in range(1, v + 1):
        year.append("<div class=\"day xxxx\">" + str(i) + "</div> <!-- " + k + "-->")

kak = 1
for i in year:

    if kak == 1 or kak == 2:
        # year1.append("<div class=\"day xxxx\">" + str(i) + "</div> <!-- " + k + "-->")
        # i = i.replace("xxxx", i)
        # year1.append(i)
        soup = BeautifulSoup(i, features="html.parser")
        year = soup.find('div', class_='xxxx')
        year['class'] = 'day xxxx'
        year1.append(str(year))

    if kak == 3 or kak == 4:
        # year1.append("<div class=\"day pink\">" + str(i) + "</div> <!-- " + k + "-->")
        # i = i.replace("pink", i)
        # year1.append(i)
        soup = BeautifulSoup(i, features="html.parser")
        year = soup.find('div', class_='xxxx')
        year['class'] = 'day pink'
        year1.append(str(year))

    if kak == 5 or kak == 6:
        # year1.append("<div class=\"day blue\">" + str(i) + "</div> <!-- " + k + "-->")
        # i = i.replace("blue",
        soup = BeautifulSoup(i, features="html.parser")
        year = soup.find('div', class_='xxxx')
        year['class'] = 'day blue'
        year1.append(str(year))

    kak += 1
    if kak > 6:
        kak = 1

print(year1)
with open('kak', "w") as file:
    fo
k = None
