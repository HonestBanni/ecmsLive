<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<meta name="google-site-verification" content="wu677TpTCX3GCAHD5Wcaa-rGJfjLpCKng7-J1Px_Fxc" />
<title>Edwardes College Management System</title>
<base href="<?php echo base_url()?>">
<style>
body {
     background-color: #10331e;
    font-family: Montserrat;
}
.logo{
    width: 613px;
    height: 76px;
    margin: 0px auto;
    text-align: center;
}

.logo h2
    {
        margin-top: 80px;
        color: #fff;    
    }    
    

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #208e4c;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input[type=text],input[type=password] {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url(assets/images/u0XmBmv.png) 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url(assets/images/u0XmBmv.png) 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url(assets/images/Qf83FTt.png) 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url(assets/images/Qf83FTt.png) 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #208e4c;
}

.login-block input[type=submit] {
    width: 100%;
    height: 40px;
    background: #208e4c;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #208e4c;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
    text-align: center;
}

.login-block input[type=submit]:hover {
    background: #208e4c;
}

</style>
</head>

<body>

<div class="logo">
<h2>Edwardes College Management System (ECMS)</h2>    
    </div>
<div class="login-block">
    <h1>Login</h1>
         <?php          
        $messge = $this->session->flashdata('message');
        if(!empty($messge)):
            '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
            <strong>Login ERROR !</strong> <br/>'.$this->session->flashdata('message').'
            </div>'; 
        endif;
        ?>
    <form method="post" action="proctorAuth">
        <input type="text"placeholder="College #" name="college_no" id="username" />
        <input type="password" placeholder="Password" name="password" id="password" />
        <input type="submit"value="Login">
    </form>    
</div>
 

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Normal Add -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-7013947188644112"
     data-ad-slot="9481446782"></ins>
 
</body>

</html>