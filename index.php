<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Arbol UD</title>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="./css/styles.css"  />
        <!-- BOOTSTRAP-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--==========-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script src="./js/sistematizacion/children.js"></script>
        <script src="./js/sistematizacion/generate.js"></script>
        <script src="./js/sistematizacion/click.js"></script>
        <script src="./js/sistematizacion/update.js"></script>
        <script src="./js/telematica/children.js"></script>
        <script src="./js/telematica/generate.js"></script>
        <script src="./js/telematica/click.js"></script>
        <script src="./js/telematica/update.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="container-fluid" style="margin-top: 5%">
            <div class="accordion" id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0 text-center">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSis" aria-expanded="false" aria-controls="collapseSis">
                                <h3>Sistematizacion</h3> 
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSis" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" >
                    </div>
                </div>
                <div class="card" >
                    <div class="card-header" id="headingTwo" style="background-color: #ee6e73">
                        <h2 class="mb-0 text-center">
                            <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseTel" aria-expanded="false" aria-controls="collapseTel">
                                <h3>Telematica</h3>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="background-color: #ffebee">
                    </div>
                </div>
            </div>
        </div>
        <?php
            include_once('includes/db.php');
            $db = new DB();
            $db->connect();
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
        <script>
            
            var compSis = <?php echo ($db->findComponentesSis())?>;
            var espCompSis = <?php echo ($db->findEspaciosComponenteSis())?>;
            var espHerrSis = <?php echo ($db->findEspaciosHerramientaSis()); ?>;
            var espObjSis = <?php echo ($db->findEspaciosObjetoEstudioSis()); ?>;
            var espPensSis = <?php echo ($db->findEspaciosPensamientoSis()); ?>;
            var espRecSis = <?php echo ($db->findEspaciosRecursoSis()); ?>;
            var espResSis = <?php echo ($db->findEspaciosResultadoSis()); ?>;
            var herrCompSis = <?php echo ($db->findHerramientasComponenteSis()); ?>;
            var herrEspSis = <?php echo ($db->findHerramientasEspacioSis()); ?>;
            var objEspSis = <?php echo ($db->findObjetosEstudioEspacioSis()); ?>;
            var objCompSis = <?php echo ($db->findObjetosEstudioComponenteSis()); ?>;
            var pensEspSis = <?php echo ($db->findPensamientosEspacioSis()); ?>;
            var pensCompSis = <?php echo ($db->findPensamientosComponenteSis()); ?>;
            var recEspSis = <?php echo ($db->findRecursosEspacioSis()); ?>;
            var recCompSis = <?php echo ($db->findRecursosComponenteSis()); ?>;
            var resEspSis = <?php echo ($db->findResultadosEspacioSis()); ?>;
            var resCompSis = <?php echo ($db->findResultadosComponenteSis()); ?>;

            var compTel = <?php echo ($db->findComponentesTel()); ?>;
            var espCompTel = <?php echo ($db->findEspaciosComponenteTel()); ?>;
            var espHerrTel = <?php echo ($db->findEspaciosHerramientaTel()); ?>;
            var espObjTel = <?php echo ($db->findEspaciosObjetoEstudioTel()); ?>;
            var espPensTel = <?php echo ($db->findEspaciosPensamientoTel()); ?>;
            var espRecTel = <?php echo ($db->findEspaciosRecursoTel()); ?>;
            var espResTel = <?php echo ($db->findEspaciosResultadoTel()); ?>;
            var herrCompTel = <?php echo ($db->findHerramientasComponenteTel()); ?>;
            var herrEspTel = <?php echo ($db->findHerramientasEspacioTel()); ?>;
            var objEspTel = <?php echo ($db->findObjetosEstudioEspacioTel()); ?>;
            var objCompTel = <?php echo ($db->findObjetosEstudioComponenteTel()); ?>;
            var pensEspTel = <?php echo ($db->findPensamientosEspacioTel()); ?>;
            var pensCompTel = <?php echo ($db->findPensamientosComponenteTel()); ?>;
            var recEspTel = <?php echo ($db->findRecursosEspacioTel()); ?>;
            var recCompTel = <?php echo ($db->findRecursosComponenteTel()); ?>;
            var resEspTel = <?php echo ($db->findResultadosEspacioTel()); ?>;
            var resCompTel = <?php echo ($db->findResultadosComponenteTel()); ?>;

            var treeDataSis = [
                {
                    "name":"Sistematizacion",
                    "hasChildren": 1,
                    "type": "proyecto_curricular"
                }
            ];

            var treeDataTel = [
                {
                    "name":"Telematica",
                    "hasChildren": 1,
                    "type": "proyecto_curricular"
                }
            ];

            // ************** Generate the tree diagram	 *****************
            
            var marginSis;
            var marginTel;
            var widthSis;
            var widthTel;
            var heightSis;
            var heightTel;
                
            var iSis;
            var iTel;
            var durationSis;
            var durationTel;

            var treeSis;
            var treeTel;

            var diagonalSis;
            var diagonalTel;

            var svgSis;
            var svgTel;
                
            var rootSis;
            var rootTel;

            

            this.generateSis();
            this.generateTel();
            
           
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!-- BOOTSTRAP-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!--==========-->
    </body>
</html>

