<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnect
 *
 * @author Vaibhav
 */
class DBConnect {
    private $db = NULL;

    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "tpo";

    public function __construct() {
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_SERVER;
        try {
            $this->db = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' .
            $e->getMessage());
        }
        return $this->db;
    }
    
    public function seedBranches(){
        $stmt = $this->db->prepare("INSERT INTO branches (name) VALUES (?)");
        $branches = ["Computer Science", "Mechanical", "Information Technology", "Civil", "Electricals & Electronics"];
        
        for($i=0; $i<count($branches); $i++){
            $stmt->execute([$branches[$i]]);
        }
        
        return true;
    }
    
    public function getBranchNames(){
        $stmt = $this->db->prepare("SELECT * FROM branches");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function insertBasicInfo($firstName, $lastName, $email, $enrollment, $branch, $semester){
        $stmt = $this->db->prepare("INSERT INTO s_basic_info (first_name,last_name,email,enrollment,branch,semester) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$firstName,$lastName,$email,$enrollment, $branch, $semester]);
        return true;
    }
    
    public function insertPersonalInfo($firstName, $lastName, $fname, $dob, $enrollment, $email, $gender, $mobile, $address){
        $stmt = $this->db->prepare("INSERT INTO s_personal_info (first_name,last_name, father_name, dob, enrollment,email,gender, mobile,address) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$firstName,$lastName,$fname,$dob,$enrollment,$email,$gender,$mobile,$address]);
        return true;
    }
    
    public function insertAcademicInfo($enrollment, $tBackLogs, $cBackLog, $cgpa){
        $stmt = $this->db->prepare("INSERT INTO s_acad_info (enrollment,t_back_logs,c_back_log,cgpa) VALUES (?,?,?,?)");
        $stmt->execute([$enrollment,$tBackLogs,$cBackLog,$cgpa]);
        return $this->db->lastInsertId();
    }
    
    
    
    public function insertStudentQuery($name,$email,$subject,$message){
        $stmt = $this->db->prepare("INSERT INTO queries (name,email,subject,message,`ignore`) VALUES (?,?,?,?,?)");
        $stmt->execute([$name,$email,$subject,$message,false]);
        return true;
    }
    
    public function insertTotalBackNames($id, $subject){
        $stmt = $this->db->prepare("INSERT INTO total_backs (s_id, subject) VALUES (?,?)");
        $stmt->execute([$id,$subject]);
        return true;
    }
    
    public function insertCurrentBackNames($id,$subject){
        $stmt = $this->db->prepare("INSERT INTO current_backs (s_id, subject) VALUES (?,?)");
        $stmt->execute([$id,$subject]);
        return true;
    }
    
    public function fetchTopFiveNews(){
        $stmt = $this->db->prepare("SELECT * 
FROM news 
ORDER BY created_at DESC
LIMIT 5");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
