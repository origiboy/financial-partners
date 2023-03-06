<!DOCTYPE html>
<html>
<head>
 <title>Авторизация</title>
 <style>
  body {
   background-color: #f1f1f1;
   font-family: Arial, sans-serif;
  }
  
  .container {
   margin: 100px auto;
   width: 400px;
   padding: 20px;
   background-color: #fff;
   box-shadow: 0px 0px 10px #ccc;
   border-radius: 5px;
  }
  
  h2 {
   text-align: center;
   color: #333;
   margin-top: 0;
  }
  
  input[type=text], input[type=password] {
   width: 100%;
   padding: 12px 20px;
   margin: 8px 0;
   display: inline-block;
   border: 1px solid #ccc;
   border-radius: 4px;
   box-sizing: border-box;
  }
  
  button {
   background-color: #4CAF50;
   color: white;
   padding: 14px 20px;
   margin: 8px 0;
   border: none;
   border-radius: 4px;
   cursor: pointer;
   width: 100%;
  }
  
  button:hover {
   background-color: #45a049;
  }
  
  .cancelbtn {
   background-color: #f44336;
  }
  
  .imgcontainer {
   text-align: center;
   margin: 24px 0 12px 0;
   position: relative;
  }
  
  img.avatar {
   width: 100px;
   height: 100px;
   border-radius: 50%;
  }
  
  .container > p {
   text-align: center;
  }
  
  span.psw {
   float: right;
   padding-top: 16px;
  }

  .password-error {
    opacity: 0;
    color: red;
  }

  .opacity-full {
    opacity: 1;
  }

 </style>
 <script src="main.js" defer></script>
</head>
<body>
    <form action="../home/" method="post">
        <div class="container">
            <h2>Авторизация</h2>
            <label for="uname">Логин</label>
            <input type="text" placeholder="Введите логин" name="login" required>
            <label for="psw">Пароль</label>
            <input type="password" placeholder="Введите пароль" name="password" required>
            <span class="password-error">Неправильный пароль</span>
            <button type="submit">Войти</button>
        </div>
    </form>
</body>
</html>