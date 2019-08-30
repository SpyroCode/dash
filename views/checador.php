<div class="login-page">
            <div class="form">
                <img src="<?=base_url?>img/logos/logo_credicor-blanco.png" alt="">

                <form class="login-form" method="POST" action="<?=base_url?>checador/index">

                    <input type="text" required="true" name="pws" id="pws" />
                    <button>Registrar</button>


                </form>

            </div>
            <div class="row">
                <div id="content" class="col-lg-12">
                    <div class="date">
                        <span id="weekDay" class="weekDay"></span>,
                        <span id="day" class="day"></span> de
                        <span id="month" class="month"></span> del
                        <span id="year" class="year"></span>
                    </div>
                    <div class="clock">
                        <span id="hours" class="hours"></span> :
                        <span id="minutes" class="minutes"></span> :
                        <span id="seconds" class="seconds"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Bloque de anuncios adaptable -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6676636635558550"
                        data-ad-slot="8523024962" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        <?php
            
            if($_SESSION['message']=='SUCCESS'){
                if($_SESSION['tipo']=='E'){
                    $saludo='Bienvenido';
                }elseif($_SESSION['tipo']=='S'){
                    $saludo='Nos vemos cuidate';
                }
                echo "<div class='alert alert-success'>";
                echo "    <strong>".$saludo." </strong><br> ";
                echo "    <strong>".$_SESSION['personal']."</strong><br> ";
                echo "</div>";
            }elseif ($_SESSION['message']=='FAILED') {
                echo "<div class='alert alert-danger'>";
                echo "    <strong>Occurrio un Error! Favor de Volver a Probar</strong> ";
                echo "</div>";
            }else{
                echo "<div class='alert alert-info'>";
                echo "    <strong>Favor de Deslizar su tarjeta</strong> ";
                echo "</div>";
            }
            unset($_SESSION['message']);  
            unset($_SESSION['personal']);  
            unset($_SESSION['time']);  
            unset($_SESSION['tipo']); 
        ?>    
</div>