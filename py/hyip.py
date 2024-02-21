from bs4 import BeautifulSoup
import mysql.connector
import requests
from urllib.parse import urlparse


# https://www.crummy.com/software/BeautifulSoup/bs4/doc/
def __get_status(status):
    s = 0
    if status.lower().find("paying") != -1 and status.lower().find("not paying") == -1:
        s = 1
    return s


def soups(monitor):
    source = None
    try:
        source = requests.get(monitor, headers=headers, timeout=None)
    except Exception as e:
        print(e)
        pass

    if source is not None:
        source = requests.get(monitor, headers=headers, timeout=None)
        elapsed = source.elapsed.total_seconds()
        res_code = source.status_code

        query = "UPDATE monitor SET res_code = %s, elapsed = %s WHERE monitor = %s"
        data = (res_code, elapsed, monitor)
        cursor.execute(query, data)
        cnx.commit()

        return BeautifulSoup(source.text, features='html.parser')

    return BeautifulSoup('<!DOCTYPE html><html lang="en"><head></head><body></body></html>', features='html.parser')


def addhyip(data):
    query = "INSERT INTO hyip_py (monitor, hyip, url, pay_status) VALUES (%s, %s, %s, %s)"
    cursor.executemany(query, data)
    cnx.commit()


def urls(url):
    source = None
    try:
        source = requests.get(url, headers=headers, timeout=None)
    except Exception as e:
        print(e)
        pass

    if source is not None:
        url = source.url
        huy1 = urlparse(url).scheme
        huy2 = urlparse(url).netloc
        return huy1 + '://' + huy2

    return ''


def graspgold_com():
    monitor = 'https://graspgold.com'
    soup = soups(monitor)
    data = []
    for n in soup.find_all('div', class_='details'):
        status = n.find('div', class_='status_vote').find('span').get_text().strip()
        pay_status = __get_status(status)

        if pay_status == 1:
            url = urls(n.find('a').get('href'))
            if url is not None and url != '':
                name = n.find('a').get_text().strip().capitalize()
                data.append((monitor, name, url, pay_status))

    addhyip(data)


def eurohyips_net():
    monitor = 'https://eurohyips.net'
    soup = soups(monitor)
    data = []
    for n in soup.find_all("div", class_='projects_listing'):
        pay_status = n.find('div', class_='project_status').find('span').get_text().strip()
        pay_status = __get_status(pay_status)

        if pay_status == 1:
            url = urls(n.find('a').get('href'))
            if url is not None and url != '':
                name = n.find('a').get_text().strip().capitalize()
                data.append((monitor, name, url, pay_status))

    addhyip(data)


def hyiphome_net():
    monitor = 'https://www.hyiphome.net'
    soup = soups(monitor)
    data = []
    for n in soup.find_all("div", class_='main-col'):
        pay_status = n.find('div', class_='b-status').get_text().strip()
        pay_status = __get_status(pay_status)

        if pay_status == 1:
            url = urls(n.find('a').get('href'))
            if url is not None and url != '':
                name = n.find('a').get_text().strip().capitalize()
                data.append((monitor, name, url, pay_status))

    addhyip(data)


# def graspgold1():
#     kak = None


