import matplotlib.pyplot as plt
import numpy as np

plt.style.use('_mpl-gallery')

# make data
# x = np.linspace(0, 10, 100)
# y = 4 + 2 * np.sin(2 * x)

# plot
fig, ax = plt.subplots()
x = [1, 2, 3]
y = [1, 2, 3]
# y = np.array([[1, 2], [3.json, 4], [5, 6]])

ax.plot(x, y, linewidth=1.0)
# ax.plot(x, y, linewidth=1.0)

# ax.set(xlim=(0, 8), xticks=np.arange(1, 8),
#        ylim=(0, 8), yticks=np.arange(1, 8))

ax.set(xlim=(0, 8), xticks=np.arange(1, 8),
       ylim=(0, 8), yticks=np.arange(1, 8))

plt.show()
