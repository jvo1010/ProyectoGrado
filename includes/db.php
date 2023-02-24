<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    
    public function __construct(){
        $this->host = 'localhost';
        $this->db = 'sistematizaciondatos_com';
        $this->user = 'root';
        $this->password = '0429';
        $this->charset = 'utf8mb4';
    }

    public function connect(){
        try{
            $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false];
            return $pdo = new PDO($connection, $this->user, $this->password, $options);
        }catch(PDOexception $e){
            print_r("Error connection: ".$e->getMessage());
        }
    }

    //--------------------------------------Componentes--------------------------------------------
    public function findComponentesTel(){
        $statement=$this->connect()->prepare("select distinct ob1.codigo, ob1.nombre as name , 10731 as size, 'componente' as type, true as hasChildren 
        from res_componente ob1 join res_espacio ob2 on ob1.codigo = ob2.codigo_componente where ob2.semestre_espacio > 6;");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findComponentesSis(){
        $statement=$this->connect()->prepare("select distinct ob1.codigo, ob1.nombre as name , 10731 as size, 'componente' as type, true as hasChildren 
        from res_componente ob1 join res_espacio ob2 on ob1.codigo = ob2.codigo_componente where ob2.semestre_espacio < 7;");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    //--------------------------------------Espacios--------------------------------------------

    public function findEspaciosComponenteTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob1.codigo_componente, 10731 as size, 'espacios_componente' as type, true as hasChildren
        from res_espacio ob1
        join res_componente ob2 on ob1.codigo_componente = ob2.codigo where ob1.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosComponenteSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob1.codigo_componente, 10731 as size, 'espacios_componente' as type, true as hasChildren
        from res_espacio ob1
        join res_componente ob2 on ob1.codigo_componente = ob2.codigo where ob1.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosHerramientaTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_herramientas_conceptuales, 5731 as size, 'espacios_herramienta' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_herramientas_conceptuales ob2 on ob1.codigo = ob2.codigo_espacio
        join res_herramientas_conceptuales ob3 on ob2.codigo_herramientas_conceptuales = ob3.codigo 
        where ob1.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosHerramientaSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_herramientas_conceptuales, 5731 as size, 'espacios_herramienta' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_herramientas_conceptuales ob2 on ob1.codigo = ob2.codigo_espacio
        join res_herramientas_conceptuales ob3 on ob2.codigo_herramientas_conceptuales = ob3.codigo 
        where ob1.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosObjetoEstudioTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_objetos_de_estudio, 10731 as size, 'espacios_objeto' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_objetos_de_estudio ob2 on ob1.codigo = ob2.codigo_espacio
        join res_objetos_de_estudio ob3 on ob2.codigo_objetos_de_estudio = ob3.codigo 
        where ob1.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosObjetoEstudioSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_objetos_de_estudio, 10731 as size, 'espacios_objeto' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_objetos_de_estudio ob2 on ob1.codigo = ob2.codigo_espacio
        join res_objetos_de_estudio ob3 on ob2.codigo_objetos_de_estudio = ob3.codigo 
        where ob1.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosPensamientoTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_pensamiento, 5731 as size, 'espacios_pensamiento' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_pensamiento ob2 on ob1.codigo = ob2.codigo_espacio
        join res_pensamiento ob3 on ob2.codigo_pensamiento = ob3.codigo 
        where ob1.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosPensamientoSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_pensamiento, 5731 as size, 'espacios_pensamiento' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_pensamiento ob2 on ob1.codigo = ob2.codigo_espacio
        join res_pensamiento ob3 on ob2.codigo_pensamiento = ob3.codigo 
        where ob1.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosRecursoTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_recursos, 5731 as size, 'espacios_recurso' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_recursos ob2 on ob1.codigo = ob2.codigo_espacio
        join res_recursos ob3 on ob2.codigo_recursos = ob3.codigo 
        where ob1.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosRecursoSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_recursos, 5731 as size, 'espacios_recurso' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_recursos ob2 on ob1.codigo = ob2.codigo_espacio
        join res_recursos ob3 on ob2.codigo_recursos = ob3.codigo 
        where ob1.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosResultadoTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_resultados, 5731 as size, 'espacios_resultado' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_resultados_de_aprendizaje ob2 on ob1.codigo = ob2.codigo_espacio
        join res_resultados_de_aprendizaje ob3 on ob2.codigo_resultados = ob3.codigo 
        where ob1.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findEspaciosResultadoSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.nombre as name , ob2.codigo_resultados, 5731 as size, 'espacios_resultado' as type, false as hasChildren
        from res_espacio ob1
        join res_asignacion_resultados_de_aprendizaje ob2 on ob1.codigo = ob2.codigo_espacio
        join res_resultados_de_aprendizaje ob3 on ob2.codigo_resultados = ob3.codigo 
        where ob1.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    //--------------------------------------Herramientas--------------------------------------------
    public function findHerramientasEspacioTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'herramientas_espacio' as type, false as hasChildren 
        from res_herramientas_conceptuales ob1
        join res_asignacion_herramientas_conceptuales ob2 on ob1.codigo = ob2.codigo_herramientas_conceptuales 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findHerramientasEspacioSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'herramientas_espacio' as type, false as hasChildren 
        from res_herramientas_conceptuales ob1
        join res_asignacion_herramientas_conceptuales ob2 on ob1.codigo = ob2.codigo_herramientas_conceptuales 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findHerramientasComponenteTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'herramientas_componente' as type, true as hasChildren 
        from res_herramientas_conceptuales ob1
        join res_asignacion_herramientas_conceptuales ob2 on ob1.codigo = ob2.codigo_herramientas_conceptuales 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findHerramientasComponenteSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'herramientas_componente' as type, true as hasChildren 
        from res_herramientas_conceptuales ob1
        join res_asignacion_herramientas_conceptuales ob2 on ob1.codigo = ob2.codigo_herramientas_conceptuales 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    //--------------------------------------Objetos de estudio--------------------------------------------
    public function findObjetosEstudioEspacioTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'objetos_espacio' as type, false as hasChildren 
        from res_objetos_de_estudio ob1
        join res_asignacion_objetos_de_estudio ob2 on ob1.codigo = ob2.codigo_objetos_de_estudio 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findObjetosEstudioEspacioSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'objetos_espacio' as type, false as hasChildren 
        from res_objetos_de_estudio ob1
        join res_asignacion_objetos_de_estudio ob2 on ob1.codigo = ob2.codigo_objetos_de_estudio 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findObjetosEstudioComponenteTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'objetos_componente' as type, true as hasChildren 
        from res_objetos_de_estudio ob1
        join res_asignacion_objetos_de_estudio ob2 on ob1.codigo = ob2.codigo_objetos_de_estudio 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findObjetosEstudioComponenteSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'objetos_componente' as type, true as hasChildren 
        from res_objetos_de_estudio ob1
        join res_asignacion_objetos_de_estudio ob2 on ob1.codigo = ob2.codigo_objetos_de_estudio 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    //--------------------------------------Pensamientos--------------------------------------------
    public function findPensamientosEspacioTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'pensamientos_espacio' as type, false as hasChildren 
        from res_pensamiento ob1
        join res_asignacion_pensamiento ob2 on ob1.codigo = ob2.codigo_pensamiento 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findPensamientosEspacioSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'pensamientos_espacio' as type, false as hasChildren 
        from res_pensamiento ob1
        join res_asignacion_pensamiento ob2 on ob1.codigo = ob2.codigo_pensamiento 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findPensamientosComponenteTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'pensamientos_componente' as type, true as hasChildren 
        from res_pensamiento ob1
        join res_asignacion_pensamiento ob2 on ob1.codigo = ob2.codigo_pensamiento 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findPensamientosComponenteSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'pensamientos_componente' as type, true as hasChildren 
        from res_pensamiento ob1
        join res_asignacion_pensamiento ob2 on ob1.codigo = ob2.codigo_pensamiento 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    //--------------------------------------Recursos--------------------------------------------
    public function findRecursosEspacioTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'recursos_espacio' as type, false as hasChildren 
        from res_recursos ob1
        join res_asignacion_recursos ob2 on ob1.codigo = ob2.codigo_recursos 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findRecursosEspacioSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'recursos_espacio' as type, false as hasChildren 
        from res_recursos ob1
        join res_asignacion_recursos ob2 on ob1.codigo = ob2.codigo_recursos 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findRecursosComponenteTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'recursos_componente' as type, true as hasChildren 
        from res_recursos ob1
        join res_asignacion_recursos ob2 on ob1.codigo = ob2.codigo_recursos 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findRecursosComponenteSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'recursos_componente' as type, true as hasChildren 
        from res_recursos ob1
        join res_asignacion_recursos ob2 on ob1.codigo = ob2.codigo_recursos 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    //--------------------------------------Resultados--------------------------------------------

    public function findResultadosEspacioTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'resultados_espacio' as type, false as hasChildren 
        from res_resultados_de_aprendizaje ob1
        join res_asignacion_resultados_de_aprendizaje ob2 on ob1.codigo = ob2.codigo_resultados 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findResultadosEspacioSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob2.codigo_espacio, 5731 as size, 'resultados_espacio' as type, false as hasChildren 
        from res_resultados_de_aprendizaje ob1
        join res_asignacion_resultados_de_aprendizaje ob2 on ob1.codigo = ob2.codigo_resultados 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findResultadosComponenteTel(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'resultados_componente' as type, true as hasChildren 
        from res_resultados_de_aprendizaje ob1
        join res_asignacion_resultados_de_aprendizaje ob2 on ob1.codigo = ob2.codigo_resultados 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio > 6");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function findResultadosComponenteSis(){
        $statement=$this->connect()->prepare("
        select distinct ob1.codigo, ob1.descripcion as name , ob3.codigo_componente, 10731 as size, 'resultados_componente' as type, true as hasChildren 
        from res_resultados_de_aprendizaje ob1
        join res_asignacion_resultados_de_aprendizaje ob2 on ob1.codigo = ob2.codigo_resultados 
        join res_espacio ob3 on ob2.codigo_espacio = ob3.codigo 
        join res_componente ob4 on ob3.codigo_componente = ob4.codigo 
        where ob3.semestre_espacio < 7");
        $statement->execute();
        if ($statement){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        }else{
            return null;
        }
    }

}
?>