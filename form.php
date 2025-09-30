<?php
// I originally had everything typed out over and over... then I decided to apply loops and arrays to remove repetition.
// To add more size options just add them to the array.
// I spent more time on this assignment than required but this is also my favorite class this semester.
// Emojis copied from https://emojipedia.org/
$sizeOptions = [
    "Small",
    "Medium",
    "Large",
    "X-Large",
];
// To add more crust options just add them to the array
$crustOptions = [
    "Stuffed",
    "Thick",
    "Thin",
];
// To add more sauce options just add them to the array
$sauceOptions = [
    "Pesto",
    "Marinara",
    "BBQ",
    "Original",
    "None"
];
// To add more cheese options just add them to the array
$cheeseOptions = [
    "Normal Cheese",
    "Extra Cheese",
    "No Cheese",
];
// To add more toppings just add them to the array here
$toppingOptions = [
    "Mushrooms 🍄‍🟫",
    "Green Peppers 🫑",
    "Roasted Red Peppers 🌶️",
    "Pineapples 🍍",
    "Spinach 🥬",
    "Brocolli 🥦",
    "Green Olives 🫒",
    "Onions 🧅",
    "Ground Beef 🥩",
    "Pepperoni 🔴",
    "Bacon 🥓",
    "Chicken 🍗",
];
?>

