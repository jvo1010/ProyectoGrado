
function getChildrenTel(ob){
    switch(ob.type){
        case 'proyecto_curricular':
            return compTel;
        case 'componente':
            return  [
                {
                    'codigo': ob.codigo,
                    'name': 'Espacios del componente',
                    'size': 10731,
                    'type': 'espacios_componente_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Herramientas del componente',
                    'size': 10731,
                    'type': 'herramientas_componente_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Objetos de estudio del componente',
                    'size': 10731,
                    'type': 'objetos_componente_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Pensamientos del componente',
                    'size': 10731,
                    'type': 'pensamientos_componente_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Recursos del componente',
                    'size': 10731,
                    'type': 'recursos_componente_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Resultados del componente',
                    'size': 10731,
                    'type': 'resultados_componente_list',
                    'hasChildren': 1
                }
            ];
        case 'espacios_componente_list':
            return  espCompTel.filter(ele => ele.codigo_componente === ob.codigo);
        case 'herramientas_componente_list':
            return herrCompTel.filter(ele => ele.codigo_componente === ob.codigo);
        case 'objetos_componente_list':
            return objCompTel.filter(ele => ele.codigo_componente === ob.codigo);
        case 'pensamientos_componente_list':
            return pensCompTel.filter(ele => ele.codigo_componente === ob.codigo);
        case 'recursos_componente_list':
            return recCompTel.filter(ele => ele.codigo_componente === ob.codigo);
        case 'resultados_componente_list':
            return resCompTel.filter(ele => ele.codigo_componente === ob.codigo);
        case 'espacios_componente':
            return [
                {
                    'codigo': ob.codigo,
                    'name': 'Herramientas del espacio',
                    'size': 10731,
                    'type': 'herramientas_espacio_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Objetos de estudio del espacio',
                    'size': 10731,
                    'type': 'objetos_espacio_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Pensamientos del espacio',
                    'size': 10731,
                    'type': 'pensamientos_espacio_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Recursos del espacio',
                    'size': 10731,
                    'type': 'recursos_espacio_list',
                    'hasChildren': 1
                },
                {
                    'codigo': ob.codigo,
                    'name': 'Resultados del espacio',
                    'size': 10731,
                    'type': 'resultados_espacio_list',
                    'hasChildren': 1
                }
            ]
        case 'herramientas_componente':
            return espHerrTel.filter(ele => ele.codigo_herramientas_conceptuales === ob.codigo);
        case 'objetos_componente':
            return espObjTel.filter(ele => ele.codigo_objetos_de_estudio === ob.codigo);
        case 'pensamientos_componente':
            return espPensTel.filter(ele => ele.codigo_pensamiento === ob.codigo);
        case 'recursos_componente':
            return espRecTel.filter(ele => ele.codigo_recursos === ob.codigo);
        case 'resultados_componente':
            return espResTel.filter(ele => ele.codigo_resultados === ob.codigo);
        case 'herramientas_espacio_list':
            return herrEspTel.filter(ele => ele.codigo_espacio === ob.codigo);
        case 'objetos_espacio_list':
            return objEspTel.filter(ele => ele.codigo_espacio === ob.codigo);
        case 'pensamientos_espacio_list':
            return pensEspTel.filter(ele => ele.codigo_espacio === ob.codigo);
        case 'recursos_espacio_list':
            return recEspTel.filter(ele => ele.codigo_espacio === ob.codigo);
        case 'resultados_espacio_list':
            return resEspTel.filter(ele => ele.codigo_espacio === ob.codigo);
        default:
            return [];
    }
}