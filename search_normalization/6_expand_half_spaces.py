import json

def expand_half_spaces(text):
    if not isinstance(text, str) or not text.strip():
        return text

    # unicode for zero width non-joiner (half-space)
    zwnj = '\u200c'
    
    if zwnj not in text:
        return text

    parts = text.split(' ')
    expanded_parts = []

    for part in parts:
        expanded_parts.append(part)
        
        if zwnj in part:
            # add a spaced version for better search indexing
            spaced_version = part.replace(zwnj, ' ')
            
            # avoid duplicates
            if spaced_version not in expanded_parts:
                expanded_parts.append(spaced_version)

    return " ".join(expanded_parts)

def process_data(data):
    if isinstance(data, dict):
        new_dict = {}
        for key, value in data.items():
            # skip meta fields
            if key in ["نظرات", "positive", "negative"]:
                new_dict[key] = value
            else:
                new_key = expand_half_spaces(key)
                new_dict[new_key] = process_data(value)
        return new_dict
    elif isinstance(data, list):
        return [process_data(item) for item in data]
    elif isinstance(data, str):
        # skip pure numeric strings
        if any(c.isalpha() for c in data):
            return expand_half_spaces(data)
        return data
    else:
        return data

try:
    input_filename = 'data_final.json' 
    output_filename = 'data_no_zwnj.json'

    with open(input_filename, 'r', encoding='utf-8') as f:
        json_data = json.load(f)

    processed_data = process_data(json_data)

    with open(output_filename, 'w', encoding='utf-8') as f:
        json.dump(processed_data, f, ensure_ascii=False, indent=2)
    
    print(f"Success! Half-spaces expanded in '{output_filename}'.")

except FileNotFoundError:
    print("Error: Input file not found.")
except Exception as e:
    print(f"An error occurred: {e}")