<?php
include('includes/connection.php');

//  Function for getting Classes

function getClasses()
{
    global $con;
    $get_classes = "Select * from user_category";
    $run_classes = mysqli_query($con, $get_classes);
    while ($row = mysqli_fetch_array($run_classes)) {
        $user_cat_id = $row['user_cat_id'];
        $user_cat_name = $row['user_cat_name'];
        echo "<option value = '$user_cat_id'>$user_cat_name</option>";
    }
}

//  For getting Topoics
function getTopics()
{
    global $con;
    $get_classes = "Select * from topics";
    $run_classes = mysqli_query($con, $get_classes);
    while ($row = mysqli_fetch_array($run_classes)) {
        $topic_id = $row['topic_id'];
        $topic_name = $row['topic_name'];
        echo "<option value = '$topic_id'>$topic_name</option>";
    }
}

// Function for inserting post

function insertPost()
{
    if (isset($_POST['sub'])) {
        global $con;

        $user = $_SESSION['user_email'];
        $get_user = "Select * from users where user_email = '$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);

        $user_id = $row['user_id'];
        $user_cat_id = $_POST['user_cat'];
        $topic_id = $_POST['topic_id'];
        $content = addslashes($_POST['content']);

        $post_image = $_FILES['post_image']['name'];
        $image_tmp = $_FILES['post_image']['tmp_name'];

        move_uploaded_file($image_tmp, "posts/$post_image");

        date_default_timezone_set('Asia/Karachi');
        $date = date('d/m/Y h:i:sa', time());
        if ($content == '') {
            echo "<h2>Please enter title and discription!</h2>";
            exit();
        } else {
            $insert = "insert into posts (user_id, user_cat_id, topic_id, post_content, post_date, post_image) values ('$user_id', '$user_cat_id', '$topic_id', '$content', '$date', '$post_image')";
            $run = mysqli_query($con, $insert);
            if ($run) {
                echo '<h3>Posted to the timeline!</h3>';

                $update = "Update users set posts = 'Yes' where user_id = '$user_id'";
                $run_update = mysqli_query($con, $update);
                echo "<script>
                window.location.href = window.location.href;
                </script>";
            } else {
                echo mysqli_error($con);
            }
        }
    }
}

// For displaying posts

function getPosts()
{
    global $con;

    $per_page = 5;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start_from = ($page - 1) * $per_page;

    $user = $_SESSION['user_email'];
    $get_user = "Select * from users where user_email = '$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_id = $row['user_id'];
    $user_cat_id = $row['user_cat_id'];


    $get_posts = "Select * from posts WHERE user_cat_id = '$user_cat_id' or user_cat_id = 7 ORDER by 1 DESC LIMIT $start_from, $per_page";
    $run_posts = mysqli_query($con, $get_posts);
    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $user_cat_id = $row_posts['user_cat_id'];
        $topic_id = $row_posts['topic_id'];
        $content = substr($row_posts['post_content'], 0, 150); //   For limiting characters
        $post_date = $row_posts['post_date'];
        $post_image = $row_posts['post_image'];

        //  Getting the users who have posted the posts
        $topic = "Select * from topics where topic_id = '$topic_id'";

        $run_topic = mysqli_query($con, $topic);
        $row_topic = mysqli_fetch_array($run_topic);
        $topic_name = $row_topic['topic_name'];

        //  For getting user categories
        $cat = "Select * from user_category where user_cat_id = '$user_cat_id'";

        $run_cat = mysqli_query($con, $cat);
        $row_cat = mysqli_fetch_array($run_cat);
        $user_cat_name = $row_cat['user_cat_name'];

        // $user_image = $row_user['user_image'];

        $user = "Select * from users where user_id = '$user_id' AND posts = 'Yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        // $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //  Now displaying all at once
        echo "
           <div class='item mb-5'>
				<div class='media'>
					<img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
					<div class='media-body'>
						<h3 class='title mb-1'>$topic_name</h3>
						<div class='meta mb-1'><span class='date'> $post_date</div>
                        <div class='intro'>$content</div>";
        if ($post_image != "") {
            echo "
                        <div class='intro'><b>An image is attached...</b></div>
            ";
        } elseif ($post_image == "") {
            echo "
                        <div class='intro'>NO IMAGE ATTACHED</div>
            ";
        }
        echo "
                        <div class='intro'>POSTED FOR: $user_cat_name</div>
                        <a class='more-link' href= 'single.php?post_id=$post_id'>Read more &rarr;</a>
						</div>
					</div>
			</div>
	          ";
    }
    include('pagination.php');
}

