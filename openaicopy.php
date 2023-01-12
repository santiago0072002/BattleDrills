

<form action="openaicopy.php" method="post">
    <label for="user_input">Enter your message:</label>
    <input type="text" id="user_input" name="user_input">
    <input type="submit" value="Submit">
</form>

<?php



// Replace YOUR_API_KEY with your actual API key
define('API_KEY', 'YOUR_API_KEY');

// Handle user input
if (isset($_POST['user_input'])) {
    $user_input = $_POST['user_input'];

    // Prepare the data to send to the API
    $data = array(
        'prompt' => $user_input,
        'model' => 'text-davinci-002',
    );

    // Create the context for the request
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => json_encode($data),
            'timeout' => 60
        ),
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false
        )
    );
    $context = stream_context_create($options);

    // Send the request to the API
    $url = 'https://api.openai.com/v1/engines/davinci/completions';
    $response = file_get_contents($url, false, $context);

    // Handle the response
    if ($response) {
        $response_data = json_decode($response, true);
        $generated_text = $response_data['choices'][0]['text'];
        echo $generated_text;
    } else {
        echo 'Error: Failed to receive a response from the API.';
    }
}
// This script demonstrates how to handle user input, send a request to the OpenAI API with the user's input as the prompt, and handle the response from the API.

// You will need to replace YOUR_API_KEY with your actual API key and make sure that your server can send HTTP requests and has the ability to use the file_get_contents() function.

// This script is just an example and you would need to add more elements like the HTML form to get the user input and some JavaScript to handle the interaction between the form and the script.

// I hope this helps! Let me know if you have any other questions.
?>