<div class="content" id="form_journey">
    <div class="form_settings">
        <h3>Il luogo &egrave; stato inserito</h3>
        <br>
        <form method="post" action="index.php">
            <h4>Se vuoi inserire un altro luogo visitato:</h4>
 
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="inserimento_luogo" />
            <input type="submit" class="submit"value="Altro Luogo" id="j_submit"/>
        </form>
        
        <h4>Oppure se vuoi inserire un' altra citt&agrave; visitata:</h4>
        <form method="post" action="index.php"> 
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="inserimento_citta" />
            <input type="submit" class="submit"value="Altra citta" id="j_submit"/>
        </form>
        <br>
        <h5>Oppure torna alla <a href>Home</a></h5>
    </div>
</div>