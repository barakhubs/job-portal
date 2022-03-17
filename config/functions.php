<?php

use LDAP\Result;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


    class functions extends db{

        //Retrive function
        public function select($table, $limit){
            $sql    = "SELECT * FROM ".$table." ORDER BY id DESC LIMIT ".$limit;
            $result = $this->connect()->query($sql);

            if($result->rowCount() > 0){
                while($row = $result->fetch()){
                    $data[] = $row;
                }
                return $data;
            }
        }
        
        //Retrive function
        public function selectWhere($table, $value, $condition){
            $sql = "SELECT * FROM ".$table." WHERE ".$value."=:condition";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array('condition' => $condition));
            $result = $stmt->fetchAll();

            return $result;
        }

        //Retrive function
        public function selectWhereNot($table, $value, $condition){
            $sql = "SELECT * FROM ".$table." WHERE ".$value."!=:condition";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array('condition' => $condition));
            $result = $stmt->fetchAll();

            return $result;
        }

        // search jobs
        public function searchJob($table, $keyword, $category){
            $sql = "SELECT * FROM ".$table." WHERE title LIKE :keyword OR category_id LIKE :category";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array('keyword' => $keyword, 'category' => $category));
            $result = $stmt->fetchAll();

            return $result;
        }

        //Retrive function
        public function selectCount($table, $value, $condition){
            $sql = "SELECT * FROM ".$table." WHERE ".$value."=".$condition;

            $result = $this->connect()->query($sql)->rowCount();

            return $result;
        }

        //Retrive function for related tables
        public function selectRelation($id,$table){
          
            $sql = "SELECT * FROM ".$table." WHERE category_id=:id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $results;
        }

        //insert function
        public function insert($fields, $table, $msg,$url,$error){
            $impClm = implode(', ', array_keys($fields));
            $impHolder = implode(', :', array_keys($fields));

            $sql = "INSERT INTO ".$table." ($impClm) VALUES (:".$impHolder.")";
            $state = $this->connect()->prepare($sql);

            foreach($fields as $key => $value){
                $state->bindValue(':'.$key,$value);
            }

            $stateExec = $state->execute();

            if($stateExec){
                header('Location:'.$url.'?msg='.$msg);
            }else{
                header('Location:'.$url.'?error='.$error);
            }
        }

        //getting one item function
        public function selectOne($id, $table){
            $sql = "SELECT title FROM ".$table." WHERE id=:id LIMIT 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                return $result;
            }
        }

        //getting one item function
        public function selectJob($id, $table, $column){
            $sql = "SELECT ".$column." FROM ".$table." WHERE id=:id LIMIT 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                return $result;
            }
        }

        public function selectCandidate($id, $table){
            $sql = "SELECT first_name, last_name FROM ".$table." WHERE id=:id LIMIT 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                return $result;
            }
        }

        
        public function selectSingle($id, $table){
            $sql = "SELECT * FROM ".$table." WHERE id=:id LIMIT 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $row = $stmt->rowCount();
            $result = $stmt->fetch();

            return $result;
        }

        //update function
        public function update($fields,$id,$table, $url){
           $st = "";
           $counter = 1;
           $total_fields = count($fields);

           foreach($fields as $key=>$value){
               if($counter === $total_fields){
                   $set = "$key = :".$key;
                   $st = $st.$set;
               }else{
                $set = "$key = :".$key.", ";
                $st = $st.$set; 
                $counter++;
               }
           }

           $sql = "";
           $sql.= "UPDATE ".$table." SET ".$st;
           $sql.= " WHERE id = ".$id;

           $stmt = $this->connect()->prepare($sql);

           foreach($fields as $key => $value){
               $stmt->bindValue(':'.$key, $value);
           }

           $stmtExec = $stmt->execute();

           if($stmtExec){
            $msg = "Successfully Updated the field";
            header('Location:'.$url.'?msg='.$msg);
           }
        }

        //delete function
        public function delete($id, $table, $url){
            $sql = "DELETE FROM ".$table." WHERE id = :id";

            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmtExec = $stmt-> execute();

            if($stmtExec){
                $msg = "Successfully Deleted";
                header('Location:'.$url.'?msg='.$msg);
               }
        }

        // login function
        public function login($email, $password, $table, $url, $error){
            $sql = "SELECT * FROM ".$table." WHERE email=:email";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":email",$email);
            $stmt->execute();
            $row = $stmt->rowCount();
            $result = $stmt->fetch();
            
            if ($row == 1 && $table == 'candidates') {
                
                if (password_verify($password, $result['password'])) {
                    session_start();
                    $_SESSION['candidate'] = $result['email'];
                    $_SESSION['id'] = $result['id'];
                    header("Location:index.php");                
                }else{
                    header('Location:'.$url.'?msg='.$error);
                }
            }elseif ($row == 1 && $table == 'admins') {
                if (password_verify($password, $result['password'])) {
                    session_start();
                    $_SESSION['admin'] = $result['email'];
                    $_SESSION['id'] = $result['id'];
                    header("Location:/admin/index.php");                
                }else{
                    header('Location:'.$url.'?msg='.$error);
                }
            }else{
                $error = "User does not exist";
                header('Location:'.$url.'?msg='.$error);
            }
        }

        // check user existance
        
        public function userExists($email, $table){
            $sql = "SELECT * FROM ".$table." WHERE email=:email";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":email",$email);
            $stmt->execute();
            $result = $stmt->fetch();
            
            return $result;
        }

        // is logged in
        function isLoggedIn()
        {
            if (!isset($_SESSION['candidate']) || $_SESSION['candidate'] !== true)
            {
                return false;
            }
            return true;
        }

        //get current url and make class active
        function activePage($currect_page){
            $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
            $url = end($url_array);  
            if($currect_page == $url){
                echo 'active'; //class name in css 
            } 
          }

        public function dashboardCount($table){
            $sql = "SELECT * FROM ".$table;

            $result = $this->connect()->query($sql)->rowCount();

            return $result;
        }


        public function sendMail($recipient, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();     
            $mail->Mailer = "smtp";                                       //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'barakhub5@gmail.com';                     //SMTP username
            $mail->Password   = '23April,1996';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('barakhub5@gmail.com', 'Job Portal');
            $mail->addAddress($recipient);     //Add a recipient
            $mail->addReplyTo('barakhub5@gmail.com', 'Information');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    }