#
#
# def hyiphome(self, monitor):
#     bs = self.__source(monitor, 'hyiphome')
#     hyips = bs.find_all('div', class_='main-col')
#
#     for n in hyips:
#         hyip = n.find('a').get_text().strip().capitalize()
#         url = n.find('a').attrs['href']
#         s = n.find('div', class_='b-status').get_text()
#         status = self.__get_status(s)
#         self.__store_hyip(monitor, hyip, url, status)
#
#
# def investtracing(self, monitor):
#     bs = self.__source(monitor, "investtracing")
#     hyips = bs.find_all("div", {"class": "listcontainer"})
#
#     for n in hyips:
#         hyip = n.find("a", {"class": "hyip"}).get_text().strip().capitalize()
#         url = "https://invest-tracing.com/" + n.find("a", {"class": "hyip"}).attrs['href']
#         s = n.find("label", {"class": "label"}).get_text()
#         status = self.__get_status(s)
#         self.__store_hyip(monitor, hyip, url, status)
#
#
# def instantmonitor(self, monitor):
#     bs = self.__source(monitor, 'instantmonitor')
#     hyips = bs.find_all("div", {"class": "listcontainer"})
#
#     for n in hyips:
#         hyip = n.find("a").get_text().strip().capitalize()
#         url = "https://instant-monitor.com" + n.find("a").attrs['href']
#         s = n.find("span").get_text()
#         status = self.__get_status(s)
#         self.__store_hyip(monitor, hyip, url, status)
#
#
# def goldlister(self, monitor):
#     bs = self.__source(monitor, 'goldlister')
#     hyips = bs.find_all("table", {"class": "summary"})
#
#     for n in hyips:
#         hyip = n.find("a").get_text().strip().capitalize()
#         url = "https://gold-lister.com/" + n.find("a").attrs['href']
#         s = n.find("div", {"id": "statussite"}).attrs['class']
#         status = self.__get_status(s[0])
#         self.__store_hyip(monitor, hyip, url, status)
#
#
# def eurohyips(self, monitor):
#     bs = self.__source(monitor, 'eurohyips')
#     hyips = bs.find_all("div", {"class": "projects_listing"})
#
#     for n in hyips:
#         hyip = n.find("a").get_text().strip().capitalize()
#         url = n.find("a").attrs['href']
#         s = n.find("div", {"class": "project_status"}).find("span").get_text()
#         status = self.__get_status(s)
#         self.__store_hyip(monitor, hyip, url, status)
#
#
# def exclusiveprofit(self, monitor):
#     bs = self.__source(monitor, "exclusiveprofit")
#     hyips = bs.find_all("div", {"class": "c-project-preview-top-row"})
#
#     for n in hyips:
#         hyip = n.find("a").get_text().strip().capitalize()
#         url = n.find("a").attrs['href']
#         s = n.find("span").get_text()
#         status = self.__get_status(s)
#         self.__store_hyip(monitor, hyip, url, status)
#
#
# def fairmonitor(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#     hyips = bs.find_all("table", {"class": "detn_stat1_block"})
#
#     for n in hyips:
#         st = time.time()
#         hyip.append(n.find("a").get_text().strip().capitalize())
#         url.append(self.__hyip_url(n.find("a").attrs['href']))
#         status.append(self.__get_status(n.find("span").get_text()))
#         ttm.append(time.time() - st)
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#
#
# def hyipclub(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#     hyips = bs.find_all("div", {"class": "khunglon"})
#
#     for n in hyips:
#         st = time.time()
#         hyip.append(n.find("a").get_text().strip().capitalize())
#         url.append(self.__hyip_url(n.find("a").attrs['href']))
#         status.append(self.__get_status(n.find("div", {"class": "k-status"}).get_text()))
#         ttm.append(time.time() - st)
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#
#
# def keyhyip(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#     hyips = bs.find_all("div", {"class": "program"})
#
#     for n in hyips:
#         st = time.time()
#         ss = 0
#         hyip.append(n.find("a").get_text().strip().capitalize())
#         url.append(self.__hyip_url(n.find("a").attrs['href']))
#         s = n.find("div", {"class": "status"}).attrs['class']
#         if s[1] == "status1":
#             ss = 1
#         status.append(ss)
#         ttm.append(time.time() - st)
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#
#
# def hyips(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#     hyips = bs.find_all("div", {"class": "listcontainer"})
#
#     for n in hyips:
#         st = time.time()
#         hyip.append(n.find("a", {"class": "hyip"}).get_text().strip().capitalize())
#         url.append(self.__hyip_url(n.find("a").attrs['href']))
#         status.append(self.__get_status(n.find("label", {"class": "label"}).get_text()))
#         ttm.append(time.time() - st)
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#
#
# def hyipexplorer(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#
#     for n in bs("font", color="red"):
#         hyip.append(n.find_parent("b").text.strip().capitalize())
#
#     for n in bs("a", string="Vote!"):
#         st = time.time()
#         u = n.attrs['href']
#         u = int(''.join(filter(str.isdigit, u)))
#         url.append(self.__hyip_url("https://www.hyipexplorer.com/visit.php?lid=" + str(u)))
#         ttm.append(time.time() - st)
#
#     for n in bs("span", class_="bl"):
#         status.append(self.__get_status(n.find_parent().text))
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#
#
# def asianhyip(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#
#     for n in bs("div", class_="program"):
#         st = time.time()
#         k = n.find("div", class_="title2")
#         hyip.append(k.text.strip().capitalize())
#         url.append(self.__hyip_url(k.a.attrs['href']))
#         status.append(self.__get_status(k.next_sibling.next_sibling.text))
#         ttm.append(time.time() - st)
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#
#
# def makemoneyventure(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#     hyips = bs("div", class_="program")
#
#     for n in hyips:
#         st = time.time()
#         hyip.append(n.find("div", class_="nameprogram").text.strip().strip().capitalize())
#         url.append(self.__hyip_url(n.a.attrs['href']))
#         status.append(self.__get_status(n.find("div", class_="m-status").text))
#         ttm.append(time.time() - st)
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#
#
# def hyipbusket(self, monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = self.__source(monitor)
#     hyips = bs("div", class_="btmbdylftbx")
#
#     for n in hyips:
#         st = time.time()
#         hyip.append(n.find("a").text.strip().strip().capitalize())
#         url.append(self.__hyip_url(n.find("a").attrs['href']))
#         status.append(self.__get_status(n.find("b").text))
#         ttm.append(time.time() - st)
#
#     self.__store_hyip(monitor, hyip, url, status, ttm)
#

if __name__ == "__main__":
    cnx = mysql.connector.connect(host='localhost', user='al', passwd='Zaichik1.&', database='hyip')
    cursor = cnx.cursor(prepared=True)
    headers = {"user-agent": 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
    graspgold_com()
    eurohyips_net()
    hyiphome_net()
    cursor.close()
    cnx.close()
    huy = None
