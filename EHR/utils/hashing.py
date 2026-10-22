import hashlib


def generate_hash(model):
    data = str(model.coef_) + str(model.intercept_)
    return hashlib.sha256(data.encode()).hexdigest()
