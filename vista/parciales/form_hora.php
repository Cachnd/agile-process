<table border="0">
  
  <tr>
  <td>
	<select name="hora<?= $nom?>" id="hora<?= $nom?>">
         <?php
           $cadena;
           for($i = 0; $i <= 23; $i++) {
              if($i < 10) {
                $cadena = "0".$i;
                if($i == $hora) 
                  echo '<option selected="selected">'.$cadena.'</option>';
                else 
                  echo '<option>'.$cadena.'</option>';
             } else {
                $cadena = $i;
                if($cadena == $hora)
                  echo '<option selected="selected">'.$cadena.'</option>';
                else 
                  echo '<option>'.$cadena.'</option>';
             }
           }
         ?>
     </select> Hora
	</td>
  <td>
	 <select name="minuto<?= $nom?>" id="minuto<?= $nom?>">
        <?php
           $cadena;
           for($i = 0; $i <= 59; $i++) {
             if($i < 10) {
                $cadena = "0".$i;
                if($i == $min) 
                  echo '<option selected="selected">'.$cadena.'</option>';
                else 
                  echo '<option>'.$cadena.'</option>';
             } else {
                $cadena = $i;
                if($cadena == $min)
                  echo '<option selected="selected">'.$cadena.'</option>';
                else 
                  echo '<option>'.$cadena.'</option>';
             }
             
             
           }
         ?>
     </select> Min
	</td>
    
  </tr>

</table>
