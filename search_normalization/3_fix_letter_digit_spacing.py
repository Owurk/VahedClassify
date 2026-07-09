import json
import re

def add_spaces(text):
    if not isinstance(text, str):
        return text
    
    digits = r'0-9۰-۹٠-٩'
    
    # separate letters from digits in both directions
    text = re.sub(f'([^\\s{digits}])([{digits}])', r'\1 \2', text)
    text = re.sub(f'([{digits}])([^\\s{digits}])', r'\1 \2', text)
    
    return text

def process_data(data):
    if isinstance(data, dict):
        new_dict = {}
        for key, value in data.items():
            # skip fields that hold raw text or aggregated stats
            if key in ["نظرات", "positive", "negative"]:
                new_dict[key] = value
            else:
                new_key = add_spaces(key)
                new_dict[new_key] = process_data(value)
        return new_dict
    elif isinstance(data, list):
        return [process_data(item) for item in data]
    elif isinstance(data, str):
        return add_spaces(data)
    else:
        return data

try:
    with open('data_words_converted.json', 'r', encoding='utf-8') as f:
        json_data = json.load(f)

    fixed_data = process_data(json_data)

    with open('data_fixed.json', 'w', encoding='utf-8') as f:
        json.dump(fixed_data, f, ensure_ascii=False, indent=2)
    
    print("Processing complete. Saved to 'data_fixed.json'.")

except FileNotFoundError:
    print("Error: data.json not found.")