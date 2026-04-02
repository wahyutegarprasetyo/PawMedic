from flask import Flask, request, jsonify
import joblib
import json
import pandas as pd

app = Flask(__name__)

# load model
model = joblib.load("../python_artifacts/modell.joblib")

# load fitur
with open("../python_artifacts/feature_cols.json") as f:
    feature_cols = json.load(f)

# endpoint gejala
@app.route('/gejala', methods=['GET'])
def get_gejala():
    return jsonify(feature_cols)

# endpoint predict
@app.route('/predict', methods=['POST'])
def predict():
    data = request.json

    print("INPUT FROM LARAVEL:", data)

    input_data = []

    for col in feature_cols:
        val = data.get(col, 0)
        input_data.append(1 if str(val) == "1" else 0)

    print("INPUT VECTOR:", input_data)

    input_df = pd.DataFrame([input_data], columns=feature_cols)

    hasil = model.predict(input_df)[0]

    return jsonify({
        "hasil": hasil
    })
if __name__ == '__main__':
    print("API MODEL SIAP DIGUNAKAN (DARI JUPYTER)")
    app.run(debug=True)
    print("FEATURE COLS:", feature_cols)
print("INPUT FROM LARAVEL:", data)
print("INPUT VECTOR:", input_data)