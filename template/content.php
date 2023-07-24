<style>
    #form2 {
        float: right;
        margin: 20px;
    }

    #form2 input {
        width: 250px;
        height: 20px;
        padding: 10px;
        border: 1px solid black;
        border-radius: 5px;
    }

    #form2 select {
        width: 270px;
        padding: 10px;
        border: 1px solid black;
        border-radius: 5px;
    }

    #form2 button {
        width: 270px;
        padding: 10px;
        border: 1px solid black;
        border-radius: 5px;
        margin-left: 75px;
    }

    #form2 button:hover {
        background: black;
        color: white;
    }

    #form2 h2 {
        padding: 30px;
        margin-left: 50px;
        font-family: Comic Sans MS;
    }

    footer {
        width: 100%;
        height: 50px;
        padding: 10px;
        border-top: 5px solid brown;
        clear: both;
        background: #1e90ff;
    }

    footer h2 {
        padding: 10px;
        margin-top: 20px;
        font-size: 2em;
        color: white;
        text-align: center;
    }
</style>
<!-- content starts here -->
<div class="content">
    <div>
        <img src="images/g5.jpg" alt="" style="float: left; margin-top: 5%; margin-bottom: 5%;  width: 50%;">
    </div>
    <div>
        <form action="" method="POST" id="form2">
            <h2>SIGN UP HERE!</h2>
            <table>
                <tr>
                    <td align="right"><strong>NAME:</strong></td>
                    <td><input type="text" name="u_name" required="required" placeholder="Enter Name"></td>
                </tr>
                <tr>
                    <td align="right"><strong>PASSWORD:</strong></td>
                    <td><input type="password" name="u_pass" required="required" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td align="right"><strong>EMAIL:</strong></td>
                    <td><input type="email" name="u_email" required="required" placeholder="Enter Email"></td>
                </tr>
                <tr>
                    <td align="right"><strong>COUNTRY:</strong></td>
                    <td>
                        <select name="u_country">
                            <option>Select a country</option>
                            <option>Afghanistan</option>
                            <option>Pakistan</option>
                            <option>Japan</option>
                            <option>India</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><strong>GENDER:</strong></td>
                    <td>
                        <select name="u_gender">
                            <option>Select a gender</option>
                            <option>MALE</option>
                            <option>FEMALE</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><strong>BIRTHDAY:</strong></td>
                    <td><input type="date" name="u_birthday" required="required"></td>
                </tr>
                <tr>
                    <td colspan="6"><button name="sign_up">SIGN UP</button></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    include("insert_user.php");
    ?>

</div>
<!-- content ends here -->