<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 2:19 PM
 */

class ImageModel
{
    private $name;
    private $tmp_name;
    private $size;
    private $type;
    private $errors;

    private $connection;

    public function __construct()
    {
        try{
            global $database;
            $this->connection = $database->getConnection();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getParams($image){
        $this->name = $image['name'];
        $this->tmp_name = $image['tmp_name'];
        $this->type = $image['type'];
        $this->size = $image['size'];
        $this->errors = $image['error'];
    }

    public function checkForErrorsAndUpload($location, $alt){
        if(empty($this->name) || empty($this->tmp_name) || empty($this->size) || empty($this->type)){
            return false;
        }else{
            if($this->errors){
                return false;
            }else{
                $max_size = 3000000;
                $accept_types = ['image/png', 'image/jpeg', 'image/jpg'];
                $errors = [];


                if($this->size >= $accept_types){
                    $errors[] = 'Image must be under 3MB of size.';
                }

                if(!in_array($this->type, $accept_types)){
                    $errors[] = 'Image is not in valid format.';
                }

                if(count($errors) > 0){
                    return false;
                }else{
                    $name = time() . $this->name;
                    $location = $location . $name;

                    if(!move_uploaded_file($this->tmp_name, $location)){
                        return false;
                    }else{
                        $query = 'INSERT INTO images(image_location, image_alt) VALUES (?,?)';
                        $prepare = $this->connection->prepare($query);

                        return $prepare->execute([$location, $alt]);
                    }
                }
            }
        }

        return false;
    }
}