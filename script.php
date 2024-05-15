<?php
function reformatDate($date, $from_format = 'Y-m-d', $to_format = 'd-m-Y')
{
	$date_obj = DateTime::createFromFormat($from_format, $date);
	return $date_obj->format($to_format);
}

// Generate link code here
function generateLink($date, $type)
{
	$date_obj = DateTime::createFromFormat('Y-m-d', $date);
	$year = $date_obj->format('Y');
	$month = $date_obj->format('m');

	switch ($type) {
		case '1': // Tenders
			return "public/Tenders/$year/$month";
		case '2': // Circulars
			return "public/Circulars/$year/$month";
		case '3': // Online RTI
			return "public/EmpCriculars/$year/$month";
		case '4': //Recruitment
			return "public/Recruitment/$year/$month";
		// Add more cases for other types if needed
	}
}

// Determine the correct JSON file based on the type
function getJsonFilePath($type)
{
	switch ($type) {
		case '1':
			return "uploads/json/tenders.json";
		case '2':
			return "uploads/json/circulars.json";
		case '3':
			return "uploads/json/empCriculars.json";
		case '4':
			return "uploads/json/recruitment.json";
		// Add more cases for other types if needed 
	}
}

if (isset($_POST['submit'])) {
	$type = $_POST['type']; // Assuming you have a name="type" attribute in your select element
	$jsonFilePath = getJsonFilePath($type);

	$new_message = array(
		"title" => $_POST['title'],
		"date" => reformatDate($_POST['date']), // Reformat the date
		"link" => generateLink($_POST['date'], $type), // Generate the link
		"file_name" => $_POST['f1']
	);

	if (filesize($jsonFilePath) == 0) {
		$data_to_save = array($new_message);
	} else {
		$old_records = json_decode(file_get_contents($jsonFilePath), true);
		array_unshift($old_records, $new_message); // Prepend new message to the beginning
		$data_to_save = $old_records;
	}

	// Use JSON_UNESCAPED_SLASHES to prevent escaping slashes
	if (!file_put_contents($jsonFilePath, json_encode($data_to_save, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), LOCK_EX)) {
		$error = "Error storing message, please try again";
	} else {
		$success = "Message is stored successfully";
	}
}
?>