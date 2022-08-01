<?php
error_reporting(0);
session_start();
if (isset($_SESSION['unique_id'])){
    header("location: users.php");
}
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                    <div class="field input">
                        <label>Email address</label>
                        <input type="email" name="email" placeholder="Email address" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>Select image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to chat">
                    </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>
    <script>
        let passFeild = document.querySelector('.form input[type="password"]');
        let toggleBtn = document.querySelector('.fa-eye');
        toggleBtn.addEventListener('click',function (){
            if (passFeild.type == 'password'){
                passFeild.type = 'text';
                toggleBtn.classList.add('active');
            }
            else {
                passFeild.type = 'password';
                toggleBtn.classList.remove('active');
            }
        })
        let form = document.querySelector('.signup form');
        let conBtn = document.querySelector('.button input');
        let err = document.querySelector('.error-txt');
        form.addEventListener('submit', function (e){
            e.preventDefault();
        })
        conBtn.addEventListener('click', function (){
            let xhr = new XMLHttpRequest();
            xhr.open('POST','php/signup.php',true);
            xhr.onload = function (){
                if (xhr.readyState === XMLHttpRequest.DONE){
                    if (xhr.status === 200){
                        let data = xhr.response;
                        if (data == "Success"){
                            location.href = 'users.php';
                        }
                        else {
                            err.textContent = data;
                            err.style.display = "block";
                        }
                    }
                }
            }
            let formData = new FormData(form);
            xhr.send(formData);
        })
    </script>
</body>
</html>
