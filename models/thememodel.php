<?php

class thememodel extends CI_Model
{

    public function insert($email, $password)
    {
        $password = md5($password);
        $sql = $this->db->query("INSERT INTO register(email,password) values ('$email','$password')");
    }

    /*     public function fetch()
    {
        $sql = $this->db->query("SELECT * FROM ");
        return $sql->result();
    }
 */
    public function postinsert($data)
    {
        // print_r($data); exit;
        $this->db->insert('post', $data);
        return true;
    }

    public function post_list()
    {
        // return  $list = $this->db->get('post')->result_array();
        // $this->db->select('register.id,register.email,post.id,post.post_title,post.post_desc,post.register_like');
        // $this->db->from('register');
        // $this->db->join('post', 'register.id=post.register_id');

        $this->db->select('post.id, post.post_title, post.register_id, post.post_desc, post.register_like, 
            register.id as register_id, register.email');
        $this->db->from('post');
        $this->db->join('register', 'post.register_id = register.id');


        $query = $this->db->get();

        /* echo "<pre>";print_r($result);
     exit;  */
        return $query->result_array();
    }

    public function user_likes()
    {
        // return  $list = $this->db->get('post')->result_array();
        // $this->db->select('register.id,register.email,post.id,post.post_title,post.post_desc,post.register_like');
        // $this->db->from('register');
        // $this->db->join('post', 'register.id=post.register_id');

        $this->db->select('post_like.*');
        $this->db->from('post_like');



        $query = $this->db->get();

        /* echo "<pre>";print_r($result);
     exit;  */
        return $query->result_array();
    }

    public function checkLikeExistsOrNot($postId, $sessionId)
    {
        // return  $list = $this->db->get('post')->result_array();
        // $this->db->select('register.id,register.email,post.id,post.post_title,post.post_desc,post.register_like');
        // $this->db->from('register');
        // $this->db->join('post', 'register.id=post.register_id');

        $this->db->select('post_like.*');
        $this->db->from('post_like');
        $this->db->where('register_id', $sessionId);
        $this->db->where('post_id', $postId);


        $query = $this->db->get();

        /* echo "<pre>";print_r($result);
     exit;  */
        return $query->result_array();
    }
    public function like($id, $id_sel)
    {
        //  echo "Hello"; exit;

        $query = "SELECT id FROM register WHERE email = '$id_sel'";
        $query2 = $this->db->query($query);
        $try = $query2->result_array();
        $data = array(
            'post_id' => $id,
            'likes' => '1',
            'register_id' => $id_sel,

        );
        // print_r($data);exit;
        $check = "SELECT id FROM post_like WHERE post_id = '$id' && register_id = '$id_sel'";
        $check2 = $this->db->query($check);
        $try_likes = $check2->result_array();

        if (!empty($try_likes)) {
            //echo "Already_Liked";
            // return  $id_sel;
            redirect('theme/post_list');
        } else {
            echo $id;
            $query = "SELECT register_like FROM post WHERE id = '$id'";
            $query2 = $this->db->query($query);
            $try = $query2->result_array();
            //echo "<pre>";print_r($try);exit;
            $try2 = $try[0];
            $try3 = $try2['register_like'];
            $try4 = $try3 + 1;
            $query =  "UPDATE post SET register_like = '$try4' WHERE id = $id";
            $this->db->query($query);
            return $this->db->insert('post_like', $data);
            // return  $id_sel;
        }
    }
    public function post_unlike($id, $id_sel)
    {
        // echo $id_sel;exit;
        $query = "SELECT register_like FROM post WHERE id = '$id'";
        $query2 = $this->db->query($query);
        $try = $query2->result_array();
        $try2 = $try[0];
        $total_likes = $try2['register_like'];
        $new_likes = $total_likes - 1;
        $query1 = "UPDATE post set register_like = '$new_likes' WHERE id = $id";
        $this->db->query($query1);
        $query = "DELETE FROM post_like WHERE post_id = $id and register_id = $id_sel";
        $this->db->query($query);
    }
}



   /*  public function like_new($id)
    {
        $dt = $this->session->userdata('likes');
        $current = $dt['id'];    
         $query = "SELECT id FROM register WHERE email = '$current'";
        $query2 = $this->db->query($query);
        $try = $query2->result_array();
        echo "<pre>";
        $try2 = $try[0];
        $user_id = $try2['id'];
        $data = array(
            'post_id' => $id,
            'likes' => '1',
            'register_id' => $user_id,

        );
        
        return $this->db->insert('post_like',$data);
    */ 
       /*  $check = "SELECT id FROM post_like WHERE post_id = '$id' && register_id = '$user_id'";
        $check2 = $this->db->query($check);
        return $check2->result_array();
        */ 
        /* if (!empty($try_likes)) {
            echo "LIKED";
            exit;
        } else {
            $query = "SELECT likes, user_liked FROM posts_detail WHERE id = $id";
            $query2 = $this->db->query($query);
            $try = $query2->result_array();

            $try2 = $try[0];
            $try3 = $try2['likes'];
            $try4 = $try3 + 1;
            $query =  "UPDATE posts_detail SET likes = '$try4' WHERE id = $id";
            $this->db->query($query);
            return $this->db->insert('likes', $data);
        } */
