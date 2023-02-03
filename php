<?php

// Function to validate an email address
function is_valid_email($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to extract email addresses from a URL
function extract_email_from_url($url) {
  // Download the page content
  $page_content = file_get_contents($url);

  // Use regular expression to extract email addresses
  preg_match_all("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/", $page_content, $matches);

  // Validate the extracted email addresses
  $valid_email_addresses = array();
  foreach ($matches[0] as $email) {
    if (is_valid_email($email)) {
      $valid_email_addresses[] = $email;
    }
  }

  // Return the valid email addresses
  return $valid_email_addresses;
}

// Function to save email addresses to a text file
function save_email_addresses_to_file($email_addresses, $file_path) {
  // Open the file for writing
  $file = fopen($file_path, "w");

  // Write each email address to the file, one per line
  foreach ($email_addresses as $email) {
    fwrite($file, "$email\n");
  }

  // Close the file
  fclose($file);
}

// Example usage
$url = "https://www.example.com/";
$email_addresses = extract_email_from_url($url);
$file_path = "emails.txt";
save_email_addresses_to_file($email_addresses, $file_path);

?>