<main>
    <div>
        <?php if ($success): ?>
            <div class="message success">
                <p>Your order has been submitted 😄</p>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="message error">
                <p>** Unable to place Order **</p>
                <?php echo "$error"; ?>
                <?php htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
    </div>
    <form method="POST">
        <div class="form-head main-head">
            <h2>Create Your Perfect Pizza</h2>
            <p class="gray">Customzie your pizza with fresh ingredients and authentic flavours.</p>
        </div>
        <div class="form-head">
            <h3>Choose Size 🍕</h3>
        </div>
        <!-- Render Size options -->
        <div class="card-group-size">
            <?php foreach($sizeOptions as $size):?>
                <!-- Compares $_POST to $size, if $_POST does not exist it uses '' to compare to $size. If true echo 'checked' if false echo '' this is used to preserve data incase of bad form submission -->
                    <input type="radio"
                    id="<?php echo "$size" ?>"
                    name="pizzaSize" value="<?php echo "$size" ?>" 
                    <?php echo (($_POST['pizzaSize'] ?? '') === $size) ? 'checked' : ''; ?>>
                <label for="<?php echo "$size" ?>" class="card">
                    <?php echo "$size" ?>
                </label>
            <?php endforeach; ?>
        </div>
        <div class="form-head">
            <h3>Crust Type 🫓</h3>
        </div>
        <!-- Render Crust options -->
        <div class="card-group-crust">
            <?php foreach ($crustOptions as $crust): ?>
                <input type="radio"
                    id="<?php echo htmlspecialchars($crust) ?>"
                    name="crust"
                    value="<?php echo htmlspecialchars($crust) ?>"
                    <?php echo (($_POST['crust'] ?? '') === $crust) ? 'checked' : ''; ?>>
                <label for="<?php echo htmlspecialchars($crust) ?>" class="card">
                    <?php echo htmlspecialchars($crust) ?> crust
                </label>
            <?php endforeach; ?>
        </div>
        <div class="form-head">
            <h3>Select Sauce 🍅🔥🧄🌿</h3>
        </div>
        <!-- Render Sauce options -->
        <div class="card-group-size">
            <?php foreach($sauceOptions as $sauce):?>
                <input type="radio"
                id="<?php echo "$sauce"?>"
                name="sauce" value="<?php echo "$sauce"?>"
                <?php echo (($_POST['sauce'] ?? '') === $sauce) ? 'checked' : ''; ?>>
                <label for="<?php echo "$sauce"?>" class="card">
                    <?php echo "$sauce"?>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form-head">
            <h3>Cheese Options 🧀</h3>
        </div>
        <!-- Render Crust options -->
        <div class="card-group-crust">
            <?php foreach ($cheeseOptions as $cheese): ?>
                <input type="radio"
                    id="<?php echo htmlspecialchars($cheese) ?>"
                    name="cheese"
                    value="<?php echo htmlspecialchars($cheese) ?>"
                    <?php echo (($_POST['cheese'] ?? '') === $cheese) ? 'checked' : ''; ?>>
                <label for="<?php echo htmlspecialchars($cheese) ?>" class="card">
                    <?php echo htmlspecialchars($cheese) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="form-head">
            <h3>Select Toppings 🍄‍🟫🫑🌶️🥦🥩</h3>
        </div>
        <div class="topping-container">
            <!-- Create Toppings from Array because aint no body got time to type this out over and over again -->
            <?php foreach ($toppingOptions as $topping): ?>
                <label class="topping">
                    <!-- Checks to see if value appears in toppings array to determine if it should be checked or not this allows the form to keep data on errors -->
                    <input type="checkbox" name="toppings[]" value="<?php echo htmlspecialchars($topping); ?>"
                        <?php echo (isset($_POST['toppings']) && in_array($topping, $_POST['toppings'])) ? 'checked' : ''; ?>>
                    <?php echo htmlspecialchars($topping); ?>
                </label>
            <?php endforeach; ?>
        </div>
        <div class="form-head">
            <h3>Your Information</h3>
        </div>
        <div class="your-information">
            <div class="names-container">
                <div class="input-container">
                    <label for="firstName">First name</label>
                    <!-- The value is = to $_POST['firstName'] or '' this is done for every single input to retain information -->
                    <input type="text" name="firstName" id="firstName" placeholder="First name" value="<?php echo htmlspecialchars($_POST['firstName'] ?? ''); ?>">
                </div>
                <div class="input-container">
                    <label for="lastName">Last name</label>
                    <!-- Retains information from $_POST if set when order has invalid input -->
                    <input type="text" name="lastName" id="lastName" placeholder="Last name" value="<?php echo htmlspecialchars($_POST['lastName'] ?? ''); ?>">
                </div>
            </div>

            <div class="row gap contact-container">
                <div class="input-container">
                    <label for="lastName">Phone Number</label>
                    <!-- Retains information from $_POST if set when order has invalid input -->
                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="xxx-xxx-xxxx" value="<?php echo htmlspecialchars($_POST['phoneNumber'] ?? ''); ?>">
                </div>
                <div>
                    <div class="input-container">
                        <label for="lastName">Email</label>
                    <!-- Retains information from $_POST if set when order has invalid input -->
                        <input type="text" name="email" id="email" placeholder="Example@hotmail.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="input-container address-form">
                    <label for="addr">Address</label>
                    <!-- Retains information from $_POST if set when order has invalid input -->
                    <input type="text" name="addr" id="addr" placeholder="123 Delivery Lane" value="<?php echo htmlspecialchars($_POST['addr'] ?? ''); ?>">
                </div>
            </div>
            <div class="delivery-method">
                <label for="myDropdown">Delivery method:</label>
                <select id="myDropdown" name="deliveryType">
                    <!-- Retains information from $_POST if set when order has invalid input -->
                    <option value="Delivery" <?php echo (($_POST['deliveryType'] ?? '') === 'Delivery') ? 'selected' : ''; ?>>Delivery</option>
                    <option value="Pick Up" <?php echo (($_POST['deliveryType'] ?? '') === 'Pick Up') ? 'selected' : ''; ?>>Pick up</option>
                </select>
            </div>
            <div class="col delivery">
                <h3>Delivery Instructions</h3>
                    <!-- Retains information from $_POST if set when order has invalid input -->
                <textarea name="deliveryInstructions"><?php echo htmlspecialchars($_POST['deliveryInstructions'] ?? '');?></textarea>
            </div>
        </div>
        <button type="submit" class="btn">Place Order</button>
    </form>
</main>