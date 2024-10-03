# noinspection PyInterpreter,PyPackageRequirements
import mysql.connector
import random
import datetime
import sys as s
s.modules.keys()

# df = pd.DataFrame([[1234, 'Customer A', '123 Street', 'huy'],
#                    [1234, 'Customer A', 'kk', '333 Street'],
#                    [1233, 'Customer B', '444 Street', '333 Street'],
#                    [1233, 'Customer B', '444 Street', '666 Street']], columns=
#                   ['ID', 'Customer', 'Billing Address', 'Shipping Address'])
#
# columns = ['Date', 'AAPL.Open', 'AAPL.High', 'AAPL.Low', 'AAPL.Close', 'AAPL.Volume', 'AAPL.Adjusted', 'dn', 'mavg', 'up', 'direction']
loadavgs = []
# ll = ['Date', 'AAPL.Open', 'AAPL.High', 'AAPL.Low', 'AAPL.Close', 'AAPL.Volume','AAPL.Adjusted', 'dn', 'mavg', 'up', 'direction']
# loadavgs.append(ll)
a = datetime.datetime.now().date()
for ii in range(1, 1000):
    a = a + datetime.timedelta(1, 60)
    r1 = random.randint(1, 10)
    # r2 = random.randint(1, 10)
    # r3 = random.randint(1, 10)
    # r4 = random.randint(1, 10)
    # r5 = random.randint(1, 10)
    # r6 = random.randint(1, 10)
    # r7 = random.randint(1, 10)
    # r8 = random.randint(1, 10)
    # r9 = random.randint(1, 10)
    # r10 = random.randint(1, 10)

    # list1 = [a, r1, r2, r3, r4, r5, r6, r7, r8, r9, 'Decreasing']
    list1 = [a, r1]
    loadavgs.append(list1)

# plots = ['Date', 'AAPL.Open', 'AAPL.High', 'AAPL.Low', 'AAPL.Close', 'AAPL.Volume','AAPL.Adjusted', 'dn', 'mavg', 'up', 'direction']
cnx = mysql.connector.connect(host='localhost', user='al', passwd='Zaichik1.&', database='hyip')
cursor = cnx.cursor()

#
# sql = "INSERT INTO plot1 (Date, `AAPL.Open`, `AAPL.High`, `AAPL.Low`,`AAPL.Close`, `AAPL.Volume`,`AAPL.Adjusted`,dn, mavg, up,direction) VALUES (%s, %s, %s, %s,%s, %s, %s, %s,%s, %s, %s)"
sql = "INSERT INTO plot2 (ddate, aapl) VALUES (%s, %s)"
cursor.executemany(sql, loadavgs)
# plots =[]

# sql = "select * from plot1 limit 1000"
# cursor.execute(sql)
# plots = cursor.fetchall()
# cnx.commit()
# cursor.close()
# cnx.close()
# huy = None
# with open("plot1.csv", "r") as f:
#     addresses = [tuple(line) for line in csv.reader(f)]


# df = pd.read_csv('https://raw.githubusercontent.com/plotly/datasets/master/finance-charts-apple.csv')
# df = pd.read_csv('plot1.csv')
# df = pd.DataFrame(plots, columns=['Date', 'AAPL.Open', 'AAPL.High', 'AAPL.Low', 'AAPL.Close', 'AAPL.Volume', 'AAPL.Adjusted', 'dn', 'mavg', 'up', 'direction'])
#
# fig = px.line(df, x='Date', y=['AAPL.High', 'AAPL.Open','AAPL.Low'], title='Time Series with Range Slider and Selectors')
#
# fig.update_xaxes(
#     rangeslider_visible=True,
#     rangeselector=dict(
#         buttons=list([
#             dict(count=1, label="1m", step="month", stepmode="backward"),
#             dict(count=6, label="6m", step="month", stepmode="backward"),
#             dict(count=1, label="YTD", step="year", stepmode="todate"),
#             dict(count=1, label="1y", step="year", stepmode="backward"),
#             dict(step="all")
#         ])
#     )
# )
# fig.show()
