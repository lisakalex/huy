import requests

session = requests.Session()
params = {'username': 'tcps@bk.ru', 'password': 'Zaichik1.&'}
s = session.post("https://display.Investment market.com/sign-in/", params)
print("Cookie is set to:")
print(s.cookies.get_dict())
print("-----------")
print("Going to profile page…")
s = session.get("https://display.Investment market.com/sign-in/")
print(s.text)
