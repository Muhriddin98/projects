<?php
    error_reporting(0);
    session_start();
    include_once "php/config.php";
    if (!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                $sql = mysqli_query($conn, "select * from users where unique_id = {$_SESSION['unique_id']} ");
                if (mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <div class="content">
                    <img src="images/<?=$row['img']; ?>" alt="">
                    <div class="details">
                        <span><?=$row['fname']." ".$row['lname']; ?></span>
                        <p><?=$row['status']; ?></p>
                    </div>
                </div>
                <a href="./php/logout.php?logout_id=<?=$row['unique_id'];?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="user-list">
            </div>
        </section>
    </div>
    <script>
        let searchBar = document.querySelector('.users .search input');
        let searchBtn = document.querySelector('.users .search button');
        let userList = document.querySelector('.users .user-list')
        searchBtn.addEventListener('click',function (){
            searchBar.classList.toggle('active');
            searchBar.focus();
            searchBtn.classList.toggle('active');
            searchBar.value = "";
        });
        searchBar.addEventListener('keyup', function (){
            let searchTerm = searchBar.value;
            if (searchTerm != ""){
                searchBar.classList.add("active")
            }
            else {
                searchBar.classList.remove("active");
            }
            let xhr = new XMLHttpRequest();
            xhr.open('POST','php/search.php',true);
            xhr.onload = function (){
                if (xhr.readyState === XMLHttpRequest.DONE){
                    if (xhr.status === 200){
                        let data = xhr.response;
                        userList.innerHTML = data;
                    }
                }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("searchTerm=" + searchTerm);
        })
        setInterval(function (){
            let xhr = new XMLHttpRequest();
            xhr.open('GET','php/users.php',true);
            xhr.onload = function (){
                if (xhr.readyState === XMLHttpRequest.DONE){
                    if (xhr.status === 200){
                        let data = xhr.response;
                        if (!searchBar.classList.contains("active")){
                            userList.innerHTML = data;
                        }
                    }
                }
            }
            xhr.send();
        }, 500);
    </script>
</body>
</html>
