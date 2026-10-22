import matplotlib.pyplot as plt

labels = ['Normal FL','With Attack','With Detection']
accuracy = [88,65,85]

plt.bar(labels,accuracy)

plt.title("Federated Learning Performance")

plt.ylabel("Accuracy")

plt.show()