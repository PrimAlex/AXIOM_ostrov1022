<?php
	if(isset($_GET['taskform'])) {
		if(!(empty($_GET['name1']) || empty($_GET['name3']) || empty($_GET['email']) || empty($_GET['lefttop']) || empty($_GET['rightbottom']) || !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))) {
		
			$name = strip_tags(htmlspecialchars($_GET['name1']." ".$_GET['name2']." ".$_GET['name3']));
			$email = strip_tags(htmlspecialchars($_GET['email']));
			$lt = strip_tags(htmlspecialchars($_GET['lefttop']));
			$rb = strip_tags(htmlspecialchars($_GET['rightbottom']));
			$text = strip_tags(htmlspecialchars($_GET['comment']));

			$to = "dubos1210@yandex.ru";
			$subject = "Заявка на спутниковые снимки";
			$body = "<b>Имя:</b> ".$name."\r\n<b>E-mail:</b> ".$_GET['email']."\r\n<b>Координаты:</b> ".$lt." ".$rb."\r\nКомментарий:\n".$text;
			$header = "From: noreply@axiom.community\n";
			$header .= "Reply-To: $email";

			mail($to, $subject, $body, $header);
		}
	}
?>

<!DOCTYPE html>
<html lang="ru" >
  <head>
    <meta charset="utf-8">
    <title>AXIOM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="animate.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
    <style TYPE="text/css">
      body,html{
        overflow-x: hidden;
      }

    </style>
  </head>
  <body>
    <header>
      <div class="row">
      <div class="col-sm-6">
        <b><a class="brand color-white" href="#">AXIOM<div style="opacity: 0.2">COMMUNITY</div></a></b>
      </div>

        <div class="col-sm-6 right">
              <a class="btn" onclick="popup('#task')">ОТПРАВИТЬ ЗАЯВКУ</a>
              <a class="btn" onclick="popup('#help')">Как пользоваться?</a>
        </div>
        </div>
    </header>
    <div id="wrapper">
      <div class="content color-black">
        <div class="row" style="position:relative;">
          <!--<div class="col-sm-6">-->
            <span><form><input type="text" name="id" id="task_id" value="<?php if(isset($_GET['id'])) print($_GET['id']) ?>" placeholder="Введите код запроса..."></form></span>
            <!--<div class="select">
                <select>
                    <option value="" disabled selected>Выберите тип карты</option>
                    <option value="fire">Пожар</option>
                </select>
            </div>-->
          <!--</div>-->
          <div class="col-sm-6 right input">
            <!--<span><input type="text" name="kod" id="task_id" placeholder="Введите код запроса..."></span>-->
          </div>
        </div>

        <div class="row">
          <div class="mapblock">
			<?php 
				if(!isset($_GET['id'])) {
			?>
					<img src="maps/blurearth.jpg" id="placeholder">
			<?php
				}
				else {
			?>
					<div class="column col-sm-6"><img src="maps/<?php if(isset($_GET['id'])) print($_GET['id']) ?>_raw.jpg" id="first"></div>
					<div class="column col-sm-6"><img src="maps/<?php if(isset($_GET['id'])) print($_GET['id']) ?>_prc.jpg" id="second"></div>
			<?php
				}
			?>
			
            <!--<span><input class="startinput" type="text" name="kod" placeholder="Введите код запроса..."></span>-->
          </div>
        </div>
        <br>
		
        <div class="row">
			<?php 
				if(isset($_GET['id'])) {
					if(!($file = fopen("maps/".$_GET['id'].".txt", "r"))) die();
			?>
					<div class="table">
						<p><b>ID:</b> <?php print($_GET['id']); ?></p>
						<p><b>Дата/Время:</b> <?php $str = fgets($file); print($str); ?></p>
						<p><b>Description:</b><br/> <?php while($str = fgets($file)) { print($str."<br/>"); } ?></p>
					</div>
			<?php
					fclose($file);						
				}
			?>
        </div>

      </div>
      <footer>

        <div class="row">
          <div class="col-sm-5 socialnetwork">

              <a class="btn-sn" href="https://vk.com/axiom.community">
                <i class="fab fa-fw fa-vk"></i>
              </a>
              <a class="btn-sn" href="https://www.instagram.com/axiom.community/" target="_blank">
                <i class="fab fa-fw fa-instagram"></i>
              </a>

          </div>
          <div class="col-sm-5 copyright">
            <p>Геопортал, <a href="http://ostrov.axiom.community/" class="color-white" target="blank">&copy; AXIOM</a>, 2019,</p>
            <p>geoportal@axiom.community</p>
          </div>
        </div>
      </footer>
    </div>
    <div class="popup" id="task">
      <div class="animated popup_inner">
        <form method="GET">
          <div class="row">
            <div class="col-sm-6">
              <h2>Заявка</h2>
            </div>
            <div class="col-sm-6">
              <h3 style="color: #ccc; text-align:right; cursor: default;" onclick="popdown('#task')">X</h3>
            </div>
          </div>
          <?php if(isset($_GET['id'])) print('<input type="hidden" name="id" value="'.$_GET['id'].'">');?>
          <p><input type="text" name="name1" placeholder="Имя"></p>
          <p><input type="text" name="name2" placeholder="Отчество"></p>
          <p><input type="text" name="name3" placeholder="Фамилия"></p>
          <p><input type="text" name="email" placeholder="E-mail"></p>
          <br>
          <p><input type="text" name="lefttop" placeholder="Введите координаты верхней левой точки нужной области"></p>
          <p><input type="text" name="rightbottom" placeholder="Введите координаты нижней правой точки нужной области"></p>
          <br>
          <p><input type="text" name="comment" placeholder="Комментарий"></p>
          <br>
          <p><input type="submit" name="taskform" value="Отправить заявку" style="width: 50%; margin-left: 25%;"></p>
        </form>
      </div>
    </div>
    <div class="popup" id="help">
      <div class="animated popup_inner">
        <div>
          <div class="row">
            <div class="col-sm-6">
              <h2>Помощь</h2>
            </div>
            <div class="col-sm-6">
              <h3 style="color: #ccc; text-align:right; cursor: default;" onclick="popdown('.popup')">X</h3>
            </div>
          </div>
          <p>Введите код, полученный в электронном письме, в соответстующее поле, затем нажмите <b>Enter</b></p>
          <p>Демонстрационные коды: 1022VPDO, 1022VOKT, 1022DNER, 1022VEOF, 1022VEOV</p>
          <br>
          <p><input type="submit" value="Закрыть" onclick="popdown('#help')" style="width: 50%; margin-left: 25%;"></p>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      /*$("#task_id").keyup(function(event){
          if(event.keyCode == 13){
              event.preventDefault();
              jQuery("img#first").attr("src", "maps/" + $("#task_id").val().replace(" ", "").toUpperCase()+"_raw.jpg");
              jQuery("img#first").css("display", "block");
              jQuery("img#second").attr("src", "maps/" + $("#task_id").val().replace(" ", "").toUpperCase()+"_prc.jpg");
              jQuery("img#second").css("display", "block");

              jQuery(".row .table").css("display", "block");
              jQuery("img#placeholder").css("display", "none");
          }
      });*/

      function popup(id) {
        popdown(".popup");
        jQuery(id + " .popup_inner").removeClass("fadeOutDown");
        jQuery(id).css("display", "block");
        jQuery(id + " .popup_inner").addClass("fadeInDown");
      }
      function popdown(id) {
        jQuery(id + " .popup_inner").removeClass("fadeInDown");
        jQuery(id + " .popup_inner").addClass("fadeOutDown");
      }

      jQuery(document).mouseup(function (e) {
          if (jQuery(".popup").has(e.target).length === 0) {
              popdown(".popup");
          }
          if (jQuery("#task").has(e.target).length === 0) {
              popdown("#task");
          }
      });
    </script>
	<?php
		if(isset($_GET['taskform'])) {
	?>
			<script type="text/javascript">
				jQuery(window).ready(function (e) {
					jQuery("#task").css("display", "block");
					popdown("#task");
				});
			</script>
	<?php
		}
	?>
  </body>
</html>
