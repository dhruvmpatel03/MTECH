from sklearn.datasets import load_breast_cancer
from sklearn.model_selection import train_test_split

def load_data():
    data = load_breast_cancer()

    X_train, X_test, y_train, y_test = train_test_split(
        data.data, data.target, test_size=0.3, random_state=42
    )

    split1 = int(len(X_train) / 3)
    split2 = int(2 * len(X_train) / 3)

    h1 = (X_train[:split1], y_train[:split1])
    h2 = (X_train[split1:split2], y_train[split1:split2])
    h3 = (X_train[split2:], y_train[split2:])

    return h1, h2, h3, (X_test, y_test)