<?php require_once "db.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="img/logo2.jpg">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adstyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <script src="https://kit.fontawesome.com/3baf712733.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>



    <!-------------------navbar------------------------------->
            <nav>
                 <a href=""><h1>St. Mary's College</h1></a>
                 <ul id="sidemenu">
                    <li><a class="xx" href="index.php"><button class="btn"><i class="fa-solid fa-globe"></i> View&nbsp;Site</button></a></li>
                    <li><a class="xx" href="#"><button class="btn" name="logout"><i class="fa-solid fa-power-off"></i> Logout</button></a></li>
                 </ul>
            </nav>

            <div id="wrapper">
                <div class="body-container">
                    <div class="sidebar">
                        <div class="profile-logo">
                            <img src="img/logo2.jpg" alt="">
                            <div class="profile-user">
                                <h1>Admin</h1>
                                <p><i class="fa-solid fa-circle"></i> Online</p>
                            </div>
                        </div>
                        <h3>Navigation</h3>
                        <ul>
                           <li class="sidebar1 active-link" onclick="opentab('dash')"><a href="#"><i class="fa-solid fa-gauge"></i> Dash Board</a></li>
                           <li class="sidebar1 dropnews" onclick="opentab('news')"><a href="#"><i class="fa-solid fa-newspaper"></i> News</a></li>
                           <li class="sidebar1" onclick="opentab('manage')"><a href="#"><i class="fa-solid fa-list-check"></i> Management Team</a></li>
                           <li class="sidebar1" onclick="opentab('feed')"><a href="#"><i class="fa-solid fa-comment" ></i> FeedBack</a></li>
                           <li class="sidebar1" onclick="opentab('user')"><a href="#"><i class="fa-solid fa-user" ></i> User</a></li>
                        </ul>
                    </div>
                    <div class="sidepanel">
                        <div class="container">
                            <div class="sidepanel1 active-tab" id="dash">
                                <div class="dash-header">
                                    <p>Welcome</p>
                                    <h1>Admin Panel</h1>
                                    <p>St. Mary's College</p>
                                </div>
                                <div class="dash-body">
                                    <div class="tag1">
                                        <div class="tag1-wrapper1">
                                            <div id="clock">
                                                <h1 id="date-time"></h1>
                                                <i class="fa-solid fa-clock"></i>
                                            </div>
                                        </div>
                                        <div class="tag1-wrapper2">
                                            <img src="img/logowhite.png" alt="">
                                        </div>
                                    </div>
                                    <div class="tag2">
                                          <img src="img/control.svg" alt="">
                                        <p>Control Your Web Site Using Admin Panel...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="sidepanel1 news-panel" id="news">
                                <h1 class="news-head">NEWS</h1>

                                <div class="news-body1">
                                    <div class="addnews">
                                        <h1>Add News</h1>
                                        
                                           <?php 
        
                                              if(isset($_POST['news-submit']))
                                              {
                                              $news_title = $_POST['n-title'];
                                              $news_des = $_POST['n-des'];
                                              $news_author = $_POST['n-author'];
                                              $news_date = date('m-d-y');

                                              $news_img = $_FILES['n-img']['name'];
                                              $news_temp = $_FILES['n-img']['tmp_name'];

                                              $sql = "insert into news (news_img, news_title, news_des, news_author, 
                                              news_date) values('$news_img', '$news_title', '$news_des', '$news_author', '$news_date')";

                                              $result = mysqli_query($con,$sql);
                                              if($result)
                                              {
                                                  echo "Successfully Posted";
                                                  move_uploaded_file($news_temp,"img/$news_img");
                                              }
                                              else
                                              {
                                                  echo "Failed";
                                              }

                                              

                                              }
                                          ?>
                               

                                  
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="text" name="n-title" placeholder="Title">
                                            <textarea name="n-des"cols="6" placeholder="Description"></textarea>
                                            <input type="text" name="n-author" placeholder="Author">
                                            <input type="date" name="n-date" placeholder="DD/MM/YYYY">
                                            <input type="file" name="n-img" placeholder="Image" class="file">
                                            <p>Maxximum File Size 1Mb & Image Resolution 300 x 300</p>
                                            <div class="news-buttons">
                                            <button class="news-btn" type="submit" name="news-submit" >Submit</button>
                                            <button class="news-btn" type="reset">Reset</button>
                                            </div>
                                        </form>
                        
                                    </div>
                                    <div class="editnews">
                                        <h1>updaet nws</h1>
                                    </div>
                                </div>
                                <div class="news-body2">
                                    <h1>NEWS CONTROL SECTION</h1>
                                    <section>
                                        <!--for demo wrap-->
                                        <div class="tbl-header">
                                          <table cellpadding="0" cellspacing="0" border="0">
                                            <thead>
                                              <tr>
                                                <th>Title</th>
                                                <th>Disription</th>
                                                <th>Author</th>
                                                <th>Date</th>
                                                <th colspan="2">Options</th>
                                              </tr>
                                            </thead>
                                          </table>
                                        </div>
                                        <div class="tbl-content">
                                          <table cellpadding="0" cellspacing="0" border="0">
                                            <tbody>

                                            <?php 

                                              $query = "select * from news";
                                              $data = mysqli_query($con,$query);

                                              while($row = mysqli_fetch_assoc($data))
                                              {
                                                  $news_title = $row['news_title'];
                                                  $news_des = $row['news_des'];
                                                  $news_author = $row['news_author'];
                                                  $news_date = $row['news_date'];
                                            ?>
                                              <tr>
                                                <td><?php echo "$news_title" ?></td>
                                                <td><?php echo "$news_des" ?></td>
                                                <td><?php echo "$news_author" ?></td>
                                                <td><?php echo "$news_date" ?></td>
                                                <td class="edit"><i class="fa-solid fa-pen-to-square"></i></td>
                                                <td class="del"><i class="fa-solid fa-trash"></i></td>
                                              </tr>
                                              
                                            <?php
                                              }
                                            ?>

                                            </tbody>
                                          </table>
                                        </div>
                                      </section>
                                </div>
                            </div>

                            <div class="sidepanel1 man-panel" id="manage">
                                <h1 class="man-head">MANAGEMENT TEAM</h1>

                                <div class="man-body1">
                                    <div class="addman">
                                        <h1>Add Management Team</h1>

                                        <?php
                                          if(isset($_POST['mem-submit']))
                                              {
                                              $mem_name = $_POST['m-name'];
                                              $mem_des = $_POST['m-des'];
                                              $mem_date = date('m-d-y');

                                              $mem_img = $_FILES['m-img']['name'];
                                              $mem_temp = $_FILES['m-img']['tmp_name'];

                                              $sql = "insert into management (mem_img, mem_name, mem_des, 
                                              join_date) values('$mem_img', ' $mem_name', '$mem_des', '$mem_date')";

                                              $result = mysqli_query($con,$sql);
                                              if($result)
                                              {
                                                  echo "New Member Successfully Added";
                                                  move_uploaded_file($mem_temp,"img/$mem_img");
                                              }
                                              else
                                              {
                                                  echo "Failed";
                                              }

                                              

                                              }
                                          ?>


                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="text" name="m-name" placeholder="Name">
                                            <textarea name="m-des"cols="6" placeholder="Description"></textarea>
                                            <input type="date" name="join-date" placeholder="DD/MM/YYYY">
                                            <input type="file" name="m-img" placeholder="Image" class="file">
                                            <p>Maxximum File Size 1Mb & Image Resolution 140 x 140</p>
                                            <div class="news-buttons">
                                            <button class="man-btn" type="submit" name="mem-submit">Submit</button>
                                            <button class="man-btn" type="reset">Reset</button>
                                            </div>
                                        </form>
                        
                                    </div>
                                    <div class="editman">
                                        <h1>Update Management Team</h1>
                                    </div>
                                </div>

                                <div class="news-body2">
                                    <h1>MANAGEMENT TEAM CONTROL SECTION</h1>
                                    <section>
                                        <!--for demo wrap-->
                                        <div class="tbl-header">
                                          <table cellpadding="0" cellspacing="0" border="0">
                                            <thead>
                                              <tr>
                                                <th>Title</th>
                                                <th>Disription</th>
                                                <th>Date</th>
                                                <th colspan="2">Options</th>
                                              </tr>
                                            </thead>
                                          </table>
                                        </div>
                                        <div class="tbl-content">
                                          <table cellpadding="0" cellspacing="0" border="0">
                                            <tbody>

                                            <?php 

                                                $query = "select * from management";
                                                $data = mysqli_query($con,$query);

                                                while($row = mysqli_fetch_assoc($data))
                                                {
                                                    $mem_name = $row['mem_name'];
                                                    $mem_des = $row['mem_des'];
                                                    $join_date = $row['join_date'];
                                            ?>
                                              <tr>
                                                <td><?php echo "$mem_name" ?></td>
                                                <td><?php echo "$mem_des" ?></td>
                                                <td><?php echo "$join_date" ?></td>
                                                <td class="edit"><i class="fa-solid fa-pen-to-square"></i></td>
                                                <td class="del"><i class="fa-solid fa-trash"></i></td>
                                              </tr>

                                              <?php
                                                }
                                              ?>


                                            </tbody>
                                          </table>
                                        </div>
                                      </section>
                                </div>
                            </div>

                            <div class="sidepanel1 feed-panel" id="feed">
                                <h1 class="feed-head">Feedback</h1>
                                <div class="feed-table">
                                    <div class="news-body2">
                                        <section>
                                            <!--for demo wrap-->
                                            <div class="tbl-header">
                                              <table cellpadding="0" cellspacing="0" border="0">
                                                <thead>
                                                  <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th colspan="2">Options</th>
                                                  </tr>
                                                </thead>
                                              </table>
                                            </div>
                                            <div class="tbl-content">
                                              <table cellpadding="0" cellspacing="0" border="0">
                                                <tbody>

                                                <?php 

                                                  $query = "select * from feedback";
                                                  $data = mysqli_query($con,$query);

                                                  while($row = mysqli_fetch_assoc($data))
                                                  {
                                                      $com_name = $row['com_name'];
                                                      $com_email = $row['com_email'];
                                                      $com_mes = $row['com_mes'];
                                                ?>


                                                  <tr>
                                                    <td><?php echo $com_name ?></td>
                                                    <td><?php echo $com_email ?></td>
                                                    <td><?php echo $com_mes ?></td>
                                                    <td class="edit"><i class="fa-solid fa-pen-to-square"></i></td>
                                                    <td class="del"><i class="fa-solid fa-trash"></i></td>
                                                  </tr>
                                                <?php
                                                  }
                                                ?>
                                                </tbody>
                                              </table>
                                            </div>
                                          </section>
                                    </div>
                                </div>
                            </div>

                            <div class="sidepanel1 user-panel" id="user">
                                <h1 class="user-head">USERS</h1>
                                <div class="user-table">
                                    <div class="news-body2">
                                        <section>
                                            <!--for demo wrap-->
                                            <div class="tbl-header">
                                              <table cellpadding="0" cellspacing="0" border="0">
                                                <thead>
                                                  <tr>
                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No</th>
                                                    <th>Password</th>
                                                    <th colspan="2">Options</th>
                                                  </tr>
                                                </thead>
                                              </table>
                                            </div>
                                            <div class="tbl-content">
                                              <table cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                  <tr>
                                                    <td>AAC</td>
                                                    <td>AUSTRALIAN COMPANY </td>
                                                    <td>AUSTRALIAN </td>
                                                    <td>$1.38</td>
                                                    <td class="edit"><i class="fa-solid fa-pen-to-square"></i></td>
                                                    <td class="del"><i class="fa-solid fa-trash"></i></td>
                                                  </tr>
                                                  <tr>
                                                    <td>AAC</td>
                                                    <td>AUSTRALIAN COMPANY </td>
                                                    <td>AUSTRALIAN </td>
                                                    <td>$1.38</td>
                                                    <td class="edit"><i class="fa-solid fa-pen-to-square"></i></td>
                                                    <td class="del"><i class="fa-solid fa-trash"></i></td>
                                                  </tr>
                                                  <tr>
                                                    <td>AAC</td>
                                                    <td>AUSTRALIAN COMPANY </td>
                                                    <td>AUSTRALIAN </td>
                                                    <td>$1.38</td>
                                                    <td class="edit"><i class="fa-solid fa-pen-to-square"></i></td>
                                                    <td class="del"><i class="fa-solid fa-trash"></i></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                          </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            



            <script>

                var tablinks = document.getElementsByClassName("sidebar1");
                var tabcontents = document.getElementsByClassName("sidepanel1");
        
                function opentab(tabname){
                    for(tablink of tablinks){
                        tablink.classList.remove("active-link")
                    }
                    for(tabcontent of tabcontents){
                        tabcontent.classList.remove("active-tab")
                    }
                    event.currentTarget.classList.add("active-link");
                    document.getElementById(tabname).classList.add("active-tab");
                }
        
            </script>
<script src="adscript.js"></script>   
</body>
</html>