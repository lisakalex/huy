import glob2

# this file must be in top directory where all files to be edited
kak = []
kak1 = []
with open("huy.txt") as file:
    s = file.read()
    x = s.split("--2023")
    for ka in x:
        if "301 Moved Permanently" in ka and "net/?p" not in ka:
            ka = ka.replace("Reusing existing connection to www.pythontutorial.net:443.\n", '')
            ka = ka.replace("HTTP request sent, awaiting response... 301 Moved Permanently\n", '')
            ka = ka.replace("[following]\n", '')
            ka1 = ka.split('\n')
            kak1.append(ka + '\n')

            da = ka1[0].index('pythontutorial.net')
            da1 = ka1[0][da:]
            da1 = da1.strip()

            du = ka1[1].index('pythontutorial.net')
            du1 = ka1[1][du:]
            du1 = du1.strip()

            kak.append([da1, du1])


kak.append(['https://www.pythontutorial.net', ''])
kak.append(['href=""', 'href="/"'])
kak.append(['?', '%3F'])


def replaceall(this, withthis):
    for filepath in glob2.iglob('./**/*.html', recursive=True):
        with open(filepath) as file:
            sa = file.read()
        sa = sa.replace(this, withthis)
        with open(filepath, "w") as file:
            file.write(sa)


for ka in kak:
    replaceall(ka[0], ka[1])


with open("huy-1.txt", "w") as file:
    for ka in kak1:
        file.write(ka)
