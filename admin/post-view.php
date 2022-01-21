<table class="table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                </tr>
                            </thread>
                            <tbody>
                                <?php 
                                
    $query = "SELECT * FROM posts ";
    $select_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_type_id = $row['post_type_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_date = $row['post_date'];

        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_title}</td>";

        $query = "SELECT * FROM event_type WHERE type_id = {$post_type_id}";
        $select_type_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_type_id)){
            $type_id = $row['type_id'];
            $type_name = $row['type_name'];



        echo "<td>{$type_name}</td>";

        }

        echo "<td>{$post_status}</td>";
        echo "<td><img width='100px'src='../images/{$post_image}' alt='image'</td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td align='center'><a href='posts.php?source=edit_post&p_id={$post_id}'><span class='fa fa-edit btn btn-info'></span></a>
        <a href='posts.php?delete={$post_id}'><span class='fa fa-trash btn btn-danger'></span></a></td>";
        echo "</tr>";


    }
                                
                                ?>

                            </tbody>
                        </table>

                        <?php 
                        
                        if(isset($_GET['delete'])){
                            $the_post_id = $_GET['delete'];

                            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                            $delete_query = mysqli_query($connection, $query);

                        }
                        
                        
                        
                        
                        ?>