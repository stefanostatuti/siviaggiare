<html>

<head>
    <title>YesYouTravel - Login effettuato</title>
</head>

<body>
<form method="post"
      action="index.php">
<fieldset>
    <br>
    <br>
    <h1>Benvenuto {$nome}</h1>
    <br>
    <tr>
    <input type="hidden" name="controller" value="registrazione" />
    <input type="hidden" name="task" value="esci" />
    <input type="submit" value="Logout" />
    </tr>
</fieldset>
    </form>
<p><a href="?controller=false&task=false">Torna alla Home</a></p>


<fieldset>
    <br> <b>TEST DI INSERIMENTO VIAGGIO</b>
    <form method="post"
          action="index.php">
    <tr>
    <input type="hidden" name="controller" value="aggiunta_viaggio" />  <-- aggiunta di viaggio, PDI-->
    <input type="hidden" name="task" value="inserimento_viaggio" />
    <input type="submit" value="Inserisci nuovo viaggio" />
    </tr>
    </form>
</fieldset>

<fieldset>
    <br> <b>TEST DI CARICAMENTO VIAGGIO</b>
    <form method="post"
          action="index.php">
        <tr>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />  <-- visualizza tutti i VIAGGI, PDI-->
            <input type="hidden" name="task" value="viaggi_personali" />
            <input type="submit" value="clicca per vedere i tuoi viaggi" />
        </tr>
    </form>
</fieldset>



</body>
</html> 