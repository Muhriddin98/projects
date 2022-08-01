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
        <section class="chat-area">
            <header>
                <?php
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "select * from users where unique_id = {$user_id} ");
                if (mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="images/<?=$row['img']; ?>"" alt="">
                <div class="details">
                    <span><?=$row['fname']." ".$row['lname']; ?></span>
                    <p><?=$row['status']; ?></p>
                </div>
            </header>
            <div class="chat-box">
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="hidden" name="outgoing_id" value="<?=$_SESSION['unique_id'];?>">
                <input type="hidden" name="incoming_id" value="<?=$user_id;?>">
                <input type="text" class="text-input" name="message" placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script>
        let form = document.querySelector('.typing-area');
        let sendBtn = document.querySelector('.typing-area button');
        let inputField = document.querySelector('.text-input');
        let chatBox = document.querySelector('.chat-box');
        form.addEventListener('submit', function (e){
            e.preventDefault();
        })
        function scrollToBottom(){
            chatBox.scrollTop = chatBox.scrollHeight;
        }
        chatBox.addEventListener('mouseenter',function (){
            chatBox.classList.add('active');
        })
        chatBox.addEventListener('mouseleave',function (){
            chatBox.classList.remove('active');
        })
        sendBtn.addEventListener('click', function (){
            let xhr = new XMLHttpRequest();
            xhr.open('POST','php/chat.php',true);
            xhr.onload = function (){
                if (xhr.readyState === XMLHttpRequest.DONE){
                    if (xhr.status === 200){
                        inputField.value = "";
                        scrollToBottom();
                    }
                }
            }
            let formData = new FormData(form);
            xhr.send(formData);
        })
        setInterval(function (){
            let xhr = new XMLHttpRequest();
            xhr.open('POST','php/get-msg.php',true);
            xhr.onload = function () {
                if (xhr.readyState === XMLHttpRequest.DONE){
                    if (xhr.status === 200){
                        let data = xhr.response;
                        chatBox.innerHTML = data;
                        if (!chatBox.classList.contains('active')){
                            scrollToBottom();
                        }
                    }
                }
            }
            let formData = new FormData(form);
            xhr.send(formData);
        }, 100);
    </script>
</body>
</html>
