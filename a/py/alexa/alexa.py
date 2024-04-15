from bs4 import BeautifulSoup
import requests


source = None
try:
    headers = {'user-agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
    source = requests.get('https://cryptonews.com/paged/newsbitcoin-news-1.json', headers=headers, timeout=None)
except Exception as e:
    ex = str(e)
    source1 = "xxx"
    pass

huy = None
#
# with open("../../paged/newsbitcoin-news-11.json", "w") as file:
with open("editorsaaron-hertzmann-1.json", "w") as file:
    file.write(source.text)

# bs = BeautifulSoup(source.text, features="html.parser")
# rank = bs.find('h1', class_='font-extra-bold m-t-xl m-b-xs text-success').get_text().strip()
# rank = int(rank.replace(",", ""))
#
# update_monitor = "UPDATE monitor SET alexa = %s, scode = %s, elapsed = %s, comment = %s WHERE monitor = %s"
# data_monitor = (rank, scode, elapsed, ex, monitor)
# cursor.execute(update_monitor, data_monitor)
# cnx.commit()
#
# cursor.close()
# cnx.close()