//  For displaying every Single post

function singlePost()
{
    global $con;

    if (isset($_GET['post_id'])) {
        $get_id = $_GET['post_id'];
        $get_posts = "Select * from posts where post_id = '$get_id'";
        $run_posts = mysqli_query($con, $get_posts);
        $row_posts = mysqli_fetch_array($run_posts);

        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content']; //   For limiting characters
        $post_date = $row_posts['post_date'];
        $post_image = $row_posts['post_image'];

        //  Getting the users who have posted the posts
        $user = "Select * from users where user_id = '$user_id' AND posts = 'Yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //  Getting the user session
        $user_com = $_SESSION['user_email'];

        $get_com = "Select * from users where user_email ='$user_com'";
        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);
        $user_com_id = $row_com['user_id'];
        $user_com_name = $row_com['user_name'];

        //  Now displaying all at once
        echo "
            <div class='item mb-5'>
				<div class='media'>
					<img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
					<div class='media-body'>
						<h3 class='title mb-1'>$user_name</h3>
						
						<div class='meta mb-1'><span class='date'> $post_date</div>
                        <div class='intro'>$content</div>
                        ";
        if ($post_image != "") {
            echo "
                        <div class='intro'><a href = 'posts/$post_image'><img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'posts/$post_image'></a></div>
            ";
        } elseif ($post_image == "") {
            echo "
                        <div class='intro'>NO IMAGE ATTACHED</div>
            ";
        }
        echo "            
                        
						</div>
					</div>
			</div>
            ";

        include('comments.php');

        echo "
        <form action='' method = 'post' id = 'reply'>
            <textarea name='comment'  cols='50' rows='5' placeholder='Write a comment'></textarea>
            <br>
            <input class='btn btn-primary' type='submit' name='reply' value='Reply to this'>
        </form>
        
        ";
        if (isset($_POST['reply'])) {
            $comment = mysqli_real_escape_string($con, $_POST['comment']);

            $insert = "insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name', NOW())";
            $run = mysqli_query($con, $insert);
            if ($run) {
                echo "<script>
                window.location.href = window.location.href;
                </script>";
            } else {
                echo mysqli_error($con);
            }
        }
    }
}

// For Displaying Members
function members()
{
    global $con;
    //  Select all members

    echo '<br><h2>All Members on this site:</h2><hr>';
    $get_topics = 'select * from user_category';
    $run_topics = mysqli_query($con, $get_topics);
    while ($row = mysqli_fetch_array($run_topics)) {
        $user_cat_id = $row['user_cat_id'];
        $user_cat_name = $row['user_cat_name'];

        echo "<li><a href = 'members.php?user_cat_id=$user_cat_id'>$user_cat_name</a></li>";
    }
    echo "<br> <br>";
    if (isset($_GET['user_cat_id'])) {
        $user_cat_id =  $_GET['user_cat_id'];

        $user = "SELECT * from  users where user_cat_id = $user_cat_id";
        $run_user = mysqli_query($con, $user);
        while ($row_user = mysqli_fetch_array($run_user)) {
            $user_id = $row_user['user_id'];
            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];
            $user_reg_date = $row_user['user_reg_date'];
            $user_cat_id = $row_user['user_cat_id'];

            if ($user_cat_id == 1) {
                echo "
            <div class='item mb-5'>
                <h3 class='title mb-1'>ALL CLERKS</h3>
                <hr>  
                <div class='media'>
                    <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
                    <div class='media-body'>
                        <h3 class='title mb-1'><a href= 'user_profile.php?u_id=$user_id'> $user_name</a></h3>
                        <div class='meta mb-1'><span class='date'>MEMBER SINCE:<br><strong> $user_reg_date</strong></div>
                            
                    </div>
                </div>
            </div>";
            } elseif ($user_cat_id == 2) {
                echo "
            <div class='item mb-5'>
                <h3 class='title mb-1'>ALL TEACHERS</h3>
                <hr>
                <div class='media'>
                    <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
                    <div class='media-body'>
                        <h3 class='title mb-1'><a href= 'user_profile.php?u_id=$user_id'> $user_name</a></h3>
                        <div class='meta mb-1'><span class='date'>MEMBER SINCE:<br><strong> $user_reg_date</strong></div>
                            
                    </div>
                </div>
            </div>";
            } elseif ($user_cat_id == 3) {
                echo "
            <div class='item mb-5'>
                <h3 class='title mb-1'>1st Year Students</h3>
                <hr>
                <div class='media'>
                    <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
                    <div class='media-body'>
                        <h3 class='title mb-1'><a href= 'user_profile.php?u_id=$user_id'> $user_name</a></h3>
                        <div class='meta mb-1'><span class='date'>MEMBER SINCE:<br><strong> $user_reg_date</strong></div>
                            
                    </div>
                </div>
            </div>";
            } elseif ($user_cat_id == 4) {
                echo "
            <div class='item mb-5'>
                <h3 class='title mb-1'>2nd Year Students</h3>
                <hr>
                <div class='media'>
                    <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
                    <div class='media-body'>
                        <h3 class='title mb-1'><a href= 'user_profile.php?u_id=$user_id'> $user_name</a></h3>
                        <div class='meta mb-1'><span class='date'>MEMBER SINCE:<br><strong> $user_reg_date</strong></div>
                            
                    </div>
                </div>
            </div>";
            } elseif ($user_cat_id == 5) {
                echo "
            <div class='item mb-5'>
                <h3 class='title mb-1'>3rd Year Students</h3>
                <hr>
                <div class='media'>
                    <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
                    <div class='media-body'>
                        <h3 class='title mb-1'><a href= 'user_profile.php?u_id=$user_id'> $user_name</a></h3>
                        <div class='meta mb-1'><span class='date'>MEMBER SINCE:<br><strong> $user_reg_date</strong></div>
                            
                    </div>
                </div>
            </div>";
            } elseif ($user_cat_id == 6) {
                echo "
            <div class='item mb-5'>
                <h3 class='title mb-1'>Final Year Students</h3>
                <hr>
                <div class='media'>
                    <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src= 'users/$user_image' alt='image'>
                    <div class='media-body'>
                        <h3 class='title mb-1'><a href= 'user_profile.php?u_id=$user_id'> $user_name</a></h3>
                        <div class='meta mb-1'><span class='date'>MEMBER SINCE:<br><strong> $user_reg_date</strong></div>
                            
                    </div>
                </div>
            </div>";
            }
        }
    }
}

