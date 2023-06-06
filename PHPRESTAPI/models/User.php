<?php
    class User {
        private $conn;
        private $table = 'feedback';

        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $location;
        public $comments;
        public $rating;

        public $updatedAt;


        public function __construct($db) {
            $this->conn = $db;
        }


        public function read(){
            $query = 'SELECT 
                    p.firstName,
                    p.lastName,
                    p.email,
                    p.location,
                    p.comments,
                    p.rating,
                    p.id
                FROM 
                    ' .$this->table .' p
                ORDER BY
                    p.id DESC';
            

            $stmt = $this->conn->prepare($query);
            

            $stmt->execute(); 

            return $stmt;
        }

        public function read_single() {
            $query = 'SELECT 
                p.firstName,
                p.lastName,
                p.email,
                p.location,
                p.comments,
                p.rating,
                p.id
            FROM 
                ' .$this->table .' p
            WHERE
                p.id = ?
            LIMIT 0,1';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->email = $row['email'];
            $this->location = $row['location'];
            $this->comments = $row['comments'];
            $this->rating = $row['rating'];
            $this->id = $row['id'];
            
        }

        public function create() {
            $query = 'INSERT INTO ' .$this->table . '
              SET
                 firstName = :firstName,
                 lastName = :lastName,
                 email = :email,
                 location = :location,
                 comments = :comments,
                 rating = :rating';
            
            $stmt = $this->conn->prepare($query);

            $this->firstName = htmlspecialchars(strip_tags($this->firstName));
            $this->lastName = htmlspecialchars(strip_tags($this->lastName));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->location = htmlspecialchars(strip_tags($this->location));
            $this->comments = htmlspecialchars(strip_tags($this->comments));
            $this->rating = htmlspecialchars(strip_tags($this->rating));


            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':comments', $this->comments);
            $stmt->bindParam(':rating', $this->rating);


            if($stmt->execute()) {
                return true;
            } 

            printf("Error: %s. \n", $stmt->Error);
            return false;
             
        }



        public function update() {
            $query = 'UPDATE ' .$this->table . '
              SET
                 firstName = :firstName,
                 lastName = :lastName,
                 email = :email,
                 location = :location,
                 comments = :comments,
                 rating = :rating,
                 updatedAt = :updatedAt
                WHERE
                 id = :id';
            
            $stmt = $this->conn->prepare($query);

            $this->firstName = htmlspecialchars(strip_tags($this->firstName));
            $this->lastName = htmlspecialchars(strip_tags($this->lastName));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->location = htmlspecialchars(strip_tags($this->location));
            $this->comments = htmlspecialchars(strip_tags($this->comments));
            $this->rating = htmlspecialchars(strip_tags($this->rating));
            $this->id = htmlspecialchars(strip_tags($this->id));


            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':comments', $this->comments);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':updatedAt', $this->updatedAt);
            


            if($stmt->execute()) {
                return true;
            } 

            printf("Error: %s. \n", $stmt->Error);
            return false;
             
        }



        public function delete(){
            $query = 'DELETE FROM '. $this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            } 

            printf("Error: %s. \n", $stmt->Error);
            return false;
        }
    }