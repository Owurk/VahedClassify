import json
import itertools

def get_word_permutations(word):
    # generates spelling variants for a single word
    if not isinstance(word, str) or not word.strip():
        return [word]

    # interchangeable persian/arabic characters
    char_map = {
        'ا': ['ا', 'آ'],
        'آ': ['ا', 'آ'],
        'ی': ['ی', 'ي'],
        'ي': ['ی', 'ي'],
        'ک': ['ک', 'ك'],
        'ك': ['ک', 'ك'],
        'ه': ['ه', 'ة'],
        'ة': ['ه', 'ة']
    }

    target_indices = [i for i, char in enumerate(word) if char in char_map]
    
    # limit to 5 chars to prevent combinatorial explosion
    target_indices = target_indices[:5]

    options = []
    for i in range(len(word)):
        if i in target_indices:
            options.append(char_map[word[i]])
        else:
            options.append([word[i]])

    # cartesian product of all character options
    all_combinations = list(itertools.product(*options))
    
    results = {"".join(combo) for combo in all_combinations}
    
    # handle 2-character edge cases like یی and ئی
    final_variants = set()
    for v in results:
        final_variants.add(v)
        if "یی" in v:
            final_variants.add(v.replace("یی", "ئی"))
        if "ئی" in v:
            final_variants.add(v.replace("ئی", "یی"))
            
    return list(final_variants)

def expand_key(text):
    # splits text into words and expands variants for each
    if not isinstance(text, str) or not text.strip():
        return text
    
    words = text.split()
    all_expanded_words = []
    
    for w in words:
        variants = get_word_permutations(w)
        all_expanded_words.extend(variants)
    
    # deduplicate while preserving order
    seen = set()
    unique_results = []
    for w in all_expanded_words:
        if w not in seen:
            unique_results.append(w)
            seen.add(w)
            
    return " ".join(unique_results)

def process_data(data):
    if isinstance(data, dict):
        new_dict = {}
        for key, value in data.items():
            if key in ["نظرات", "positive", "negative"]:
                new_dict[key] = value
            else:
                new_key = expand_key(key)
                new_dict[new_key] = process_data(value)
        return new_dict
    elif isinstance(data, list):
        return [process_data(item) for item in data]
    else:
        return data

try:
    with open('data_synced.json', 'r', encoding='utf-8') as f:
        json_data = json.load(f)

    final_data = process_data(json_data)

    with open('data_final.json', 'w', encoding='utf-8') as f:
        json.dump(final_data, f, ensure_ascii=False, indent=2)
    
    print("Success! 'آنا' and other variants are now correctly generated.")

except Exception as e:
    print(f"Error: {e}")