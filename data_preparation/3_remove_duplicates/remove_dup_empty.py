import json

def remove_and_extract_duplicates(input_filepath, output_filepath, duplicates_filepath):
    with open(input_filepath, 'r', encoding='utf-8') as file:
        data = json.load(file)

    seen = set()
    unique_data = []
    duplicates_data = []

    for item in data:
        item_for_comparison = item.copy()
        item_for_comparison.pop("زمان", None)
        
        dict_string = json.dumps(item_for_comparison, sort_keys=True, ensure_ascii=False)
        
        if dict_string not in seen:
            seen.add(dict_string)
            unique_data.append(item)
        else:
            duplicates_data.append(item)

    with open(output_filepath, 'w', encoding='utf-8') as file:
        json.dump(unique_data, file, ensure_ascii=False, indent=4)
        
    with open(duplicates_filepath, 'w', encoding='utf-8') as file:
        json.dump(duplicates_data, file, ensure_ascii=False, indent=4)
        
    print(f"len of all records: {len(data)}")
    print(f"len of unique records (saved at {output_filepath}): {len(unique_data)}")
    print(f"len of duplicated records (saved at {duplicates_filepath}): {len(duplicates_data)}")

input_file = 'reviews_fa.json'
output_file = 'reviews_fa_unique.json'
duplicates_file = 'duplicates_data.json'

remove_and_extract_duplicates(input_file, output_file, duplicates_file)
