import json
import re

def sync_digits(text):
    if not isinstance(text, str):
        return text

    fa_ar_digits_chars = "۰۱۲۳۴۵۶۷۸۹٠١٢٣٤٥٦٧٨٩"
    en_digits_chars = "0123456789"
    
    fa_to_en_table = str.maketrans(fa_ar_digits_chars, "01234567890123456789")
    en_to_fa_table = str.maketrans(en_digits_chars, "۰۱۲۳۴۵۶۷۸۹")

    has_fa_ar = any(char in fa_ar_digits_chars for char in text)
    has_en = any(char in en_digits_chars for char in text)

    # append english equivalents for search indexing
    if has_fa_ar and not has_en:
        found_numbers = re.findall(f"[{fa_ar_digits_chars}]+", text)
        converted = " ".join(num.translate(fa_to_en_table) for num in found_numbers)
        return f"{text} {converted}"

    # append persian equivalents for search indexing
    if has_en and not has_fa_ar:
        found_numbers = re.findall(f"[{en_digits_chars}]+", text)
        converted = " ".join(num.translate(en_to_fa_table) for num in found_numbers)
        return f"{text} {converted}"

    return text

def process_data(data):
    if isinstance(data, dict):
        new_dict = {}
        for key, value in data.items():
            # skip aggregated stats fields
            if key in ["نظرات", "positive", "negative"]:
                new_dict[key] = value
            else:
                new_key = sync_digits(key)
                new_dict[new_key] = process_data(value)
        return new_dict
    elif isinstance(data, list):
        return [process_data(item) for item in data]
    elif isinstance(data, str):
        return sync_digits(data)
    else:
        return data

try:
    input_filename = 'data_fixed.json'
    output_filename = 'data_synced.json'

    with open(input_filename, 'r', encoding='utf-8') as f:
        json_data = json.load(f)

    synced_data = process_data(json_data)

    with open(output_filename, 'w', encoding='utf-8') as f:
        json.dump(synced_data, f, ensure_ascii=False, indent=2)
    
    print(f"Success! Saved to '{output_filename}'.")

except FileNotFoundError:
    print("Error: Input file not found.")