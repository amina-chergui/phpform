<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your JSON file path
    $data_file_location = 'admin/data/data.json';
 
    // Read existing data from the JSON file
    $existingData = json_decode(file_get_contents($data_file_location), true);

    // Check if the existingData is an array
    if (!is_array($existingData)) {
        $existingData = array();
    }

    // Your additional data
    $newData = $_POST; 
    
    // Update the "wasel" value
    $wasel = count($existingData) + 300;
    $newData["wasel"] = strval($wasel);

    // Append the new data to the existing data
    $existingData[] = $newData;

    // Encode the updated array back to JSON
    $newJsonString = json_encode($existingData, JSON_PRETTY_PRINT);

    // Write the updated JSON data back to the file
    file_put_contents($data_file_location, $newJsonString);

    // Respond with a success message or any necessary information
    echo 'Data added successfully to the JSON file.';

    // Return a response (optional)
    echo "Data received and saved successfully!";
} else {
    // Handle invalid request method
    echo "Invalid request method!";
}
?>
