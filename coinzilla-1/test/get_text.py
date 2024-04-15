#!/home/al/.venv/bin/python3.10
import requests
import time

print('Hello from Python 3.json')

try:
    start = time.time()
    headers = {'user-agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
    source = requests.get('https://siterankdata.com/', headers=headers, timeout=None)
    elapsed = time.time() - start
    scode = source.status_code

except Exception as e:
    ex = str(e)
    source = "xxx"
    pass

with open('/var/www/html/coinzilla-1/test/get_text.txt', 'w') as fp:
    if source != "xxx":
        fp.write(source.text)
