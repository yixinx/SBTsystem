<?php

class Jalogin
{
		var $conn;
    public $jam = NULL;
    public $ht = array();
	public $jauth_url = NULL;
	public $return_url = NULL;

		function __construct() {
			$this->conn = mysqli_connect("localhost", "sbtsys", "sbt@8765", "sbtsys"); 
			mysqli_query($this->conn, "SET NAMES 'utf8'");
		}
		
		function __destruct() {
			mysqli_close($this->conn);
		}

    function index()
    {
        if (!$this->input->get('jatkt')) {
            // 未登录成功
            if (!empty($_SERVER['HTTP_REFERER'])) {
                // 存储来源链接
                $this->return_url = $_SERVER['HTTP_REFERER'];
                $this->session->set_userdata('jaccount_return_url', $this->return_url);
            }
        }

        if ($this->session->userdata('jaccount_return_url')) {
            $this->return_url = $this->session->userdata('jaccount_return_url');
        } else {
            $this->return_url = base_url();//site_url();
        }

        $this->ht = $this->jam->checkLogin($this->jauth_url);

        if (!empty($this->ht)) {
            //Jaccount登录成功
            if (isset($this->ht['student']) && $this->ht['student']==='yes') {
                if (isset($this->ht['dept']) && $this->ht['dept']==='密西根学院') {
                    //认定本学院学生 开始写入session
                    $this->session->set_userdata('login_method', 'Jaccount_JIstudent');
                    $this->session->set_userdata('studentID',$this->ht['id']);
                    $this->session->set_userdata('username','JI_Student');
                    $this->session->set_userdata('name',$this->ht['chinesename']);
                }
                else {
                    //$_GET['logout']=-1;
                    $this->jam->logout('/user/login?notji=1');
                }
                    //$this->session->set_userdata('login_method', 'Jaccount_student');
            }
            /*else {
                //老师
                $_GET['logout']=-1;
                $this->jam->logout('/user/login?notji=1');
            }*/
            
        }
        redirect($this->return_url);
    }

    function logout($url='/') {
        $this->jam->logout($url);
    }
}
/*End of file*/
