#! /usr/bin/python3
from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options
import random
from pathlib import Path
# from Hyip import Hyip
from xvfbwrapper import Xvfb
import time
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.common.exceptions import TimeoutException

import numpy as np
a = np.array([1, 2, 3])

# import Exception

#
#
# hyip = Hyip()
#
#
# def fairmonitor(monitor):
#     hyip, url, status, hyip_data, ttm = [], [], [], [], []
#     bs = hyip.source(monitor)
#     hyips = bs.find_all("table", {"class": "detn_stat1_block"})
#
#     for n in hyips:
#         st = time.time()
#         hyip.append(n.find("a").get_text().strip().capitalize())
#         url.append(hyip.__hyip_url(n.find("a").attrs['href']))
#         status.append(hyip.__get_status(n.find("span").get_text()))
#         ttm.append(time.time() - st)
#
#     hyip.__store_hyip(monitor, hyip, url, status, ttm)
#
#
#
# kak = hyip.fairmonitor("https://fairmonitor.com/?lang=fr")
# kak = hyip.fairmonitor("https://bitwealth.company")
d = None
