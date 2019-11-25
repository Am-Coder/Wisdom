<?php
    require_once 'db_conn.php';
    require_once 'Session.php';
    class Blog{
        
        private $conn;

        public function __construct(){
            $this->conn = new dbConnection();
            $this->conn = $this->conn->connect();  
        }

        public function fetchAll($page){
            if($this->conn){
                // $stmt = $this->conn->prepare("SELECT * FROM blog LIMIT 10 OFFSET ? ORDER BY claps ");
                // $stmt->execute([2*(int)$page]);

               
                $stmt = $this->conn->prepare("SELECT blogid,email,title,imagetoshow,claps,datepublished,genre FROM blog ORDER BY claps desc");
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            return false;
        }   

        public function fetchByGenre($page,$genre){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT blogid,email,title,imagetoshow,claps,datepublished,genre FROM blog WHERE genre=? ORDER BY claps desc");
                $stmt->execute([$genre]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            return false;
        }   

        public function fetchById($id){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT * FROM blog_view WHERE blogid=? ");
                $stmt->execute([$id]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            return false;
        }

        public function fetchCommentsById($id){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT * FROM comment WHERE blogid=? order by date_time desc ");
                $stmt->execute([$id]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            return false;
        }

        public function fetchByEmail($email){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT blogid,email,title,imagetoshow,claps,datepublished,genre FROM blog WHERE email=? ORDER BY claps desc ");
                $stmt->execute([$email]);
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            return false;
        }


        public function fetchTotalBlogsByEmail($email){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT count(blogid) as tb FROM blog ");
                $stmt->execute([$email]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res['tb'];
            }

            return false;
        }

        public function fetchLikesByEmail($email){
            if($this->conn){
                $stmt = $this->conn->prepare("SELECT sum(claps) as tc  FROM blog WHERE email=?");
                $stmt->execute([$email]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res['tc'];
            }

            return false;
        }

        public function renameByEmail($email,$fname,$lname){
            if($this->conn){
                $stmt = $this->conn->prepare("UPDATE user SET firstname=?,lastname=? WHERE email=?");
                $stmt->execute([$fname,$lname,$email]);
                if($stmt->rowCount()>0){
                    Session::start();
                    Session::set('firstname',$fname);
                    Session::set('lastname',$lname);
                    return true;
                }
                return false;
            }
            return false;
        }

        public function addCommentById($id,$email,$content){
            if($this->conn){
                $stmt = $this->conn->prepare("INSERT INTO comment(email,content,blogid) VALUES(:email,:content,:id)");
                $stmt->execute([
                    'email'=>$email,
                    'content'=> $content,
                    'id'=> $id,
                    ]);

                if($stmt->rowCount()>0){

                    return true;
                }
                return false;
            }
            return false;
        }

        public function addBlog($title,$url,$info,$genre,$email){
            if($this->conn){
                $stmt = $this->conn->prepare("INSERT INTO blog(title,email,imagetoshow,blogtext,claps,timetoread,datepublished,genre) VALUES(:title,:email,:img,:info,:claps,:tread,:dat,:genre)");
                $stmt->execute([
                    'title'=>$title,
                    'email'=>$email,
                    'img'=> $url,
                    'info'=> $info,
                    'claps'=> 0,
                    'tread'=>3,
                    'dat'=>date("Y-m-d"),
                    'genre'=>$genre
                    ]);

                if($stmt->rowCount()>0){

                    return true;
                }
                return false;
            }
            return false;
        }
    }
?>