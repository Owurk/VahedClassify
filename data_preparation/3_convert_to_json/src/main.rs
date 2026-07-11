use indexmap::IndexMap;
use serde::Serialize;
use std::fs;

#[derive(Default, Serialize)]
struct Review {
    #[serde(rename = "زمان")]
    timestamp: String,

    #[serde(rename = "اسم استاد")]
    teacher_name: String,

    #[serde(rename = "نام درس")]
    course_name: String,

    #[serde(rename = "نام دانشکده")]
    faculty_name: String,

    #[serde(rename = "منابع آموزش")]
    teaching_resources: String,

    #[serde(rename = "حضور و غیاب")]
    attendance: String,

    #[serde(rename = "منابع معرفی شده برای امتحان کافی است")]
    exam_resources_sufficient: String,

    #[serde(rename = "وضعیت نمره دادن")]
    grading: String,

    #[serde(rename = "ارزیابی دانشجو")]
    student_evaluation: IndexMap<String, u32>,

    #[serde(rename = "راه ارتباطی")]
    contact: String,

    #[serde(rename = "ترمی که دانشجو با این استاد کلاس داشته")]
    semester: String,

    #[serde(rename = "توضیحات")]
    description: String,
}

#[derive(Clone, Copy, PartialEq)]
enum Section {
    None,
    TeachingResources,
    Attendance,
    ExamResources,
    Grading,
    StudentEval,
    Contact,
    Semester,
    Description,
}

fn clean(s: &str) -> String {
    s.replace('#', "").replace('_', " ").trim().to_string()
}

fn fa_to_en_digits(s: &str) -> String {
    s.chars()
        .map(|c| {
            match c {
                '۰' | '٠' => '0',
                '۱' | '١' => '1',
                '۲' | '٢' => '2',
                '۳' | '٣' => '3',
                '۴' | '٤' => '4',
                '۵' | '٥' => '5',
                '۶' | '٦' => '6',
                '۷' | '٧' => '7',
                '۸' | '٨' => '8',
                '۹' | '٩' => '9',
                other => other,
            }
        })
        .collect()
}

fn strip_marker(line: &str) -> String {
    line.trim_start_matches(|c: char| { matches!(c, '┘' | '┤' | '├' | '│' | '─' | '-' | ' ') })
        .trim()
        .to_string()
}

fn is_decoration(line: &str) -> bool {
    !line.is_empty() &&
        line
            .chars()
            .all(|c| {
                matches!(
                    c,
                    '┌' |
                        '┐' |
                        '└' |
                        '┘' |
                        '├' |
                        '┤' |
                        '│' |
                        '─' |
                        '╮' |
                        '╯' |
                        '╰' |
                        '╭' |
                        '-' |
                        ' '
                )
            })
}

fn append(field: &mut String, text: String) {
    if text.is_empty() {
        return;
    }
    if !field.is_empty() {
        field.push(' ');
    }
    field.push_str(&text);
}

fn parse_eval_line(line: &str) -> Option<(String, u32)> {
    let cleaned = line
        .trim_start_matches(|c: char| matches!(c, '┤' | '├' | '│' | '─' | ' '))
        .trim();
    let (q, val) = cleaned.rsplit_once(':')?;
    let score = fa_to_en_digits(val.trim()).parse::<u32>().ok()?;
    Some((q.trim().to_string(), score))
}

fn match_section_header(line: &str, r: &mut Review) -> Option<Section> {
    let headers: [(&str, Section); 8] = [
        ("منابع آموزش", Section::TeachingResources),
        ("حضور و غیاب", Section::Attendance),
        ("منابع معرفی شده برای امتحان کافی است", Section::ExamResources),
        ("وضعیت نمره دادن", Section::Grading),
        ("ارزیابی دانشجو", Section::StudentEval),
        ("راه ارتباطی", Section::Contact),
        ("ترمی که دانشجو با این استاد کلاس داشته", Section::Semester),
        ("توضیحات", Section::Description),
    ];

    for (header, sec) in headers {
        if line.starts_with(header) {
            let rest = line[header.len()..]
                .trim_start_matches(|c: char| matches!(c, ':' | '؟' | '?' | ' '))
                .trim()
                .to_string();

            if !rest.is_empty() && sec != Section::StudentEval {
                match sec {
                    Section::TeachingResources => append(&mut r.teaching_resources, rest),
                    Section::Attendance => append(&mut r.attendance, rest),
                    Section::ExamResources => append(&mut r.exam_resources_sufficient, rest),
                    Section::Grading => append(&mut r.grading, rest),
                    Section::Contact => append(&mut r.contact, rest),
                    Section::Semester => append(&mut r.semester, rest),
                    Section::Description => append(&mut r.description, rest),
                    _ => {}
                }
            }
            return Some(sec);
        }
    }
    None
}

fn parse_review(timestamp: &str, body: &str) -> Review {
    let mut r = Review::default();

    r.timestamp = timestamp.trim().to_string();

    let body = body.replace("\r\n", "\n");
    let mut section = Section::None;

    for raw_line in body.lines() {
        let line = raw_line.trim();
        if line.is_empty() || is_decoration(line) {
            continue;
        }

        if line.contains("@uiostad_bot") || line.contains("ربات معرفی") {
            continue;
        }

        if line.contains('🧑') {
            let v = line.replace('🧑', "").replace('🏫', "").replace('\u{200d}', "");
            r.teacher_name = clean(&v);
            section = Section::None;
            continue;
        }
        if line.contains('📒') {
            r.course_name = clean(&line.replace('📒', ""));
            section = Section::None;
            continue;
        }
        if line.contains('🏫') {
            r.faculty_name = clean(&line.replace('🏫', ""));
            section = Section::None;
            continue;
        }

        if let Some(next) = match_section_header(line, &mut r) {
            section = next;
            continue;
        }

        match section {
            Section::TeachingResources => append(&mut r.teaching_resources, strip_marker(line)),
            Section::Attendance => append(&mut r.attendance, strip_marker(line)),
            Section::ExamResources => {
                append(&mut r.exam_resources_sufficient, strip_marker(line));
            }
            Section::Grading => append(&mut r.grading, strip_marker(line)),
            Section::Contact => append(&mut r.contact, strip_marker(line)),
            Section::Semester => append(&mut r.semester, strip_marker(line)),
            Section::Description => append(&mut r.description, strip_marker(line)),
            Section::StudentEval => {
                if let Some((q, score)) = parse_eval_line(line) {
                    r.student_evaluation.insert(q, score);
                }
            }
            Section::None => {}
        }
    }

    r
}

fn main() {
    let input = fs::read_to_string("filtered.txt").expect("could not read export.txt");

    let mut reviews: Vec<Review> = Vec::new();

    for part in input.split("$-------------------$") {
        if !part.contains("@uiostad_bot") {
            continue;
        }

        let part = part.trim_start_matches('\n');
        let Some((timestamp, body)) = part.split_once('\n') else {
            continue;
        };

        reviews.push(parse_review(timestamp.trim(), body));
    }

    let json = serde_json::to_string_pretty(&reviews).expect("serialize failed");
    fs::write("reviews_fa.json", json).expect("could not write reviews.json");

    println!("Parsed {} reviews -> reviews.json", reviews.len());
}
