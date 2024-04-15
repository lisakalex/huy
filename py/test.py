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

ku = ['paying', 'pays', 'платит', 'not paying']


def __get_status(status):
    s = 0
    # if status.lower().find("paying") != -1:
    #     if status.lower().find("pays") != -1:
    #         if status.lower().find("платит") != -1:
    #             if status.lower().find("not paying") == -1:

    if status.lower() == "paying" or status.lower() == "pays" or status.lower() == "платит":
        s = 1
    return s


for k in ku:
    __get_status(k)

d = None
