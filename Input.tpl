<html>
<head>
   <title>Form per calcolo Codice Fiscale</title>

</head>
<body>

<form method="post"
      action="index.php?task=submit">

<fieldset>
 <legend>Form:</legend>  

   <fieldset>
   <legend>Dati Personali:</legend>   
     <table cellpadding="5">

      <tr> 
        <td align="right"> Cognome: </td>
        <td> <input type="text" name="cognome" size=10 style="width:100px"/></td>
      </tr>

      <tr>
        <td align="right"> Nome: </td>
        <td> <input type="text" name="nome" size=10 style="width:100px"/> </td>
      </tr>

      <tr>
        <td align="right"> Data di Nascita: </td>
        <td> <select name="giorno" style="width:100px">
                        <optgroup label="giorno">
                        <option value="01"> 1 </option>
                    	<option value="02"> 2 </option>
			<option value="03"> 3 </option>
                    	<option value="04"> 4 </option>
                    	<option value="05"> 5 </option>
                    	<option value="06"> 6 </option>
			<option value="07"> 7 </option>
                    	<option value="08"> 8 </option>
                    	<option value="09"> 9 </option>
                    	<option value="10"> 10 </option>
			<option value="11"> 11 </option>
                    	<option value="12"> 12 </option>
                    	<option value="13"> 13 </option>
                    	<option value="14"> 14 </option>
			<option value="15"> 15 </option>
                    	<option value="16"> 16 </option>
			<option value="17"> 17 </option>
                    	<option value="18"> 18 </option>
			<option value="19"> 19 </option>
                    	<option value="20"> 20 </option>
                    	<option value="21"> 21 </option>
                    	<option value="22"> 22 </option>
			<option value="23"> 23 </option>
                    	<option value="24"> 24 </option>
                    	<option value="25"> 25 </option>
                    	<option value="26"> 26 </option>
			<option value="27"> 27 </option>
                    	<option value="28"> 28 </option>
                    	<option value="29"> 29 </option>
                    	<option value="30"> 30 </option>
			<option value="31"> 31 </option>
                       
                        
            </select>
	</td>
	<td> <select name="mese" style="width:100px">
                <optgroup label="mese">
                    	<option value="01"> Gennaio </option>
                    	<option value="02"> Febbraio </option>
			<option value="03"> Marzo </option>
                    	<option value="04"> Aprile </option>
                    	<option value="05"> Maggio </option>
                    	<option value="06"> Giugno </option>
			<option value="07"> Luglio </option>
                    	<option value="08"> Agosto </option>
                    	<option value="09"> Settembre </option>
                    	<option value="10"> Ottobre </option>
			<option value="11"> Novembre </option>
                    	<option value="12"> Dicembre </option>
                    	</td>
             </select>
	<td> <select name="anno" style="width:100px">
                <optgroup label="anno">
			<option value="1970"> 1970 </option>
                    	<option value="1971"> 1971 </option>
			<option value="1972"> 1972 </option>
                    	<option value="1973"> 1973 </option>
                    	<option value="1974"> 1974 </option>
                    	<option value="1975"> 1975 </option>
			<option value="1976"> 1976 </option>
                    	<option value="1977"> 1977 </option>
                    	<option value="1978"> 1978 </option>
                    	<option value="1979"> 1979 </option>
                    	<option value="1980"> 1980 </option>
                    	<option value="1981"> 1981 </option>
			<option value="1982"> 1982 </option>
                    	<option value="1983"> 1983 </option>
                    	<option value="1984"> 1984 </option>
                    	<option value="1985"> 1985 </option>
			<option value="1986"> 1986 </option>
                    	<option value="1987"> 1987 </option>
                    	<option value="1988"> 1988 </option>
                    	<option value="1989"> 1989 </option>
			<option value="1990"> 1990 </option>
                    	<option value="1991"> 1991 </option>
			<option value="1992"> 1992 </option>
                    	<option value="1993"> 1993 </option>
                    	<option value="1994"> 1994 </option>
                    	<option value="1995"> 1995 </option>
			<option value="1996"> 1996 </option>
                    	<option value="1997"> 1997 </option>
			<option value="1998"> 1998 </option>
                    	<option value="1999"> 1999 </option>
              </select>
	</td>
	</tr>
      <tr>
        <td align="right"> Sesso: </td>
        <td> F <input type="radio"
     	              name="sesso" value="F" />
             M <input type="radio"
                      name="sesso" value="M"
		      checked />
	</td>
        </tr>
	<tr>
        <td align="right"> Citt&agrave: </td>
        <td> <input type="text" name="citta" size=5 style="width:100px"/> </td>
        </tr>
	<tr>
        <td align="right"> Provincia: </td>
        <td> <input type="text" name="provincia" size=5 style="width:100px" maxlength=2/> </td>
        </tr>

	</table>
        </fieldset>
	<fieldset>
	<legend>Invio Dati:</legend>
		<table cellpadding="5">
		<tr>
        	<td> <input type="submit" value="invia dati" /> </td>
        	<td> <input type="reset" value = "reset" /> </td>
     		</tr>

   </table>
   </fieldset>


</form> 


</body>
</html>



