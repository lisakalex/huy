import glob2
import json
from bs4 import BeautifulSoup

# this file must be in top directory where all files to be edited
# kak = []
# kak1 = []
# with open("../../paged/newsbitcoin-news-1.json") as file:
#     s = file.read()
#     # s1 = s.json.dumps(s)
#     y = json.loads(s)

# with open("../../paged/newsbitcoin-news-1.json") as fp:
# soup = BeautifulSoup(y)
#
# kak = soup.findAll('article')
#
# for ka in kak:
#     try:
#         ka.attrs['href']
#     except KeyError:
#         ka.attrs['href'] = None
#
#     if "https://www.oracletutorial.com" in ka.attrs['href']:
#         ka.attrs['href'] = ka.attrs['href'].replace("https://www.oracletutorial.com", "")
#         # ka.attrs['href'] = huy
# html = soup.prettify("utf-8")
# with open("../../paged/newsbitcoin-news-1.htm", "w") as file:
#     file.write(y[0])

ha = None


#     x = s.split("--2023")
#     for ka in x:
#         if "301 Moved Permanently" in ka and "net/?p" not in ka:
#             ka = ka.replace("Reusing existing connection to www.pythontutorial.net:443.\n", '')
#             ka = ka.replace("HTTP request sent, awaiting response... 301 Moved Permanently\n", '')
#             ka = ka.replace("[following]\n", '')
#             ka1 = ka.split('\n')
#             kak1.append(ka + '\n')
#
#             da = ka1[0].index('pythontutorial.net')
#             da1 = ka1[0][da:]
#             da1 = da1.strip()
#
#             du = ka1[1].index('pythontutorial.net')
#             du1 = ka1[1][du:]
#             du1 = du1.strip()
#
#             kak.append([da1, du1])
#
# kak.append(['https://www.pythontutorial.net', ''])
# kak.append(['href=""', 'href="/"'])
# kak.append(['?', '%3F'])


# with open("./paged/newsbitcoin-news-1.json") as fp:
#     soup = BeautifulSoup(fp, features="html.parser")
#
# kak = soup.findAll('a')
#
# for ka in kak:
#     try:
#         ka.attrs['href']
#     except KeyError:
#         ka.attrs['href'] = None
#
#     if "https://www.oracletutorial.com" in ka.attrs['href']:
#         ka.attrs['href'] = ka.attrs['href'].replace("https://www.oracletutorial.com", "")
#         # ka.attrs['href'] = huy
# html = soup.prettify("utf-8")
# with open("./getting-started/install-oracle/index.html", "wb") as file:
#     file.write(html)
#
# ha = None

# def replaceall(this, withthis):
#     for filepath in glob2.iglob('./**/*.html', recursive=True):
#         with open(filepath) as file:
#             sa = file.read()
#         sa = sa.replace(this, withthis)
#         with open(filepath, "w") as file:
#             file.write(sa)

def replaceall():
    for filepath in glob2.iglob('./**/*.html', recursive=True):
        with open(filepath) as file:
            sa = file.read()
        # sa = sa.replace(this, withthis)
        soup = BeautifulSoup(sa)
        with open(filepath, "w") as file:
            file.write(sa)

    #


replaceall()
#
# with open("huy-1.txt", "w") as file:
#     for ka in kak1:
#         file.write(ka)
