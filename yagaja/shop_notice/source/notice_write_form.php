<?php
session_start();
if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $cname = $_SESSION['name'];
}
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
    $no = $_GET["no"];
}

include_once '../../common_lib/createLink_db.php';
include_once '../../shopping_lib/create_table_notice.php';

if(isset($_GET['mode']) && $mode="modify"){
    $sql= "select * from shop_notice where notice_no=$no";
    $result= mysqli_query($con, $sql);
    $row=mysqli_fetch_array($result);
    
    $nick=$row['notice_nick'];
    $subject=$row['notice_subject'];
    $content=$row['notice_content'];
    $regist_day=$row['regist_day'];
    $file_copied[0]=$row['file_copied_0'];
    $file_copied[1]=$row['file_copied_1'];
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>야! 몰</title>
  <link rel="stylesheet" href="../css/notice.css?ver=45">
  <link rel="stylesheet" href="../../shopping/css/cart.css?ver=15">
  <link rel="stylesheet" href="../../common_css/shop_index_css3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../shopping/css/shopping3.css?ver=6">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
	function check_input(){
		if(!document.notice_form.subject.value){
          alert('제목을 입력하세요!');
          document.notice_form.subject.focus();
          return;
	    } 
        if(!document.notice_form.content.value){
          alert('내용을 입력하세요!');
          document.notice_form.content.focus();
          return;
        }
        document.notice_form.submit();
	}
  </script>
</head>
<body>
    <header>
   		<?php include_once '../../shopping_lib/top_login3.php';?>
    </header>
    <nav id="shop_aside">
    	<?php include_once '../../shopping_lib/shop_main_menu.php';?>  	
    </nav>
    <section>
    	<div id="notice">NOTICE</div>
    </section>
  <?php 
  if(isset($mode) && $mode === "modify"){
  ?>
  	  <form name="notice_form" action="./insert.php?mode=modify&no=<?=$no?>" method="post" enctype="multipart/form-data">
  <?php 
  }else{
  ?>
      <form name="notice_form" action="./insert.php?" method="post" enctype="multipart/form-data">
  <?php 
  }
  ?>
            <section>
            	<div class="notice_section">
            		<table class="notice_section_table">
            			<tr>
            				<td class="notice_write_subject">제목</td>
        				    <?php 
                            if(isset($mode) && $mode === "modify"){
                            ?>
                            <td class="notice_write_content"><input id="notice_input_subject" type="text" name="subject" value="<?=$subject?>"></td>
            			</tr>
            			<tr>
            				<td class="notice_write_subject">내용</td>
            				<td class="notice_write_content_text">
            					<textarea id="notice_input_content" rows="10" cols="100" name="content" value="<?=$content?>"></textarea>
            				</td>
            			</tr>
            			<tr>
            				<td class="notice_write_subject">이미지파일1</td>
            				<td class="notice_write_content">
            					<input class="notice_input_image" type="file" name="upfile[]" value="0">
            					<div style="float: left;">
            					<?php 
            						if($file_copied[0]){
            					?>
									이미지:<?=$file_copied[0]?>&nbsp;<input type="checkbox" name="del_file[]" value="0">삭제
								<?php 
            						}else{
            					?>
            					<?php 
            						}
            					?>
            					</div>
            				</td>
            			</tr>
            			<tr>
            				<td class="notice_write_subject">이미지파일2</td>
            				<td class="notice_write_content">
            					<input class="notice_input_image" type="file" name="upfile[]" value="1">
            					<div style="float: left;">
            					<?php 
            						if($file_copied[1]){
            					?>
									이미지:<?=$file_copied[1]?>&nbsp;<input type="checkbox" name="del_file[]" value="1">삭제
								<?php 
            						}else{
            					?>
            					<?php 
            						}
            					?>
            					</div>
            				</td>
            			</tr>
            			<?php 
                            }else{
            			?>  
            				<td class="notice_write_content"><input id="notice_input_subject" type="text" name="subject"></td>
            			</tr>
            			<tr>
            				<td class="notice_write_subject">내용</td>
            				<td class="notice_write_content_text">
            					<textarea id="notice_input_content" rows="10" cols="30" name="content"></textarea>
            				</td>
            			</tr>
            			<tr>
            				<td class="notice_write_subject">이미지파일1</td>
            				<td class="notice_write_content"><input class="notice_input_image" type="file" name="upfile[]"></td>
            			</tr>
            			<tr>
            				<td class="notice_write_subject">이미지파일2</td>
            				<td class="notice_write_content"><input class="notice_input_image" type="file" name="upfile[]"></td>
            			</tr>
            			<?php 
                            }
            			?>
            		</table>
            		<div id="notice_write_form">
            			<input type="button" class="notice_write" onclick="check_input()" value="완료">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            			<a href="./shop_notice.php?page=1"><button class="notice_write">취소</button></a>
            		</div>
        		</div>    
            </section>
		</form>
	<div class="clear"></div><div class="clear"></div><div class="clear"></div>
	<footer style="border-top:2px solid black;">
 		<?php include_once '../../common_lib/footer2.php';?>
  	</footer>
</body>
</html>  