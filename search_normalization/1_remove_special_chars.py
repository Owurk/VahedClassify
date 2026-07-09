import json
import re

def replace_special_chars(text):
    if not isinstance(text, str):
        return text
    
    # replaces specific punctuation with spaces to prevent words from merging (e.g., "word,word" -> "word word")
    pattern = r"[-_\(\)\.,،]"
    cleaned_text = re.sub(pattern, " ", text)
    
    # collapse any accidental double-spaces caused by the replacement
    cleaned_text = re.sub(r"\s+", " ", cleaned_text).strip()
    
    return cleaned_text

def process_node(node):
    """
    recursively walks through nested dicts and lists to clean all string keys and values
    """
    if isinstance(node, dict):
        new_dict = {}
        for key, value in node.items():
            new_key = replace_special_chars(key)
            new_dict[new_key] = process_node(value)
        return new_dict
    elif isinstance(node, list):
        return [process_node(item) for item in node]
    elif isinstance(node, str):
        return replace_special_chars(node)
    else:
        return node

def main():
    input_file = 'data.json'
    output_file = 'data_cleaned_chars.json'

    try:
        with open(input_file, 'r', encoding='utf-8') as f:
            data = json.load(f)
        
        processed_data = process_node(data)
        
        with open(output_file, 'w', encoding='utf-8') as f:
            json.dump(processed_data, f, ensure_ascii=False, indent=4)
        
        print(f"Success! Cleaned data saved to {output_file}")
        
    except FileNotFoundError:
        print(f"Error: {input_file} not found.")

if __name__ == "__main__":
    main()