<?php 
    require_once "config.php";
    require_once "Database.php";
    require_once "Post.php";
    $db = new Database();
    $pdo = $db->getConnection();
    $postModel = new Post($pdo);
    $success = false;
    $error;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
            $error = "";
            // Testing
            // Pizza Info
            // Checks if pizzaSize isset if it is not then it concats to error message. This is done for all radios.
            if(isset($_POST['pizzaSize'])){
                $pizzaSize = $_POST['pizzaSize'];
            } else{
                $error = $error. "<p>Please Select a size.</p>";
            }
            // Ensure crust is set
            if(isset($_POST['crust'])){
                $crust = $_POST['crust'];
            } else{
                $error = $error. "<p>Please Select a crust.</p>";
            }
            // Ensure sauce is set
            if(isset($_POST['sauce'])){
                $sauce = $_POST['sauce'];
            } else{
                $error = $error. "<p>Please Select a sauce.</p>";
            }
            $toppingsArray = $_POST["toppings"] ?? [];
            $toppings = implode(",", $toppingsArray);
            $firstName = trim($_POST["firstName"] ?? "");
            // Validate First Name
            if(strlen($firstName) <= 0){
                $error = $error."<p>Please Enter your First name.</p>";
            }
            if(strlen($firstName) >= 20){
                $error = $error."<p>First name must be 20 chars or less.</p>";
            }
            $lastName  = trim($_POST["lastName"] ?? "");
            // Validate Last Name
            if(strlen($lastName) <= 0){
                $error = $error."<p>Please Enter your Last name.</p>";
            }
            if(strlen($lastName) >= 20){
                $error = $error."<p>Last name must be 20 chars or less.</p>";
            }
            $phoneNumber = trim($_POST["phoneNumber"]);
            // Validate phone number
            if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $phoneNumber)) {
                $error = $error. "<p>Phone number must be in the format xxx-xxx-xxxx.</p>";
            }
            $email = trim($_POST["email"] ?? "");
            // Validate Email
            if (!preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,}$/", $email)) {
                $error = $error. "<p>Invalid email format.</p>";
            }
            if (strlen($email) >= 80){
                $error = $error. "<p>Email must be 80 characters or less.</p>";
            }
            $addr = trim($_POST["addr"]);
            // Validate Address
            if(strlen($addr) <= 0 ){
                $error = $error. "<p>Please enter an address.</p>";
            }

            $deliveryInstructions = trim($_POST["deliveryInstructions"] ?? "");
            // Validate Deilvery Instructions
            if (strlen($deliveryInstructions) >100){
                $error = $error . "<p>Delivery Instructions can only contain 100 characters max.</p>";
            }
            // Delivery type will always be set so we do not validate (I know postman can be used to send a bad value here but for the scope of this project I am not going to validate this input)
            $deliveryType = $_POST['deliveryType'];
            if(strlen($error) > 0){
                // Do nothing because we do not have valid inputs
                // This will make sure we do not post and instead show a validation error to the client
            } else {
                // Create Assoc array to use for create function
            $formattedArray = array(
                ":pizzaSize" => $pizzaSize,
                ":crust" => $crust,
                ":sauce" => $sauce,
                ":toppings" => $toppings,
                ":firstName" => $firstName,
                ":lastName" => $lastName,
                ":phoneNumber" => $phoneNumber,
                ":email" => $email,
                ":addr" => $addr,
                ":deliveryType" => $deliveryType,
                ":deliveryInstructions" => $deliveryInstructions,
            );
            // Create using our formattedArray
            $postModel->create($formattedArray);
            // Set $_POST to an empty array so the form is not repopulated
            $_POST = [];
            $success = true;
        }
    }
    // Load Templates
    include "templates/header.php";
    include "form.php";
    include "templates/footer.php";
?>