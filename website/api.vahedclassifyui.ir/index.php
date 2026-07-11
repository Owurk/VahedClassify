<?php
declare(strict_types=1);

// ══════════════════════════════════════════════════════════════════
//  get-comments.php
//  Direct PHP port of the FastAPI app.py – logic is 1-to-1 with Python
// ══════════════════════════════════════════════════════════════════

// ── Helpers ──────────────────────────────────────────────────────

/**
 * Exact equivalent of Python's str.split() (no args):
 *  - trims leading/trailing whitespace
 *  - splits on ANY whitespace sequence
 *  - returns empty array for blank/empty strings
 */
function py_split(string $str): array
{
    $str = trim($str);
    if ($str === '') {
        return [];
    }
    return preg_split('/\s+/u', $str);
}

/** Send a UTF-8 JSON response and stop execution. */
function sendJson(array $data, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// ── Load data ────────────────────────────────────────────────────

$dataFile = __DIR__ . '/data_no_zwnj.json';
$universityData = [];

if (!file_exists($dataFile)) {
    // Don't crash – behave like Python's except FileNotFoundError: university_data = {}
    // but expose it via ?debug=1 below
    $loadError = 'data_no_zwnj.json not found in ' . __DIR__;
} else {
    $raw = file_get_contents($dataFile);
    $decoded = json_decode($raw, true);
    if ($decoded === null) {
        $loadError = 'JSON decode failed: ' . json_last_error_msg();
    } else {
        $universityData = $decoded;
        $loadError = null;
    }
}

// ── Debug endpoint (?debug=1) ────────────────────────────────────
// Visit: get-comments.php?debug=1
// Shows load status and top-level structure so you can verify the file loaded correctly.

if (isset($_GET['debug'])) {
    sendJson([
        'json_loaded'     => ($loadError === null),
        'error'           => $loadError,
        'faculty_count'   => count($universityData),
        'faculties'       => array_keys($universityData),
        'data_file_path'  => $dataFile,
        'php_version'     => PHP_VERSION,
    ]);
}

// ── Digit sets (same as Python) ───────────────────────────────────

$ONE_DIGITS = ['1', '۱', '١'];

$OTHER_DIGITS = [
    '2', '۲', '٢',
    '3', '۳', '٣',
    '4', '۴', '٤',
    '5', '۵', '٥',
    '6', '۶', '٦',
    '7', '۷', '٧',
    '8', '۸', '٨',
    '9', '۹', '٩',
];

$ALL_DIGITS = array_merge($ONE_DIGITS, $OTHER_DIGITS);

// ── Require GET parameters ────────────────────────────────────────

if (!isset($_GET['prof_name']) || !isset($_GET['course_name'])) {
    sendJson(['detail' => 'پارامترهای prof_name و course_name الزامی هستند'], 422);
}

$profName   = (string) $_GET['prof_name'];
$courseName = (string) $_GET['course_name'];

// ── Pre-process inputs (identical to Python) ──────────────────────

// prof_name.strip().split()
$inputProfWords = py_split($profName);

// course_name.strip().split()
$inputCourseRawWords = py_split($courseName);

// input_digits = [w for w in input_course_raw_words if w in ALL_DIGITS]
$inputDigits = array_values(
    array_filter($inputCourseRawWords, fn($w) => in_array($w, $ALL_DIGITS))
);

// input_text_only = [w for w in input_course_raw_words if w not in ALL_DIGITS]
$inputTextOnly = array_values(
    array_filter($inputCourseRawWords, fn($w) => !in_array($w, $ALL_DIGITS))
);

// is_looking_for_level_one = any(w in ONE_DIGITS for w in input_course_raw_words) or (len(input_digits) == 0)
$hasOneDigitInInput   = count(array_filter($inputCourseRawWords, fn($w) => in_array($w, $ONE_DIGITS))) > 0;
$isLookingForLevelOne = $hasOneDigitInInput || (count($inputDigits) === 0);

$numRequiredText = count($inputTextOnly);

// specific_digits_entered = [d for d in input_digits if d not in ONE_DIGITS]
// This is constant across all courses – compute once outside the loop
$specificDigits = array_values(
    array_filter($inputDigits, fn($d) => !in_array($d, $ONE_DIGITS))
);

// ── Main loop ────────────────────────────────────────────────────

$totalPositive = 0;
$totalNegative = 0;
$matchFound    = false;

foreach ($universityData as $faculty => $professors) {
    foreach ($professors as $profKey => $courses) {

        // stored_prof_parts = prof_key.split()
        $storedProfParts = py_split($profKey);

        // if all(word in stored_prof_parts for word in input_prof_words):
        $allProfMatch = true;
        foreach ($inputProfWords as $word) {
            if (!in_array($word, $storedProfParts)) {
                $allProfMatch = false;
                break;
            }
        }
        if (!$allProfMatch) {
            continue;
        }

        foreach ($courses as $courseKey => $courseDetails) {

            // stored_course_parts = course_key.split()
            $storedCourseParts = py_split($courseKey);

            // if specific_digits_entered:
            //     if not all(d in stored_course_parts for d in specific_digits_entered): continue
            if (!empty($specificDigits)) {
                foreach ($specificDigits as $d) {
                    if (!in_array($d, $storedCourseParts)) {
                        continue 2;   // skip this course, move to next $courseKey
                    }
                }
            }

            // common_text_words = [w for w in input_text_only if w in stored_course_parts]
            // num_text_matches = len(common_text_words)
            $numTextMatches = 0;
            foreach ($inputTextOnly as $w) {
                if (in_array($w, $storedCourseParts)) {
                    $numTextMatches++;
                }
            }

            // course_match logic (identical to Python)
            $courseMatch = false;
            if ($numRequiredText === 0) {
                $courseMatch = true;
            } elseif ($numRequiredText === 1) {
                $courseMatch = ($numTextMatches === 1);
            } elseif ($numRequiredText > 1) {
                $courseMatch = ($numTextMatches >= ($numRequiredText - 1));
            }

            if (!$courseMatch) {
                continue;
            }

            // Level-one filter
            if ($isLookingForLevelOne) {

                // db_has_one = any(d in stored_course_parts for d in ONE_DIGITS)
                // Python: `d in list` → exact element membership
                $dbHasOne = false;
                foreach ($ONE_DIGITS as $d) {
                    if (in_array($d, $storedCourseParts)) {
                        $dbHasOne = true;
                        break;
                    }
                }

                // db_has_others = any(any(d in word for d in OTHER_DIGITS) for word in stored_course_parts)
                // Python: `d in word` (string) → substring check  ← different from db_has_one!
                $dbHasOthers = false;
                foreach ($storedCourseParts as $word) {
                    foreach ($OTHER_DIGITS as $od) {
                        if (mb_strpos($word, $od) !== false) {
                            $dbHasOthers = true;
                            break 2;
                        }
                    }
                }

                // if db_has_others and not db_has_one: continue
                if ($dbHasOthers && !$dbHasOne) {
                    continue;
                }
            }

            // comments = course_details.get("نظرات", {})
            $comments = isset($courseDetails['نظرات']) ? (array) $courseDetails['نظرات'] : [];

            $totalPositive += (int) ($comments['positive'] ?? 0);
            $totalNegative += (int) ($comments['negative'] ?? 0);
            $matchFound     = true;
        }
    }
}

// ── Response ─────────────────────────────────────────────────────

if ($matchFound) {
    sendJson([
        'requested_professor' => $profName,
        'requested_course'    => $courseName,
        'results' => [
            'positive' => $totalPositive,
            'negative' => $totalNegative,
        ],
    ]);
}

sendJson(['detail' => 'موردی با این مشخصات یافت نشد'], 404);