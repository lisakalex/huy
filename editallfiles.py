import glob2


def method_name(this, withthis):
    for filepath in glob2.iglob('./**/*.html', recursive=True):
        with open(filepath) as file:
            s = file.read()
        s = s.replace(this, withthis)
        with open(filepath, "w") as file:
            file.write(s)


# this file must be in top directory where all files to be edited
method_name()
