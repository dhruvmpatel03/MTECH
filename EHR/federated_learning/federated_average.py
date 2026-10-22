import numpy as np

def federated_avg(models):
    avg_coef = np.mean([m.coef_ for m in models], axis=0)
    avg_intercept = np.mean([m.intercept_ for m in models], axis=0)

    global_model = models[0]
    global_model.coef_ = avg_coef
    global_model.intercept_ = avg_intercept

    return global_model