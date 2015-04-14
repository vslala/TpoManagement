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

    public function getBranchNames() {
        $stmt = $this->db->prepare("SELECT * FROM branches");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateNews($heading, $content) {
        $stmt = $this->db->prepare("INSERT INTO news (heading,content) VALUES (?,?)");
        $stmt->execute([$heading, $content]);
        return true;
    }

    public function getStudentQueries() {
        $stmt = $this->db->prepare("SELECT * FROM queries WHERE `ignore`=? LIMIT 5");
        $stmt->execute([false]);
        return $stmt->fetchAll();
    }

    public function ignoreQuery($id) {
        $stmt = $this->db->prepare("UPDATE queries SET `ignore`=? WHERE id=?");
        $stmt->execute([true, $id]);
        return true;
    }

    public function selectStudents($branch, $llimit, $ulimit) {
        $stmt = $this->db->prepare("SELECT s_acad_info.t_back_logs as back_logs, s_acad_info.c_back_log as curr_back_log, s_acad_info.id as acad_id, s_acad_info.cgpa,
s_basic_info.first_name, s_basic_info.last_name, s_basic_info.email, s_basic_info.enrollment, s_basic_info.branch as b_id, s_basic_info.semester,
s_personal_info.father_name, s_personal_info.dob, s_personal_info.gender, s_personal_info.mobile, s_personal_info.id as personal_id, s_personal_info.address,
branches.id as branch_id, branches.name as branch 
FROM s_acad_info
JOIN s_basic_info
JOIN s_personal_info
JOIN branches
WHERE s_acad_info.cgpa > ? AND s_acad_info.cgpa < ?
AND s_acad_info.enrollment = s_personal_info.enrollment
AND s_personal_info.enrollment = s_basic_info.enrollment
AND s_basic_info.branch = branches.id
AND branches.id = ?");
        $stmt->execute([$llimit,$ulimit,$branch]);
        return $stmt->fetchAll();
    }

    public function selectStudentBasicInfo() {
        $stmt = $this->db->prepare("SELECT * FROM s_basic_info");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectStudentPersonalInfo() {
        $stmt = $this->db->prepare("SELECT * FROM s_personal_info");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectStudentAcadInfo() {
        $stmt = $this->db->prepare("SELECT * FROM s_acad_info");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectStudentBasicInfoViaEnrollment($enrollment) {
        $stmt = $this->db->prepare("SELECT s_basic_info.*, branches.name as stream FROM s_basic_info JOIN branches WHERE s_basic_info.enrollment=? AND s_basic_info.branch = branches.id");
        $stmt->execute([$enrollment]);
        return $stmt->fetchAll();
    }

    public function selectStudentPersonalInfoViaEnrollment($enrollment) {
        $stmt = $this->db->prepare("SELECT * FROM s_personal_info WHERE enrollment=?");
        $stmt->execute([$enrollment]);
        return $stmt->fetchAll();
    }

    public function selectStudentAcadInfoViaEnrollment($enrollment) {
        $stmt = $this->db->prepare("SELECT * FROM s_acad_info WHERE enrollment=?");
        $stmt->execute([$enrollment]);
        return $stmt->fetchAll();
    }

}
