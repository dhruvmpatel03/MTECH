import numpy as np

def detect_malicious(models, threshold=10.0):
    clean_models = []
    removed = 0

    for m in models:
        norm = np.linalg.norm(m.coef_)

        if norm < threshold:
            clean_models.append(m)
        else:
            removed += 1

    print("Malicious models detected:", removed)

    return clean_models