//  For displaying all user posts on my_posts.php page
function user_posts()
{
    global $con;
    if (isset($_GET['u_id'])) {
        $u_id =  $_GET['u_id'];
    }
    $get_posts = "select * from posts where user_id = '$u_id' ORDER by 1 DESC";
    $run_posts = mysqli_query($con, $get_posts);
    while ($row = mysqli_fetch_array($run_posts)) {
        $post_id = $row['post_id'];
        $user_id = $row['user_id'];
        $post_image = $row['post_image'];

        $content = $row['post_content'];
        $post_date = $row['post_date'];

        //  Getting the users who have posted the posts
        $user = "Select * from users where user_id = '$u_id' AND posts = 'Yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        //  Now displaying all at once
        echo "
                <div id = posts class = 'border p-2'>
                    <p><img src = 'users/$user_image' width ='50'/></p>
                    <h3><a href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
                    <p>$post_date</p>
                    <p>$content</p>
                    ";
        if ($post_image != "") {
            echo "
                        <div class='intro'><b>An image is attached...</b></div>
            ";
        } elseif ($post_image == "") {
            echo "
                        <div class='intro'>NO IMAGE ATTACHED</div>
            ";
        }
        echo "
                    <a href = 'single.php?post_id=$post_id' style='float: right;'><button class = 'btn btn-primary'>View</button></a>
                    <a href = 'edit_post.php?post_id=$post_id' style='float: right;'><button class = 'btn btn-info'>Edit</button></a>
                    <a href = 'functions/delete_post.php?post_id=$post_id' style='float: right;'><button class = ' btn btn-danger'>Delete</button></a>
                </div></br>
            ";
        include('delete_post.php');
    }
}

