import glob2

# this file must be in top directory where all files to be edited
kak = []
with open("huy.txt") as file:
    s = file.read()
    x = s.split("--2023")

    for ka in x:
        if "301 Moved Permanently" in ka and "net/?p" not in ka:
            ka = ka.replace("Reusing existing connection to www.pythontutorial.net:443.\n", '')
            ka = ka.replace("HTTP request sent, awaiting response... 301 Moved Permanently\n", '')
            ka = ka.replace("[following]\n", '')
            ka1 = ka.split('\n')
            kak.append(ka + "\n \n")

with open("huy-1.txt", "w") as file:
    for ka in kak:
        file.write(ka)
