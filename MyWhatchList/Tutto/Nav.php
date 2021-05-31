
    <!-- <img src="../Multimedia/Gura.png" alt="Gura Gura" height="60px" width="60px" style="float: left;"> -->
    <div style="padding: 20px; align-items: center;">
        <a href="index.php" class="Pulito up"><img src="../Multimedia/LogoWhite.png" alt="Logo" style="width: 30px; height: 30px;margin-top: -12px;"></a>
        <a href="Anime.php" class="Pulito up" >Anime</a>
        <a href="Animazione.php" class="Pulito up" >Animazione</a>
        <a href="SerieTv.php" class="Pulito up">SerieTV</a>
        <a href="Film.php" class="Pulito up">Film</a>



        <div style="float: right;margin-top:-40px; ">

            <ul>
                <li class="NoBK"><a style="background: none;" href="#"><img src="../CaricareFILE/upload/<?php
                                                                                                        if ($account->getAvatar() != NULL) {
                                                                                                            echo htmlentities($account->getAvatar());
                                                                                                        } else {
                                                                                                            echo "no-avatar.jpg";
                                                                                                        }
                                                                                                        ?>" alt="dio schifo" align=right style="height: 40px;width:40px; object-fit: cover;margin-top:10px" class="SideIco"></a>
                    <ul>
                        <li><a href="AreaUtente.php">Area Utente</a></li>
                        <li><a href="LogOut.php" style="color: red;">Esci</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- barra di ricerca  -->
        <div style="float: right;" class="SearchBar">
            <form method="GET" action="Ricerca.php">
                <input class="SerchBarInp" type="text" name="search" placeholder="Inserisci Titolo" required>
                <input class="SubImg" type="submit" name="submit" id="submit">
            </form>
                <!-- <button name="submit" style=" background:none; border:none;"><img style="width: 15px;height: 15px;margin-bottom:-2px;" src="../Multimedia/Search.png"></button> -->
        </div>
    </div>




