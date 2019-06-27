<?php


$email = $_POST['email'];

$password = $_POST['password'];
$conferpass = $_POST['conferpass'];
$email = stripcslashes($email);
$password = stripcslashes($password);
$conferpass = stripcslashes($conferpass);

if (!empty($email)|| !empty($password)|| !empty($conferpass)     )
{
    $host = "localhost";
    $dbEmail = "root";
    $dbPassWord = "";
    $dbname = "registerphp";
    $conn = new mysqli($host, $dbEmail, $dbPassWord,$dbname);
    if($password != $conferpass){
        echo '<p> chưa trùng khớp cái mật khẩu </p>';
    }
    if(mysqli_connect_error()){
        die('Connection error('.mysqli_connect_error().')'.mysqli_connect_error());
    }else{
        $SELECT = "SELECT email From account where  email = ? Limit 1";
        $INSERT = "INSERT Into account (email , password ,conferpass) value (?,?,?)";
        $stmt =  $conn-> prepare($SELECT);
        $stmt ->bind_param("s",$email);
        $stmt -> execute();
        $stmt ->bind_result($email);
       $stmt-> store_result();
        $rnum =$stmt ->num_rows;
        if($rnum ==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss",$email,$password,$conferpass);
$stmt ->execute();
echo "<p ><img src='./img/lilwayne.jpg' style='width: 300px' >
<p> dangkithanhcong, haỹ vào <a href='Login.html' style={'font-size: 39px'}>Login</a></p></body>";

        }else{
            echo "tài khoản trùng rồi , chưa validate nên để thế này ";
        }
        $stmt ->close();
        $conn->close();
    }


}else{
    echo "các bặn sẵn sàng chưa";
    die();
}

?><?php