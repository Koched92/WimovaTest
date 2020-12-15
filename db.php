<?php
require_once "data.php";
//creationdb();connexionbd();creation_table();insertion_exemples(); //<=== à décommenter une fois !

class DB{
    private $host ;
    private $username;
    private $password;
    private $database;
    private $db;

    /**
     * DB constructor.
     * @param string $host
     * @param string $username
     * @param string $password
     * @param $database
     */
    public function __construct($host = null, $username= null, $password= null, $database= null)
    {
        if ($host != null){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        try{
            $this->db=new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password );

        }catch (PDOException $e){
            print_r($e);
        }
    }

    public function query($sql, $data=array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);

        return $req->fetchAll(PDO::FETCH_OBJ);
    }


}

$db = new DB('localhost', 'root', '', 'testwimova');

echo json_encode($db->query('SELECT id, first_name, last_name, email, image FROM users'));