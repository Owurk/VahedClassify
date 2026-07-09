from fastapi import FastAPI, HTTPException
import json

app = FastAPI()

try:
    with open('data_no_zwnj.json', 'r', encoding='utf-8') as f:
        university_data = json.load(f)
except FileNotFoundError:
    university_data = {}

# separate course levels into intro (1) and advanced (2+) to handle persian/english digit variants
ONE_DIGITS = {"1", "۱", "١"}
OTHER_DIGITS = {
    "2", "۲", "٢", "3", "۳", "٣", "4", "۴", "٤", 
    "5", "۵", "٥", "6", "۶", "٦", "7", "۷", "٧", 
    "8", "۸", "٨", "9", "۹", "٩"
}
ALL_DIGITS = ONE_DIGITS.union(OTHER_DIGITS)

@app.get("/get-comments")
def get_comments(prof_name: str, course_name: str):
    total_positive = 0
    total_negative = 0
    match_found = False

    input_prof_words = prof_name.strip().split()
    input_course_raw_words = course_name.strip().split()
    
    input_digits = [w for w in input_course_raw_words if w in ALL_DIGITS]
    input_text_only = [w for w in input_course_raw_words if w not in ALL_DIGITS]

    is_looking_for_level_one = any(w in ONE_DIGITS for w in input_course_raw_words) or (len(input_digits) == 0)
    
    num_required_text = len(input_text_only)

    for faculty, professors in university_data.items():
        for prof_key, courses in professors.items():
            stored_prof_parts = prof_key.split()

            if all(word in stored_prof_parts for word in input_prof_words):
                
                for course_key, course_details in courses.items():
                    stored_course_parts = course_key.split()

                    specific_digits_entered = [d for d in input_digits if d not in ONE_DIGITS]
                    if specific_digits_entered:
                        if not all(d in stored_course_parts for d in specific_digits_entered):
                            continue

                    common_text_words = [w for w in input_text_only if w in stored_course_parts]
                    num_text_matches = len(common_text_words)

                    # fuzzy matching: requires exact match for single words, allows 1 missing word for longer queries
                    course_match = False
                    if num_required_text == 0:
                        course_match = True
                    elif num_required_text == 1:
                        if num_text_matches == 1:
                            course_match = True
                    elif num_required_text > 1:
                        if num_text_matches >= (num_required_text - 1):
                            course_match = True
                    
                    if course_match:
                        # if user wants intro courses, skip any course that explicitly has advanced levels (2+) but lacks '1'
                        if is_looking_for_level_one:
                            db_has_one = any(d in stored_course_parts for d in ONE_DIGITS)
                            db_has_others = any(any(d in word for d in OTHER_DIGITS) for word in stored_course_parts)

                            if db_has_others and not db_has_one:
                                continue

                        comments = course_details.get("نظرات", {})
                        total_positive += comments.get("positive", 0)
                        total_negative += comments.get("negative", 0)
                        match_found = True

    if match_found:
        return {
            "requested_professor": prof_name,
            "requested_course": course_name,
            "accumulated_results": {
                "positive": total_positive,
                "negative": total_negative
            }
        }
    
    raise HTTPException(status_code=404, detail="موردی با این مشخصات یافت نشد")

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000)