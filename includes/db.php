<?php 

        //host
        define("HOST","localhost");
        //Dbname
        define("DB_NAME","technoebra");
        //user 
        define("USER","root");
        //pass  
        define("PASS","");

        try{
        $conn = new PDO("mysql:host=".HOST.";dbname=".DB_NAME."",USER,PASS);

        }
        catch(PDOException $e){
            echo "Error: ".$e->getMessage() ;
        }


        ?>