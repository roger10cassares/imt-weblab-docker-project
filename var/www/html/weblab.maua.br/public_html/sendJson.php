<?php
    //Creates new record as per request
    //Connect to database
    $dsn = "pgsql:host=postgres;port=5432;dbname=imt_weblab_db";
    $user = "imt_weblab_user";
    $passwd = "Imt_w3bl4b_us3r#";

    $pdo = new PDO($dsn, $user, $passwd);


    //Get current date and time

    $string = trim(preg_replace('/\s+/', '', file_get_contents('php://input')));

    $data = json_decode(file_get_contents('php://input'), true);

    if(!empty($data)){

        date_default_timezone_set('America/Sao_Paulo');
        $dataLocal = date('Y/d/m H:i:s', time());

        $status = $data['values'][0];
        $sql = "INSERT INTO logstatus (id, sensor_01, sensor_02, time_date) VALUES (NULL, '".$status."', '".$status."', NULL)";
        $statement=$pdo->prepare($sql);
        $statement->execute();

		if (!empty($status)) {
            $sql = "SELECT pid_response FROM logcondition";
            $statement=$pdo->prepare($sql);
            $statement->execute();
            $response = $statement->fetch();


            $pid = $response['pid_response'];
            if($pid > 10){
                echo "1";
            }
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "Couldn't get the JSON string";
    }
?>