//  For user profile
function user_profile()
{
    global $con;
    if (isset($_GET['u_id'])) {
        $u_id =  $_GET['u_id'];
        $select = "select * from users where user_id = '$u_id' ";
        $run = mysqli_query($con, $select);
        $row = mysqli_fetch_array($run);

        $id = $row['user_id'];
        $name = $row['user_name'];
        $email = $row['user_email'];
        $image = $row['user_image'];
        $gender = $row['user_gender'];
        $reg_date = $row['user_reg_date'];
        $last_login = $row['user_last_login'];

        $cat = "SELECT * from  user_details where user_id = '$id'";
        $run_cat = mysqli_query($con, $cat);
        $row_cat = mysqli_fetch_array($run_cat);
        $discipline = $row_cat['discipline'];
        $phone = $row_cat['phone_no'];
        $reg_no = $row_cat['reg_no'];
        $shift = $row_cat['shift'];


        if ($gender = 'MALE') {
            $msg = 'Send him a message';
        } else {
            $msg = 'Send her a message';
        }

        echo "
        <div>
            <table class = 'table'>
                <tr align='center'>
                    <th colspan = 6><p><img src = 'users/$image' width ='150' height = '150'/></p>
                    </th>
                </tr>
                <tr>
                    <th>TITLE:</th>
                    <td><strong>$discipline</strong></td>
                </tr>
                 <tr>
                    <th>NAME:</th>
                    <td><strong>$name</strong></td>
                </tr>
                <tr>
                    <th>PHONE NO:</th>
                    <td><strong>$phone</strong></td>
                </tr>
                <tr>
                    <th>EMAIL:</th>
                    <td><strong>$email</strong></td>
                </tr>
                <tr>
                    <th>GENDER:</th>
                    <td><strong>$gender</strong></td>
                </tr>
                <tr>
                    <th>REG NO:</th>
                    <td><strong>$reg_no</strong></td>
                </tr>
                <tr>
                    <th>SHIFT:</th>
                    <td><strong>$shift</strong></td>
                </tr>
                <tr>
                    <th>MEMBER SINCE:</th>
                    <td><strong>$reg_date</strong></td>
                </tr>
                <tr>
                    <th>LAST LOGIN:</th>
                    <td><strong>$last_login</strong></td>
                </tr>
                <tr align='center'>
                    <td colspan = 6><a href='messages.php?u_id=$id'><button class = 'btn btn-primary'>$msg</button></a></td>
                </tr>
            </table>    
         
        </div>
        ";
    }
}
// for messages & chats
function mymessages()
{
    global $con;
    //  Select all members
    $user_email = $_SESSION['user_email'];
    if (isset($_GET['u_id'])) {
        $u_id =  $_GET['u_id'];
        $user = "SELECT * from  messages where u_id != '$u_id' ORDER by 1 DESC";
        $run_user = mysqli_query($con, $user);
    }
    $user = "SELECT * from  users where user_email != '$user_email'";
    $run_user = mysqli_query($con, $user);
    echo "<br><h2>MESSAGE ANYONE:</h2><hr>";
    while ($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['user_id'];
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        $user_last_login = $row_user['user_last_login'];

        $sel_msg = "Select * from messages where receiver = '$u_id' AND sender = '$user_id' AND status = 'unread' ORDER by 1 DESC";
        $run_msg = mysqli_query($con, $sel_msg);
        $row_user = mysqli_fetch_array($run_msg);
        $msg_text = $row_user['msg_text'];
        if ($run_msg) {
            echo "
        <div class='item mb-5'>
            <a href='messages.php?u_id=$user_id'>
            <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src='users/$user_image' width='110' height='110' title='$user_name' style ='float: left; margin: 2px;'>
            <div class='media-body'>
                    <h3 class='title mb-1'>$user_name</h3>
                    <div class='meta mb-1'><span class='date'>LAST LOGIN: <br><strong> $user_last_login</strong></div>
                    <div class='meta mb-1'>LAST MESSAGE <strong>$msg_text</strong></div>
            </div>
            
            </a>
            <br>
            <br>
            <br>
        </span>";
        }
    }
}

function online_users()
{
    global $con;
    //  Select all members
    $user_email = $_SESSION['user_email'];
    $user = "SELECT * from  users where user_email != '$user_email' and user_last_login = 'ONLINE'";
    $run_user = mysqli_query($con, $user);
    echo "<br><h2>MESSAGE ANYONE:</h2><hr>";
    while ($row_user = mysqli_fetch_array($run_user)) {
        $user_id = $row_user['user_id'];
        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];
        $user_last_login = $row_user['user_last_login'];

        $sel_msg = "Select * from messages where receiver = '$user_id' AND status = 'unread' ORDER by 1 DESC";
        $run_msg = mysqli_query($con, $sel_msg);
        if ($run_msg) {
            echo "
            
        <div class='item mb-5'>
            <a href='messages.php?u_id=$user_id'>
            <img class='mr-3 img-fluid post-thumb d-none d-md-flex' src='users/$user_image' width='110' height='110' title='$user_name' style ='float: left; margin: 2px;'>
            <div class='media-body'>
                    <h3 class='title mb-1'>$user_name</h3>
                    <div class='meta mb-1'><span class='date'>LAST LOGIN: <br><strong> $user_last_login</strong></div>
            </div>
            </a>
            <br>
            <br>
            <br>
        </span>";
        }
    }
}
