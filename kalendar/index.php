<style>
    *{
        font-family: Arial;
    }
    .box{
        width: 300px;
        margin: auto;
        margin-top: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 1px solid black;
        border-radius: 10px;
        background-color: #DDDDDD;
    }
    form label{
        font-size: 20px;
    }
    form input{
        width: 150px;
        height: 30px;
        font-size: 18px;
    }
    button{
        background-color: white;
        border: 1px solid black;
        cursor: pointer;
        border-radius: 5px;
        width: 75px;
        height: 25px;
        font-size: 15px;
    }
</style>
<div class="box">
    <h2>Calendar</h2>
    <form action="kalendar.php" method="post">
        <label for="yil">Yil:</label>
        <input type="number" name="year" id="yil" min="1975" max="2095" required>
        <br><br>
        <label for="oy">Oy:</label>
        <input type="number" name="month" id="oy" min="1" max="12" required>
        <br><br>
        <button type="submit">Yuborish</button>
    </form>
</div>

