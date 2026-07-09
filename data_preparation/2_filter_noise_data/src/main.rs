use std::fs;
use indicatif::{ ProgressBar, ProgressStyle };

fn main() {
    let raw = fs::read_to_string("export.txt").expect("could not read export.txt");
    println!("Reading file...");

    println!("Splitting by \"--- [\" ...");
    let parts: Vec<&str> = raw.split("--- [").collect();
    let bar = ProgressBar::new(parts.len() as u64);
    bar.set_style(
        ProgressStyle::with_template(
            "{spinner:.dim.bold} {msg} [{elapsed}] {bar:40.green.dim/black.bold} {pos}/{len} ({percent}%)"
        )
            .unwrap()
            .progress_chars("█▇▆▅▄▃▂▁  _")
            .tick_chars("/|\\- ")
    );
    bar.set_message("Filtering");
    bar.enable_steady_tick(std::time::Duration::from_millis(100));

    let mut output = String::new();
    let mut count = 0;

    for part in parts {
        bar.inc(1);
        if !part.contains("@uiostad_bot") {
            continue;
        }

        let Some((header, body)) = part.split_once('\n') else {
            // no newline, malformed, skip
            continue;
        };

        let timestamp = match header.split_once("] ") {
            Some((_, rest)) => rest.trim_end_matches(" ---"),
            None => header, // fallback if the shape is unexpected
        };

        output.push_str(&format!("$-------------------$\n{}\n", timestamp));
        output.push_str(body.trim());
        output.push_str("\n\n");

        count += 1;
    }
    bar.finish();
    println!("Saving result ...");
    fs::write("filtered.txt", output).expect("could not write filtered.txt");

    println!("Done. Kept {count} reviews -> filtered.txt");
}
