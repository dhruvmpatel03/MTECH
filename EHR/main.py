from dataset.load_dataset import load_data
from federated_learning.hospital_client import train_local_model
from federated_learning.federated_average import federated_avg
from security.anomaly_detection import detect_malicious
from utils.hashing import generate_hash

from sklearn.metrics import accuracy_score
from web3 import Web3
import numpy as np

# ---------------- BLOCKCHAIN ----------------
w3 = Web3(Web3.HTTPProvider("http://127.0.0.1:7545"))
contract_address = "0xd5ad5Be10cDf4981b814FD8710DD116ce6c37C29"
abi =[
  {
    "inputs": [
      {
        "internalType": "string",
        "name": "_hash",
        "type": "string"
      }
    ],
    "name": "storeHash",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256",
        "name": "index",
        "type": "uint256"
      }
    ],
    "name": "getHash",
    "outputs": [
      {
        "internalType": "string",
        "name": "",
        "type": "string"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "name": "modelHashes",
    "outputs": [
      {
        "internalType": "string",
        "name": "",
        "type": "string"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  }
]
contract = w3.eth.contract(address=contract_address, abi=abi)

def store_on_blockchain(model_hash):
    tx = contract.functions.storeHash(model_hash).transact({
        'from': w3.eth.accounts[0]
    })
    w3.eth.wait_for_transaction_receipt(tx)

# ---------------- LOAD DATA ----------------
(h1X, h1y), (h2X, h2y), (h3X, h3y), (X_test, y_test) = load_data()

print("Dataset shape:", X_test.shape)
print("Number of features:", X_test.shape[1])

# ---------------- TRAIN ----------------
model1 = train_local_model(h1X, h1y)
model2 = train_local_model(h2X, h2y)
model3 = train_local_model(h3X, h3y)

# SIMULATE MALICIOUS MODEL
model1.coef_ = model1.coef_ * 50

local_models = [model1, model2, model3]

print("Total models received:", len(local_models))

# ---------------- BEFORE ANOMALY ----------------
global_before = federated_avg(local_models)

# IMPORTANT: scale test data
X_test_scaled = global_before.scaler.transform(X_test)

y_pred_before = global_before.predict(X_test_scaled)
acc_before = accuracy_score(y_test, y_pred_before)

# ---------------- ANOMALY DETECTION ----------------
clean_models = detect_malicious(local_models)
print("Models after anomaly detection:", len(clean_models))

# ---------------- AFTER ANOMALY ----------------
global_after = federated_avg(clean_models)

#  IMPORTANT: scale test data again
X_test_scaled = global_after.scaler.transform(X_test)

y_pred_after = global_after.predict(X_test_scaled)
acc_after = accuracy_score(y_test, y_pred_after)

print("Accuracy BEFORE anomaly detection:", acc_before)
print("Accuracy AFTER anomaly detection:", acc_after)

# ---------------- BLOCKCHAIN ----------------
global_hash = generate_hash(global_after)
print("Global Model Hash:", global_hash)

store_on_blockchain(global_hash)

print("Lightweight FL using Logistic Regression")






