<?php

class Database
{
    private $conn;

    public function __construct()
    {
        $this->Connection();
    }

    public function Connection()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=phpnews', 'root', '');
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
    }

    public function Insert($tableName, $data = [])
    {

        try {
            $columns = implode(',', array_keys($data));
            $questionMark = "";
            $increment = 1;
            for ($x = 0; $x < count($data); $x++) {
                $questionMark .= "?";
                if ($increment < count($data)) {
                    $questionMark .= ",";
                }
                $increment++;
            }
            $sql = "INSERT INTO $tableName($columns)VALUES($questionMark)";
            $prepareStatement = $this->conn->prepare($sql);
            if ($prepareStatement) {
                $prepareStatement->execute(array_values($data));
                return $this->conn->lastInsertId();
            }
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }


    public function Update(){

    }

    public function Delete(){

    }


    public function Select($tableName){
        if(empty($tableName)){
            return "Table name is required";
        }

        $sql="SELECT * FROM $tableName";
        $prepareStatement = $this->conn->prepare($sql);
        $prepareStatement->execute();
        return $prepareStatement->fetchAll(PDO::FETCH_CLASS);

    }

    
    public function getByCriteria(){

    }


}
$obj = new Database();



if(!empty($_POST)){

    $obj->Insert('students', $_POST);
}

print_r($obj->Select('users'));

?>

<form action="" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="number" name="phone" placeholder="Phone">
    <input type="submit" value="Submit">
</form>
