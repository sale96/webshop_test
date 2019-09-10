<?php


class User extends Controller
{
    public function login(){
        if(Sessions::isLogged()){
            header('Location: index.php');
            exit();
        }
        if(isset($_POST['submit-login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            if(empty($username) || empty($password)){
                Sessions::setError("Fields are not supposed to be empty.");
                $data['params'] = $_POST;
                $this->view('log/register', $data);
            }else{
                $usernameReg = '/^[\w]{6,}$/';
                $passwordReg = '/^[\w]{6,12}$/';

                $error = [];

                if(!preg_match($usernameReg, $username)){
                    $error[] = 'Username should have 6 letters minimum, only letters and numbers.';
                }

                if(!preg_match($passwordReg, $password)){
                    $error[] = 'Password should only have minimum 6 letters or numbers, maximum 12';
                }

                if(count($error) > 0){
                    Sessions::setError($error);
                    $data['params'] = $_POST;
                    $this->view('log/register', $data);
                }else{
                    global $database;
                    $password = md5($password);

                    $query = "SELECT user_id, role_id FROM users WHERE username=? AND password=?";
                    $prepare = $database->getConnection()->prepare($query);

                    if($prepare->execute([$username, $password])){
                        if($prepare->rowCount() == 1){
                            $result = $prepare->fetch();
                            Sessions::setLogged($result->user_id, $result->role_id);
                            Sessions::setSuccess("You have been logged in.");
                            header('Location: index.php');
                            exit();
                        }
                    }
                }
            }
        }else{
            $this->view('log/login');
        }
    }

    public function register(){
        if(Sessions::isLogged()){
            header('Location: index.php');
            exit();
        }
        if(isset($_POST['submit-register'])){
            $name = $_POST['first-last-name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rep_password = $_POST['rep-password'];

            if(empty($name) || empty($username) || empty($email) || empty($password) || empty($rep_password)){
                Sessions::setError("Fields are not supposed to be empty.");
                $data['params'] = $_POST;
                $this->view('log/register', $data);
            }else{
                $nameReg = '/^([A-Z]{1}[a-z]{3,})$/';
                $usernameReg = '/^[\w]{6,}$/';
                $passwordReg = '/^[\w]{6,12}$/';

                $error = [];

                if(!preg_match($nameReg, $name)){
                    $error[] = 'Name should have capitalized first letter followed by lowercase letters.';
                }

                if(!preg_match($usernameReg, $username)){
                    $error[] = 'Username should have 6 letters minimum, only letters and numbers.';
                }

                if(!preg_match($passwordReg, $password)){
                    $error[] = 'Password should only have minimum 6 letters or numbers, maximum 12';
                }else{
                    if($password != $rep_password){
                        $error[] = 'You must repeat the password.';
                    }
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error[] = 'Email is not valid.';
                }

                if(count($error) > 0){
                    Sessions::setError($error);
                    $data['params'] = $_POST;
                    $this->view('log/register', $data);
                }else{
                    global $database;
                    $password = md5($password);

                    $query = "INSERT INTO users(first_last_name, username, email, password) VALUES (?,?,?,?)";
                    $prepare = $database->getConnection()->prepare($query);

                    if($prepare->execute([$name, $username, $email, $password])){
                        Sessions::setSuccess("You have been registrated.");
                        $this->view('log/register');
                    }
                }
            }
        }else{
            $this->view('log/register');
        }
    }

    public function logout(){
        if(!Sessions::isLogged()){
            header('Location: index.php');
            exit();
        }

        Sessions::destroyLogged();
        header('Location: index.php?page=User/login');
        exit();
    }
}