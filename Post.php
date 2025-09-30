<?php
    // this will handle our CRUD functions (Create for this lesson)
    class Post{
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }
        // save our new post
        public function create($formattedData){
            $sql = "INSERT INTO orders (
                pizzaSize,
                crust,
                sauce,
                toppings,
                firstName,
                lastName,
                phoneNumber,
                email,
                addr,
                deliveryType,
                deliveryInstructions
            ) VALUES (
                :pizzaSize,
                :crust,
                :sauce,
                :toppings,
                :firstName,
                :lastName,
                :phoneNumber,
                :email,
                :addr,
                :deliveryType,
                :deliveryInstructions
            )";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($formattedData);
        }
    }
?>