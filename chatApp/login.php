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
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="#">
                <div class="error-txt">This is an error massage!</div>
                    <div class="field input">
                        <label>Email address</label>
                        <input type="email" name="email" placeholder="Email address">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to chat">
                    </div>
            </form>
            <div class="link">No yet signed up? <a href="index.php">Signup now</a></div>
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
        let form = document.querySelector('.login form');
        let conBtn = document.querySelector('.button input');
        let err = document.querySelector('.error-txt');
        form.addEventListener('submit', function (e){
            e.preventDefault();
        })
        conBtn.addEventListener('click', function (){
            let xhr = new XMLHttpRequest();
            xhr.open('POST','php/login.php',true);
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
