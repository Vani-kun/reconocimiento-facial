 <?php
    
    echo '<footer class="footer">
        <div style="margin-bottom:5px;margin-top:5px;">
        <p>&copy; <?php echo date("Y"); ?> <strong>LIVElula</strong> | Instituto Universitario IUJO</p>
        <p>Todos los derechos reservados.</p>
        </div>
        <div style="margin-bottom:5px;margin-top:5px;display:flex">
            <div style="width:33%">
                <div>
                    <h3>Redes del iujo</h3>
                    <ul class="lista-integrantes">
                    
                        <li><a href="https://webiujocatia.wordpress.com" class="nav-link">IUJO Wordpress</a></li>
                        <li><strong>Telf:</strong> (+58-212) 862.71.72</li>       
                        <li><strong>Whatsapp:</strong> (+58-412)0340692</li>          
                        <li><strong>Email:</strong> catiadireccion@iujo.edu.ve</li>   
                    </ul> 
                </div>
            </div>
            <div style="width:33%;margin-top:20px;">
                    <a href="./equipo.php" class="nav-link">About Us</a>
                    <div class="footer-logo-div">
                    <img src="./img/logo-livelula.png" alt="">
                    </div>
            </div>
            <div style="width:33%">
                <h3>Integrantes del Grupo</h3>
                <ul class="lista-integrantes">';          
                    $nombre=["Aaron Garcia","Abrahan Lopez","Anderson Pichardo","Raysmari Suarez",'Yovani Romero'];
                    global $nombre;
                    foreach ($nombre as $n){
                            echo "<li>".$n."</li>";
                            }                   
echo                '</ul>
            </div>
        </div>
        
    </footer>';

?>