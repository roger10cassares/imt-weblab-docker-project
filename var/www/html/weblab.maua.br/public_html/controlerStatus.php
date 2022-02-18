<?php

    $kp = 2;
    $td = 1;
    $ti = 1;
    $t = 10;


    if (isset($_GET["load"])) {

        $dsn = "pgsql:host=postgres;port=5432;dbname=imt_weblab_db";
        $user = "imt_weblab_user";
        $passwd = "Imt_w3bl4b_us3r#";

        $pdo = new PDO($dsn, $user, $passwd);

        $sql = "SELECT id, sensor_01 FROM logstatus ORDER BY id DESC ";
        $statement=$pdo->prepare($sql);
        $statement->execute();
        
        $all_ldr_values = $statement->fetchAll();

        $current_ldrValue = $all_ldr_values[0]['sensor_01'];  //Resistencia LDR
        $previous_ldrValue = $all_ldr_values[1]['sensor_01']; //Resistencia LDR
        
       

        // GRANDEZA D VDD
        $current_quantity = 500/$current_ldrValue;
        $previous_quantity = 500/$previous_ldrValue;

        $sql = "SELECT setpoint FROM logcondition";
        $statement=$pdo->prepare($sql);
        $statement->execute();

        $setpoint = $statement->fetch();

        $sum_error = 0;
        foreach ($all_ldr_values as $ldr_value) {
            $sum_error += (500/$ldr_value['sensor_01']) - $setpoint['setpoint'];
        }


        $current_error = $current_quantity - $setpoint['setpoint'];
        $previou_error = $previous_quantity - $setpoint['setpoint'];
        


        $pid_integral = round($sum_error, 3);
        $pid_proportinal = round($current_error, 3);
        $pid_diferential = round($current_error - $previou_error, 3);

        $response = $kp*($pid_proportinal + ($ti/$t)*$pid_integral + ($td/$t)*$pid_diferential);
               


        if($response > 255){

            $response = 255;
            $sql = "UPDATE logcondition SET pid_response =".$response;
            $statement=$pdo->prepare($sql);
            $statement->execute();
            
            echo $response;
        }
        else if($response < 0){

            $response = 0;
            $sql = "UPDATE logcondition SET pid_response =".$response;
            $statement=$pdo->prepare($sql);
            $statement->execute();

            echo $response;
        }else{

            $sql = "UPDATE logcondition SET pid_response =".$response;
            $statement=$pdo->prepare($sql);
            $statement->execute();

            echo $response;
        }
       
        
    }

    if(isset($_POST["lux"])){
        $dsn = "mysql:host=localhost;dbname=weblab";
        $user = "root";
        $passwd = "";

        $pdo = new PDO($dsn, $user, $passwd);

        $sql = "UPDATE logcondition SET setpoint =".$_POST["lux"];
        $statement=$pdo->prepare($sql);
        $statement->execute();
    }
?>
