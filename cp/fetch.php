<?Php
    $dbhost = '127.0.0.1';
    $dbname = 'pisdoego_db_pis';  
    $dbuser = 'root';                  
    $dbpass = 'admin';
	$charset = 'utf8';
    
    
    try{
        
        $dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname};charset={$charset}",$dbuser,$dbpass);
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch(PDOException $ex){
        
        die($ex->getMessage());
    }  
 header( 'Content-Type: text/html; charset=utf-8' ); 	
?>
<?php
$output = '';
$data = $_GET['search'];
$query = $dbcon->prepare("select * from tbl_users where fullname LIKE '%".$_GET["search"]."%' and not user_type = '0';");
$query->bindValue(1, PDO::PARAM_STR);
$query->execute();
// Display search result
         if (!$query->rowCount() == 0) {         
            while($row = $query->fetch(PDO::FETCH_ASSOC))
{ 
              $output .= '  
                <p> '.$row["fullname"].' </p>  
           ';  
                ?>             
             
       <?php      }
        echo $output;
                    
        } else {?>
        
        <div class="search_title"> <p>कुनै परिणाम नभेटिएको अवस्था !</p></div>
        <?php }
    
    ?>