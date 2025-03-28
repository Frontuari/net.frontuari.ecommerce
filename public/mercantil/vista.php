<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mi página de prueba</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </head>
  <body>
      <div class="container">
        <div class="row ">
            <div class="col-md-12 text-center">
                <img src="../logo.png" width="150" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                Procesadora de pagos para tarjetas de <B>débito</B> del Banco Mercantil<br>
            </div>

        </div>
        <div class="row justify-content-md-center mt-2">
            <div class="col-md-4  ">
<?php
if($htmlFinal){
  echo $htmlFinal.'<br><div class="text-center" id="divBtnPasoA">
'.$boton.'
</div>';
}else{
  ?>

                <form method="get" autocomplete="off" onsubmit="return pasoA()">
                  <div class="row">
                      <div class="col">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nro. de orden:</label><br>
                            <?php echo $_SESSION['nroFactura'];?>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Monto:</label><br>
                            <?php echo formato_numero($_SESSION['amount']);?> Bs.
                          </div>
                      </div>
                  </div>
               


                    <div class="form-group">
                      <label for="exampleInputEmail1">Ingrese el número de su tarjeta:</label>
                      <input <?php echo ($disabled ? '' : 'autofocus'); ?> value="<?php echo $_SESSION['card_number']; ?>" name="card_number"  title="Nro. de tarjeta incorrecto, Debe contener 18 digitos" pattern="^\D*\d{18}$" type="text" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ingrese su número de cedula o Rif:</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <select <?php echo ($disabled ? 'disabled="true"' : ''); ?> name="nacionalidad" style="border:1px solid #ccc"><option <?php if($nacionalidad=='V') echo 'selected'; ?>>V</option><option <?php if($nacionalidad=='J') echo 'selected'; ?> >J</option><option <?php if($nacionalidad=='G') echo 'selected'; ?> >G</option></select>
                            </div>
                            <input <?php echo ($disabled ? 'readonly' : ''); ?> value="<?php echo $_SESSION['cedula']; ?>" name="cedula" title="El nro. de cedula es incorrecto." pattern="^[0-9]+$" required type="text" class="form-control" id="exampleInputPassword1">
                          </div>
                    </div>
                      <?php
                      echo $htmlPasoB;
                      ?>
                      <div id="cargando" class="text-center" ></div>
                    <div class="text-center" id="divBtnPasoA">
                        <?php echo $boton;?>
                    </div>
                  </form>    
<?php
}
?>              
                  

            </div>

        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <br /><br /><hr />https://eosdelivery.com.ar/</div>     
            </div>

        </div>

      </div>


    
  </body>
  <script>
      function pasoA(){
          cargando.innerHTML=`<div class="spinner-border text-success" role="status">
  <span class="sr-only">Cargando...</span>
</div>`;

divBtnPasoA.style.display="none";

return true;
          
      }

  </script>
</html>



