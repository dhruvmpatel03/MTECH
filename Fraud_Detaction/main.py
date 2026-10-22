import pandas as pd
import numpy as np

from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.ensemble import IsolationForest
from sklearn.metrics import classification_report, accuracy_score, confusion_matrix

from sklearn.preprocessing import StandardScaler
import seaborn as sns
import matplotlib.pyplot as plt

df = pd.read_csv("creditcard.csv")

print("Dataset Shape:", df.shape)
print(df['Class'].value_counts())

#HANDLE IMBALANCED DATA
fraud = df[df.Class == 1]
normal = df[df.Class == 0]

# Take equal samples
normal_sample = normal.sample(n=len(fraud), random_state=42)

df_balanced = pd.concat([fraud, normal_sample])
df_balanced = df_balanced.sample(frac=1, random_state=42)


# SPLIT FEATURES & TARGET
X = df_balanced.drop("Class", axis=1)
y = df_balanced["Class"]


# TRAIN TEST SPLIT
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, random_state=42
)

# FEATURE SCALING 
scaler = StandardScaler()

X_train = scaler.fit_transform(X_train)
X_test = scaler.transform(X_test)

#LOGISTIC REGRESSION
lr = LogisticRegression(max_iter=5000, solver='liblinear')
lr.fit(X_train, y_train)

lr_pred = lr.predict(X_test)

#ISOLATION FOREST
iso = IsolationForest(contamination=0.01, random_state=42)
iso.fit(X_train)

iso_pred = iso.predict(X_test)

# Convert (-1,1) → (1,0)
iso_pred = np.where(iso_pred == -1, 1, 0)

# HYBRID MODEL
final_pred = np.where((lr_pred + iso_pred) > 0, 1, 0)

print("\n===== Logistic Regression =====")
print(classification_report(y_test, lr_pred))

print("\n===== Isolation Forest =====")
print(classification_report(y_test, iso_pred))

print("\n===== Hybrid Model =====")
print("Accuracy:", accuracy_score(y_test, final_pred))
print(classification_report(y_test, final_pred))

