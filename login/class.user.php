<?php
class USER
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function insert($table,$fields,$values) {

        $db = $this->db; // CONNECT

        //build the fields
        $buildFields = '';
        if (is_array($fields)) {
            //loop through all the fields
            foreach($fields as $key => $field) {
                if ($key == 0) {
                    //first item
                    $buildFields .= $field;
                } else {
                    //every other item follows with a ","
                    $buildFields .= ', '.$field;
                }   
            }
        } else {
            //we are only inserting one field
            $buildFields .= $fields;
        }

        //build the values
        $buildValues = '';
        if (is_array($values)) {
            //loop through all the fields
            foreach($values as $key => $value) {
                if ($key == 0) {
                    //first item
                    $buildValues .= '?';
                } else {
                    //every other item follows with a ","
                    $buildValues .= ', ?';
                }   
            }
        } else {
        //we are only inserting one field
            $buildValues .= ':value';
        }

        $prepareInsert = $db->prepare('INSERT INTO '.$table.'('.$buildFields.') VALUES ('.$buildValues.')');

        //execute the update for one or many values
        if (is_array($values)) {
            $prepareInsert->execute($values);
        } else {
            $prepareInsert->execute(array(':value' => $values));
        }
        //record and print any DB error that may be given
        $error = $prepareInsert->errorInfo();
        if ($error[1]) {
            print_r($error);
        } else {
            return true;
        }

    }

    

	public function getOneProduct($id){

	     $stmt = $this->db->prepare("SELECT * FROM `v_products_2` WHERE product_id = :product");
	
	     $stmt->bindParam(':product', $id,PDO::PARAM_INT);
	     $stmt->execute();
	
	     $results = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	     return $results;
	
	}
	
	public function getOneOrder($id){

	     $stmt = $this->db->prepare("SELECT * FROM `v_orders` WHERE order_id = :order");
	
	     $stmt->bindParam(':order', $id,PDO::PARAM_INT);
	     $stmt->execute();
	
	     $results = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	     return $results;
	
	}
	
	public function getOneCustomerOrder($id){

	     $stmt = $this->db->prepare("SELECT * FROM `v_customers_orders` WHERE order_id = :order");
	
	     $stmt->bindParam(':order', $id,PDO::PARAM_INT);
	     $stmt->execute();
	
	     $results = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	     return $results;
	
	}
	
	
	public function getAllTopBarItems(){

	     $stmt = $this->db->prepare("SELECT * FROM `v_top_bar_menu`");
	
	     $stmt->execute();
	
	     $results = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	     return $results;
	
	}
	
	public function editAllTopBarItems($id, $values, $link, $location, $published, $place)
	{
		try
		{

				$stmt = $this->db->prepare("UPDATE v_top_bar_menu SET value = ':value', :link, :location, published, :place WHERE menu_id = ':id'");
													  
				$stmt->bindparam(":value", $values);
				$stmt->bindparam(":link", $link);
				$stmt->bindparam(":location", $location);										  
				$stmt->bindparam(":published", $published);										  
				$stmt->bindparam(":place", $place);										  
				$stmt->bindparam(":id", $id);										  
					
				$stmt->execute();
						
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	

	public function getAllProducts($id){

	     $stmt = $this->db->prepare("SELECT * FROM `v_products_2` WHERE customer_id = :id");
	
	     $stmt->bindParam(':id', $id,PDO::PARAM_INT);
	     $stmt->execute();
	
	     $results = $stmt->fetchAll(PDO::FETCH_OBJ);
	
	     return $results;
	
	}


	public function register($fname,$lname,$uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->db->prepare("INSERT INTO v_admins(username,email,password, firstname, lastname) 
		                                               VALUES(:uname, :umail, :upass, :fname, :ulname)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
			$stmt->bindparam(":fname", $fname);										  
			$stmt->bindparam(":ulname", $lname);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function login($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->db->prepare("SELECT * FROM v_admins WHERE username=:uname LIMIT 1");
			$stmt->execute(array(':uname'=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{
				if(password_verify($upass, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['a_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>