# import pymysql
from selenium import webdriver
from urllib.request import urlopen
from bs4 import BeautifulSoup
from urllib.request import urlopen
import urllib.request

# h = urlopen("https://hyiphome.net")
# print(h)

with urllib.request.urlopen('https://cryptonews.com/paged/newsbitcoin-news-1.json') as f:
    huy = f.read()

with open("../../paged/newsbitcoin-news-1-huy.htm", "w") as file:
    file.write(huy)

# f = open("/home/al/PycharmProjects/pythonProject/ku.htm", "r")
# source = f.read()

# conn = pymysql.connect(host='localhost', user='root', passwd=None, db='tihuy')
# cur = conn.cursor()
# cur.execute('SELECT `monitor` FROM monitor WHERE hit=0')
# kak = cur.fetchone()
# cur.close()
# conn.close()
#
# driver = webdriver.Chrome()
# driver.get(kak[0])
# source = driver.page_source
# driver.close()

# bsObj = BeautifulSoup(source)
# detailsList = bsObj.findAll("div", {"class": "details"})
# da = bsObj.findAll("a", {"class": "hyip"})
# url = []
# name = []
# for n in da:
#     url.append(n.attrs['href'])
#     name.append(n.get_text())
# # name = []
# url = []
# status = []

# for n in detailsList:
#     url.append(n.find("a").attrs['href'])
#     name.append(n.find("a").get_text())
#     status.append(n.find("div", {"class": "status_vote"}).get_text())

# huy = None
# try:
#     # with open("/opt/lampp/htdocs/tihuy/assets/source/source.htm", "w") as fp:
#     with open("/home/al/PycharmProjects/pythonProject/ku.htm", "w") as fp:
#         fp.write(source)
# except IOError as e:
#     print("error writing to file")
