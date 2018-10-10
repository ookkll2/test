<meta charset="UTF-8">
<?php
$flag = "NO";
$sql = "show tables from yagaja_DB";
$result = mysqli_query($con, $sql) or die("실패원인:".mysqli_error($con));
while($row=mysqli_fetch_row($result)){
    if($row[0]==="shop_notice"){
        $flag = "OK";
        break;
    }
}
if($flag !=="OK"){
    $sql = "create table shop_notice(
      notice_no int not null auto_increment,
      notice_id char(20) not null,
      notice_nick varchar(100) not null,
      notice_subject varchar(50) not null,
      notice_content text not null,  
      regist_day char(20),
      hit int,
      file_name_0 varchar(40),
      file_name_1 varchar(45),
      file_name_2 varchar(45),
      file_copied_0 varchar(40),
      file_copied_1 varchar(40),
      file_copied_2 varchar(40),
      primary key(notice_no)
    )CHARSET UTF8";
    if(mysqli_query($con, $sql)){
        echo "<script>
                alert('notice 테이블 생성성공!');
              </script>";
    }else{
        echo "<script>
                alert('notice 테이블 생성실패');
              </script>";
    }
}
?>