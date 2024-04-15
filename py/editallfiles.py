import glob2

for filepath in glob2.iglob('./**/*.html', recursive=True):
    with open(filepath) as file:
        s = file.read()
    s = s.replace('https://www.oracletutorial.com', '')
    with open(filepath, "w") as file:
        file.write(s)
