<?php
include('includes/connection.php');

$query  = "Select * from posts";
$result = mysqli_query($con, $query);

//  Count the total records
$total_posts = mysqli_num_rows($result);

//  Using ceil function to divide the total records on per page
$total_pages = ceil($total_posts / $per_page);

//Going to first page
echo "
        <nav class='blog-nav nav nav-justified my-5'>
                <a class='nav-link-next nav-item nav-link rounded-left' href = 'home.php?page=1'><i class='arrow-prev fas fa-long-arrow-alt-left'></i> First Page</a>
    
    ";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a class='nav-link-next nav-item nav-link' href='home.php?page=$i'>$i</a>";
}
//  Going to last page
echo "<a class='nav-link-next nav-item nav-link rounded-right' href='home.php?page=$total_pages'><i class='arrow-next fas fa-long-arrow-alt-right'></i>Last Page</a>
        
        </nav>";
