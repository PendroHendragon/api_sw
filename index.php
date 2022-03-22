<?php 


$method = $_SERVER['REQUEST_METHOD'];


if($method == 'GET'){
    if(isset($_GET['email'])){
        try{
            $con = new PDO("mysql:host=localhost;dbname=mydb",'root','');
            $stm = $con->prepare('select * from contatos where email = :email;');
            $stm->execute(array('email' => $_GET['email']));

            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result);
            
            exit;
        }catch(PDOExcepition $e){
            echo 'ERROR:'.$e->getMessage();

        }


    }
   if(isset($_GET['nome'])){
        try{
            $con = new PDO("mysql:host=localhost;dbname=mydb",'root','');
            $stm = $con->prepare('select * from contatos where match(nome,sobrenome) against (:nome);');
            $stm->execute(array('nome' => $_GET['nome']));

            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result);
            
            exit;
        }catch(PDOExcepition $e){
            echo 'ERROR:'.$e->getMessage();

        }
        
   }
   try{
        $con = new PDO("mysql:host=localhost;dbname=mydb",'root','');
        $stm = $con->prepare('Select * from contatos');
        $stm->execute();

        $result = $stm->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($result);
        exit;
   }catch(PDOExcepition $e){
       echo 'ERROR:'.$e->getMessage();

   }
  
}
if($method == "DELETE"){
    echo $_GET['nome'];

}
if($method == 'POST'){

}
if($method == "PUT"){

}

?>