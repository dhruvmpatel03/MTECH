from sklearn.linear_model import LogisticRegression
from sklearn.preprocessing import StandardScaler

def train_local_model(X, y):
    scaler = StandardScaler()
    X_scaled = scaler.fit_transform(X)

    model = LogisticRegression(max_iter=2000)
    model.fit(X_scaled, y)

    # attach scaler to model
    model.scaler = scaler

    return model