from flask import Flask, request, jsonify
import joblib
import json
import pandas as pd

app = Flask(__name__)

# =========================
# LOAD MODEL
# =========================
model = joblib.load("../python_artifacts/modell.joblib")

# =========================
# LOAD FEATURE
# =========================
with open("../python_artifacts/feature_cols.json") as f:
    feature_cols = json.load(f)

# =========================
# LOAD EXCEL
# =========================
df_info = pd.read_excel("../public/data/Bissmilah lagi.xlsx")

# bersihin data
df_info.columns = df_info.columns.str.strip()

for col in df_info.columns:
    df_info[col] = df_info[col].astype(str).str.strip()

df_info['Penyakit'] = df_info['Penyakit'].str.lower()

# buat dictionary
info_penyakit = {}

for _, row in df_info.iterrows():
    info_penyakit[row['Penyakit']] = {
        "jenis": row['Jenis'],
        "pertolongan": [p.strip() for p in row['Pertolongan'].split(";")],
        "pencegahan": [p.strip() for p in row['Pencegahan'].split(";")]
    }

print("DATA PENYAKIT:", info_penyakit.keys())

# =========================
# ENDPOINT GEJALA
# =========================
@app.route('/gejala', methods=['GET'])
def get_gejala():
    return jsonify(feature_cols)

# =========================
# ENDPOINT PREDICT
# =========================
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
    penyakit = str(hasil).lower().strip()

    print("HASIL MODEL:", hasil)
    print("CARI DI EXCEL:", penyakit)

    info = info_penyakit.get(penyakit)

    if not info:
        return jsonify({
            "penyakit": hasil,
            "jenis": "-",
            "pertolongan": [],
            "pencegahan": []
        })

    return jsonify({
        "penyakit": hasil,
        "jenis": info["jenis"],
        "pertolongan": info["pertolongan"],
        "pencegahan": info["pencegahan"]
    })

# =========================
# RUN APP
# =========================
if __name__ == '__main__':
    print("API MODEL SIAP DIGUNAKAN 🔥")
    app.run(debug=True)