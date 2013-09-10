<?php /* Smarty version 2.6.26, created on 2013-08-28 09:04:01
         compiled from viaggio_dettagli_luogo.tpl */ ?>
<html>
<head>
    <title>YesYouTravel - Visualizzazione luoghi inseriti</title>

</head>
<body>
<fieldset>
<legend>Viaggio <?php echo $this->_tpl_vars['id']; ?>
 </legend>
<table cellpadding="5">

    <tr>
        <td> Nome: <?php echo $this->_tpl_vars['nome']; ?>
 </td>
    </tr>
    <tr>
        <td> Citt&agrave;: <?php echo $this->_tpl_vars['citta']; ?>
 </td>
    </tr>
    <tr>
        <td> Sito Web: <?php echo $this->_tpl_vars['sitoweb']; ?>
 </td>
    </tr>
    <tr>
        <td> Percorso: <?php echo $this->_tpl_vars['percorso']; ?>
 </td>
    </tr>
    <tr>
        <td> Costo del Biglietto: <?php echo $this->_tpl_vars['costobiglietto']; ?>
 </td>
    </tr>
    <tr>
        <td> Guida Turistica: <?php echo $this->_tpl_vars['guida']; ?>
 </td>
    </tr>
    <tr>
        <td> Coda: <?php echo $this->_tpl_vars['coda']; ?>
 </td>
    </tr>
    <tr>
        <td> Durata Visita: <?php echo $this->_tpl_vars['durata']; ?>
 </td>
    </tr>
    <tr>
        <td> Commento Personale: <?php echo $this->_tpl_vars['commento']; ?>
 </td>
    </tr>
    </table>
    </fieldset>
<br>
<br>
    <table>
        <tr>
            <td>
                <form method="post"action="index.php">
                <input type="hidden" name="controller" value="aggiunta_viaggio" />
                <input type="hidden" name="task" value="visualizza_luoghi_inseriti" />
                <input type="submit" value="Indietro" />
                </form>
            </td>
            <td></td>
            <td>
                <form method="post" action="index.php">
                <input type="submit" value="Home" />
                </form>
            </td>
        </tr>
    </table>
</body>
</html>