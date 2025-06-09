import sys
import json
import pandas as pd

# Membaca dataset
df = pd.read_csv('dataset_kambing.csv')

# Membuat basis aturan dari dataset
rules = []
for index, row in df.iterrows():
    conditions = set(row['gejala'].split(', '))
    conclusion = row['diagnosis']
    rules.append({'conditions': conditions, 'conclusion': conclusion})

# Mesin inferensi forward chaining
def forward_chaining(facts, rules):
    detected_diseases = set()
    for rule in rules:
        if rule['conditions'].issubset(facts):
            detected_diseases.add(rule['conclusion'])
    return detected_diseases

# Input gejala dari pengguna
def input_gejala():
    facts = set()
    print("Masukkan gejala yang dialami kambing (ketik 'selesai' untuk mengakhiri):")
    while True:
        gejala = input("- ").strip().lower()
        if gejala == "selesai":
            break
        if gejala:
            facts.add(gejala)
    return facts

# Program utama
if __name__ == "__main__":
    print("=== Sistem Deteksi Penyakit Kambing - Forward Chaining ===")
    user_facts = input_gejala()
    hasil = forward_chaining(user_facts, rules)

    if hasil:
        print("\n🩺 Kemungkinan penyakit kambing:")
        for penyakit in hasil:
            print(f"- {penyakit}")
    else:
        print("\n❌ Tidak ada penyakit yang terdeteksi berdasarkan gejala tersebut.")
