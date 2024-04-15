from bs4 import BeautifulSoup
import mysql.connector
import requests
from urllib.parse import urlparse
import random

# https://www.crummy.com/software/BeautifulSoup/bs4/doc/

hyips = []


def rate():
    # hyips = [['Hourlysoo ltd', 'https://hourlysoo.com'],
    #         ['Bitpro.acc', 'https://bitpro.ac'],
    #         ['Bitpro.ac', 'https://bitpro.ac'],
    #         ['Gainpay', 'https://gainpay.club'],
    #         ['Cfg liberty', 'https://cfgliberty.com'],
    #         ['Hourlysoo ltd', 'https://hourlysoo.com'],
    #         ['Hourlysoo ltd', 'https://hourlysoo.com'],
    #         ['Hourlysoo ltd', 'https://hourlysoo.com']]

    unique_hyips = []

    for h in hyips:
        unique_hyips.append(h[1])

    unique_hyips = set(unique_hyips)
    unique_hyips = (list(unique_hyips))

    graph_data = []

    for h in unique_hyips:
        ratehuy = sum(x.count(h) for x in hyips)
        graph = [x for x in hyips if h in x][0]
        r = random.random()
        graph_data.append([graph[0], graph[1], ratehuy + r])

    query = "INSERT INTO graph (hyip, url, rate) VALUES (%s, %s, %s)"
    cursor.executemany(query, graph_data)
    cnx.commit()
    sa = None


def __get_status(status):
    s = 0
    if status.lower() == "paying" or status.lower() == "pays" or status.lower() == "платит":
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
        elapsed = source.elapsed.total_seconds()
        res_code = source.status_code

        query = "UPDATE monitor SET res_code = %s, elapsed = %s WHERE monitor = %s"
        cursor.execute(query, (res_code, elapsed, monitor))
        cnx.commit()

        return BeautifulSoup(source.text, features='html.parser')

    return BeautifulSoup('<!DOCTYPE html><html lang="en"><head></head><body>huy</body></html>', features='html.parser')


# def soups(monitor):
#     source = None
#     try:
#         # source = requests.get(monitor, headers=headers, timeout=None)
#         with open('b.html', 'r') as file:
#             source = file.read()
#     except Exception as e:
#         print(e)
#         pass
#
#     if source is not None:
#         # elapsed = source.elapsed.total_seconds()
#         # res_code = source.status_code
#
#         # query = "UPDATE monitor SET res_code = %s, elapsed = %s WHERE monitor = %s"
#         # cursor.execute(query, (res_code, elapsed, monitor))
#         # cnx.commit()
#
#         return BeautifulSoup(source, features='html.parser')
#
#     return BeautifulSoup('<!DOCTYPE html><html lang="en"><head></head><body></body></html>', features='html.parser')


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
    soup = soups('https://graspgold.com')
    for n in soup.find_all('div', class_='details'):
        try:
            if __get_status(n.find('div', class_='status_vote').find('span').get_text().strip()) == 1:
                url = urls(n.find('a').get('href'))
                if url is not None and url != '':
                    hyip = n.find('a').get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def eurohyips_net():
    soup = soups('https://eurohyips.net')
    for n in soup.find_all("div", class_='projects_listing'):
        try:
            if __get_status(n.find('div', class_='project_status').find('span').get_text().strip()) == 1:
                url = urls(n.find('a').get('href'))
                if url is not None and url != '':
                    hyip = n.find('a').get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def hyiphome_net():
    soup = soups('https://www.hyiphome.net')
    for n in soup.find_all("div", class_='main-col'):
        try:
            if __get_status(n.find('div', class_='b-status').get_text().strip()) == 1:
                url = urls(n.find('a').get('href'))
                if url is not None and url != '':
                    hyip = n.find('a').get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def invest_tracing_com():
    soup = soups('https://invest-tracing.com')
    for n in soup.find_all("div", class_='listcontainer'):
        try:
            if __get_status(n.find('label', class_='label').get_text().strip()) == 1:
                url = urls("https://invest-tracing.com/" + n.find('a', class_='hyip').get('href'))
                if url is not None and url != '':
                    hyip = n.find('a', class_='hyip').get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def instant_monitor_com():
    soup = soups('https://instant-monitor.com')
    for n in soup.find_all("div", class_='listcontainer'):
        try:
            if __get_status(n.find("span").get_text().strip()) == 1:
                url = urls("https://instant-monitor.com" + n.find("a").get('href'))
                if url is not None and url != '':
                    hyip = n.find("a").get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def exclusive_profit_com():
    soup = soups('https://exclusive-profit.com')
    for n in soup.find_all("div", class_='c-project-preview-i'):
        try:
            if __get_status(n.find("span").get_text().strip()) == 1:
                url = n.find("table").find_all("a")
                url = urls(url[1].get('href'))
                if url is not None and url != '':
                    hyip = n.find_all("a")
                    hyip = hyip[2].get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def fairmonitor_com():
    soup = soups('https://fairmonitor.com/?lang=fr')
    for n in soup.find_all("table", class_='detn_stat1_block'):
        try:
            if __get_status(n.find("span").get_text().strip()) == 1:
                url = urls(n.find("a").get('href'))
                if url is not None and url != '':
                    hyip = n.find("a").get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def hyipclub_club():
    soup = soups('https://hyipclub.club')
    for n in soup.find_all("div", class_='khunglon'):
        try:
            if __get_status(n.find("div", class_='k-status').get_text().strip()) == 1:
                url = urls(n.find("a").get('href'))
                if url is not None and url != '':
                    hyip = n.find("a").get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def keyhyip_com():
    soup = soups('https://keyhyip.com')
    for n in soup.find_all("div", class_='program'):
        try:
            s = n.find("div", class_='status').attrs['class']
            if s[1] == "status1":
                url = urls(n.find("a").get('href'))
                if url is not None and url != '':
                    hyip = n.find("a").get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def hyips_bz():
    soup = soups('https://hyips.bz')
    for n in soup.find_all("div", class_='listcontainer'):
        try:
            if __get_status(n.find('label', class_='label').get_text().strip()) == 1:
                url = urls(n.find("a").get('href'))
                if url is not None and url != '':
                    hyip = n.find('a', class_='hyip').get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


def hyipexplorer_com():
    soup = soups('https://www.hyipexplorer.com')
    for n in soup.find_all('table', class_='hyip'):
        try:
            if __get_status(n.find('div', class_='status').get_text().strip()) == 1:
                url = urls('https://www.hyipexplorer.com/' + n.find("a").get('href'))
                if url is not None and url != '':
                    hyip = n.find('a').get_text().strip().capitalize()
                    if hyip is not None and hyip != '':
                        hyips.append([hyip, url])
        except Exception as e:
            print(e)
            pass


if __name__ == "__main__":
    cnx = mysql.connector.connect(host='localhost', user='al', passwd='Zaichik1.&', database='hyip')
    cursor = cnx.cursor(prepared=True)
    headers = {"user-agent": 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
    graspgold_com()
    eurohyips_net()
    hyiphome_net()
    invest_tracing_com()
    instant_monitor_com()
    exclusive_profit_com()
    fairmonitor_com()
    hyipclub_club()
    keyhyip_com()
    hyips_bz()
    hyipexplorer_com()
    rate()
    cursor.close()
    cnx.close()
    huy = None
