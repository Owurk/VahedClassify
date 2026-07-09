import json
import re

def word_to_digit(text):
    if not isinstance(text, str):
        return text

    mapping = {
        "یک": "1",
        "دو": "2",
        "سه": "3",
        "چهار": "4"
    }

    for word, digit in mapping.items():
        # uses capture groups to match the word only when surrounded by spaces or string boundaries
        pattern = rf"(^|[\s]){word}([\s]|$)"
        
        # \g<1> is mandatory here instead of \1 to prevent python from interpreting it as \11 if the replacement digit is 1
        text = re.sub(pattern, rf"\g<1>{digit}\g<2>", text)
        
        # run twice to handle edge cases where words might be glued together
        text = re.sub(pattern, rf"\g<1>{digit}\g<2>", text)
    
    return text

def process_node(node):
    if isinstance(node, dict):
        new_dict = {}
        for key, value in node.items():
            new_key = word_to_digit(key)
            new_dict[new_key] = process_node(value)
        return new_dict
    elif isinstance(node, list):
        return [process_node(item) for item in node]
    elif isinstance(node, str):
        return word_to_digit(node)
    else:
        return node

def main():
    input_file = 'data_cleaned_chars.json' 
    output_file = 'data_words_converted.json'

    try:
        with open(input_file, 'r', encoding='utf-8') as f:
            data = json.load(f)
        
        processed_data = process_node(data)
        
        with open(output_file, 'w', encoding='utf-8') as f:
            json.dump(processed_data, f, ensure_ascii=False, indent=4)
        
        print(f"Success! Words converted to digits and saved to {output_file}")
        
    except FileNotFoundError:
        print(f"Error: {input_file} not found.")

if __name__ == "__main__":
    main()