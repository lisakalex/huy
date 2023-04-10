import glob2
import json
from bs4 import BeautifulSoup
import requests
from pathlib import Path

# /price-track/price-track.htm
# /nftdrop/list.htm
htmls = [
    '/price-track/price-track.htm',
    '/nftdrop/list.htm'
]


def get_loadmoretype(url):
    # kak = url
    # url = '/paged/' + url
    # url = 'https://cryptonews.com/' + url
    try:
        headers = {'user-agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
        source = requests.get('https://cryptonews.com/' + url, headers=headers, timeout=None)

        # with open('.' + url, "w") as file:
        #     file.write(source.text)

        output_file = Path(url)
        output_file.parent.mkdir(exist_ok=True, parents=True)
        output_file.write_text(source.text)
    except Exception as e:
        ex = str(e)
        source1 = "xxx"
        pass


def download_html(htmls):
    for h in htmls:
        get_loadmoretype(h)


download_html(htmls)

# download json files for paged directory
# for filepath in glob2.iglob('./**/*.html', recursive=True):
#     with open(filepath) as file:
#         sa = file.read()
#         soup = BeautifulSoup(sa, features="html.parser")
#         su = soup.find_all("a")
#         for link in su:
#             loadmoretype_1 = link.get('loadmoretype')
#             if loadmoretype_1:
#                 get_loadmoretype(loadmoretype_1 + '-1.json')
#
# # find and replace
# countreplace = 0
# for filepath in glob2.iglob('./**/*.htm', recursive=True):
#     with open(filepath) as file:
#         s = file.read()
#
#     s = s.replace('https://cryptonews.com', '')
#     countreplace = countreplace + 1
#     with open(filepath, "w") as file:
#         file.write(s)
#
# with open('countreplacehtm.txt', "a") as file:
#     file.write(str(countreplace))
#
# countreplace = 0
# for filepath in glob2.iglob('./**/*.html', recursive=True):
#     with open(filepath) as file:
#         s = file.read()
#
#     s = s.replace('https://cryptonews.com', '')
#     countreplace = countreplace + 1
#     with open(filepath, "w") as file:
#         file.write(s)
#
# with open('countreplacehtml.txt', "a") as file:
#     file.write(str(countreplace))

ha1 = None
