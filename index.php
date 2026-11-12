<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liderhomes</title>
    <link rel="stylesheet" href="form.css">  
</head>
<body>

    <div id="clouds">
        <div class="cloud x1"></div>
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
    </div>

    <div class="container">

        <!-- Форма для логина -->
        <div id="login">
            <form action="login.php" method="post">
                <fieldset class="clearfix">
                    <p><span class="fontawesome-user"></span>
                    <input name="login" placeholder="Username" type="text" required></p> 
                    <p><span class="fontawesome-lock"></span>
                    <input name="password" placeholder="Password" type="password" required></p>
                    <p><input type="submit" value="Войти"></p>
                </fieldset>
            </form>

            <p>Not a member? <a href="#" class="blue" id="showRegister">Sign up now</a><span class="fontawesome-arrow-right"></span></p>
        </div> 
        <!-- Форма для регистрации -->
        <div id="register" style="display:none;">
            <form action="register.php" method="post">
                <fieldset class="clearfix">
                    <p><span class="fontawesome-user"></span>
                    <input type="text" placeholder="Firstname" name="firstname" required></p>
                    <p><span class="fontawesome-user"></span>
                    <input type="text" placeholder="Lastname" name="lastname" required></p>
                    <p><span class="fontawesome-user"></span>
                    <input type="text" placeholder="Login" name="login" required></p>
                    <p><span class="fontawesome-envelope"></span>
                    <input type="email" placeholder="Email" name="email" required></p> <!-- Поле для электронной почты -->
                    <p><span class="fontawesome-lock"></span>
                    <input type="password" placeholder="Password" name="password" required></p>
                    <p><input type="submit" value="Зарегистрироваться"></p>
                </fieldset>
            </form>
            <p>Already a member? <a href="#" class="blue" id="showLogin">Login now</a><span class="fontawesome-arrow-right"></span></p>
        </div>

    </div>
<script>
    document.getElementById('showRegister').addEventListener('click', function(event) {
              event.preventDefault(); // Предотвращаем переход по ссылке
              document.getElementById('login').style.display = 'none'; // Скрываем форму входа
              document.getElementById('register').style.display = 'block'; // Показываем форму регистрации
    });

          document.getElementById('showLogin').addEventListener('click', function(event) {
              event.preventDefault(); // Предотвращаем переход по ссылке
              document.getElementById('register').style.display = 'none'; // Скрываем форму регистрации
              document.getElementById('login').style.display = 'block'; // Показываем форму входа
          });
      </script>
  </body>
</html>
