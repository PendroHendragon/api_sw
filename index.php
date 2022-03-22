<?php 


$method = $_SERVER['REQUEST_METHOD'];


if($method == 'GET'){
    $con = new PDO("mysql:host=localhost;dbname=mydb",'root','');


    if(isset($_GET['email'])){
        try{
            $stm = $con->prepare('select * from contatos where email = :email;');
            $stm->execute(array('email' => $_GET['email']));

            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result);
            
            exit;
        }catch(PDOExcepition $e){
            echo 'ERROR:'.$e->getMessage();

        }


    }
    if(isset($_GET['nasc'])){
        try{
            $stm = $con->prepare('select * from contatos where dataNascimento = :datanasc;');
            $stm->execute(array('datanasc' => $_GET['nasc']));

            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result);
            
            exit;
        }catch(PDOExcepition $e){
            echo 'ERROR:'.$e->getMessage();

        }


    }
    if(isset($_GET['empresa'])){
        try{
            $stm = $con->prepare('select * from empresa');
            $stm->execute();

            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result);
            
            exit;
        }catch(PDOExcepition $e){
            echo 'ERROR:'.$e->getMessage();

        }
    }
   if(isset($_GET['nome'])){
        try{
            $stm = $con->prepare('select * from (contatos inner join empresa on contatos.Empresa_idEmpresa = empresa.idEmpresa,empresa where match(nome,sobrenome) against (:nome);');
            $stm->execute(array('nome' => $_GET['nome']));

            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result);
            
            exit;
        }catch(PDOExcepition $e){
            echo 'ERROR:'.$e->getMessage();

        }
        
   }
   try{
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