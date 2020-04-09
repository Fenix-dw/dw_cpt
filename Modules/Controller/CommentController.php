<?php 

    namespace Modules\Controller;

    use Modules\AuthError;

    class CommentController extends AuthError {

        private $comment, $comment_post_ID, $author, $email, $comment_parent, $rating, $postID;
        
        function __construct($comment = false, $comment_post_ID = false, $author = false, $email = false, $comment_parent = false, $rating = 5)
        {

            if($comment && $comment_post_ID && $author && $email)
            {
                $this->comment = $comment;
                $this->comment_post_ID = $comment_post_ID;
                $this->author  = $author;
                $this->email   = $email;
                $this->rating  = $rating;
                if($comment_parent){
                    $this->comment_parent = $comment_parent;
                }

            }
           
        } 

        function save() 
        {   
            $commentdata = array(
                'comment_post_ID'      => $this->comment_post_ID,
                'comment_author'       => $this->author,
                'comment_author_email' => $this->email,
                'comment_content'      => $this->comment,
                'comment_type'         => '',
                'user_ID'              => 0,
                'comment_meta'         => [
                    'rating' => $this->rating 
                ]
            );

            if($this->comment_parent)
            {
                $commentdata['comment_parent'] = $this->comment_parent;
            }

            wp_new_comment( $commentdata );                          
        }
    }


?>