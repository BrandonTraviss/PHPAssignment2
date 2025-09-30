<?php
    class Post{
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }
        public function create($formattedData){
            $sql = "INSERT INTO orders (
                pizzaSize,
                crust,
                sauce,
                cheese,
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
                :cheese,
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