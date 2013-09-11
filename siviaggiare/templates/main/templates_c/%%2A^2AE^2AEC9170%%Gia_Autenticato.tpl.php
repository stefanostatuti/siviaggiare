<?php /* Smarty version 2.6.26, created on 2013-08-28 09:07:07
         compiled from Gia_Autenticato.tpl */ ?>
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
    <h1>Benvenuto <?php echo $this->_tpl_vars['nome']; ?>
</h1>
    <br>
    <tr>
    <input type="hidden" name="controller" value="registrazione" />
    <input type="hidden" name="task" value="esci" />
    <input type="submit" value="Logout" />
    </tr>
</fieldset>
    </form>


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

<fieldset>
    <br> <b>TEST DI Caricamento LUOGO D'INTERESSE</b>
    <form method="post"
          action="index.php">
        <tr>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />  <-- visualizza i luoghi che hai visitato-->
            <input type="hidden" name="task" value="visualizza_luoghi_inseriti" />
            <input type="submit" value="I tuoi luoghi visitati" />
        </tr>
    </form>
</fieldset>



</body>
</html> 