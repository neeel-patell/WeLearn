<?php
    include '../../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $usertype = 2;
    $search = strtolower($_POST['search']);
    if(is_numeric($search)){
        $query = "SELECT first_name,last_name,id,class_id,medium_id,active from login where mobile LIKE '%$search%' AND user_type=$usertype order by first_name,last_name";
        $result = $conn->query($query);
        while($row = $result->fetch_array()){
            $class_name = $conn->query("select name from class where id=".$row['class_id']);
            $class_name = $class_name->fetch_array();
            $medium_name = $conn->query("select name from medium where id=".$row['medium_id']);
            $medium_name = $medium_name->fetch_array();
            array_push($data,array("first_name"=>$row['first_name'],"last_name"=>$row['last_name'],"active"=>$row['active'],"id"=>$row['id'],"class"=>$class_name['name'],"medium"=>$medium_name['name']));
        }
    }
    else {
        if(filter_var($search, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT first_name,last_name,id,class_id,medium_id,active from login where email LIKE '%$search%' AND user_type=$usertype order by first_name,last_name";
            $result = $conn->query($query);
            while($row = $result->fetch_array()){
                $class_name = $conn->query("select name from class where id=".$row['class_id']);
                $class_name = $class_name->fetch_array();
                $medium_name = $conn->query("select name from medium where id=".$row['medium_id']);
                $medium_name = $medium_name->fetch_array();
                array_push($data,array("first_name"=>$row['first_name'],"last_name"=>$row['last_name'],"active"=>$row['active'],"id"=>$row['id'],"class"=>$class_name['name'],"medium"=>$medium_name['name']));
            }
        }
        else{
            $ids = array();
            if(strpos($search, " ") !== false){
                $search = explode(" ",$search);
                $query = "SELECT first_name,last_name,id,class_id,medium_id,active from login where lower(first_name) LIKE \"%".$search[0]."%\" AND lower(last_name) LIKE \"%".$search[1]."%\" AND user_type=$usertype order by first_name,last_name";
                $result = $conn->query($query);
                while($row = $result->fetch_array()){
                    $class_name = $conn->query("select name from class where id=".$row['class_id']);
                    $class_name = $class_name->fetch_array();
                    $medium_name = $conn->query("select name from medium where id=".$row['medium_id']);
                    $medium_name = $medium_name->fetch_array();
                    array_push($ids,$row['id']);
                    array_push($data,array("first_name"=>$row['first_name'],"last_name"=>$row['last_name'],"active"=>$row['active'],"id"=>$row['id'],"class"=>$class_name['name'],"medium"=>$medium_name['name']));
                }
                $query = "SELECT first_name,last_name,id,class_id,medium_id,active from login where lower(first_name) LIKE \"%".$search[1]."%\" AND lower(last_name) LIKE \"%".$search[0]."%\" AND user_type=$usertype order by first_name,last_name";
                $result = $conn->query($query);
                while($row = $result->fetch_array()){
                    if(!in_array($row['id'],$ids,true)){
                        $class_name = $conn->query("select name from class where id=".$row['class_id']);
                        $class_name = $class_name->fetch_array();
                        $medium_name = $conn->query("select name from medium where id=".$row['medium_id']);
                        $medium_name = $medium_name->fetch_array();
                        array_push($data,array("first_name"=>$row['first_name'],"last_name"=>$row['last_name'],"active"=>$row['active'],"id"=>$row['id'],"class"=>$class_name['name'],"medium"=>$medium_name['name']));
                    }
                }
            }
            else{
                $ids = array();
                $query = "SELECT first_name,last_name,id,class_id,medium_id,active from login where lower(first_name) LIKE '%$search%' AND user_type=$usertype order by first_name,last_name";
                $result = $conn->query($query);
                while($row = $result->fetch_array()){
                    $class_name = $conn->query("select name from class where id=".$row['class_id']);
                    $class_name = $class_name->fetch_array();
                    $medium_name = $conn->query("select name from medium where id=".$row['medium_id']);
                    $medium_name = $medium_name->fetch_array();
                    array_push($ids,$row['id']);
                    array_push($data,array("first_name"=>$row['first_name'],"last_name"=>$row['last_name'],"active"=>$row['active'],"id"=>$row['id'],"class"=>$class_name['name'],"medium"=>$medium_name['name']));
                }
                $query = "SELECT first_name,last_name,id,class_id,medium_id,active from login where lower(last_name) LIKE '%$search%' AND user_type=$usertype order by first_name,last_name";
                $result = $conn->query($query);
                while($row = $result->fetch_array()){
                    if(!in_array($row['id'],$ids,true)){
                        $class_name = $conn->query("select name from class where id=".$row['class_id']);
                        $class_name = $class_name->fetch_array();
                        $medium_name = $conn->query("select name from medium where id=".$row['medium_id']);
                        $medium_name = $medium_name->fetch_array();
                        array_push($data,array("first_name"=>$row['first_name'],"last_name"=>$row['last_name'],"active"=>$row['active'],"id"=>$row['id'],"class"=>$class_name['name'],"medium"=>$medium_name['name']));
                    }
                }
            }
        }
    }
    
    echo json_encode(array("data"=>$data));
?>