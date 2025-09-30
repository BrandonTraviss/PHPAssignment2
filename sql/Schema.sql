CREATE TABLE orders (
	order_id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(20) NOT NULL,
	lastName VARCHAR(20) NOT NULL,
    email VARCHAR(80) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    addr VARCHAR(255) NOT NULL,
    pizzaSize VARCHAR(10) NOT NULL,
    sauce VARCHAR(20) NOT NULL,
	crust VARCHAR(20) NOT NULL,
	toppings VARCHAR(255),
    deliveryType VARCHAR(20) NOT NULL,
    deliveryInstructions VARCHAR(255),
	order_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);