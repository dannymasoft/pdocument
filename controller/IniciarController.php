
<?php


class IniciarController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function index(){
	
		session_start();
		
		
			$encuestas = new EncuestasModel();
			$encuestas_cabeza= new EncuestasCabezaModel();
	
			
			
				
	
				$columnas="pre.nombre_preguntas_encuestas_participes,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=1 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=1 and enc.respuestas_encuestas_participes='Bueno') END BUENO_PREGUNTA_1,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=1 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=1 and enc.respuestas_encuestas_participes='Intermedio') END INTERMEDIO_1,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=1 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=1 and enc.respuestas_encuestas_participes='Malo') END MALO_1,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=2 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=2 and enc.respuestas_encuestas_participes='Si') END SI_2,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=2 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=2 and enc.respuestas_encuestas_participes='Algo') END ALGO_2,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=2 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=2 and enc.respuestas_encuestas_participes='Nada') END NADA_2,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=3 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=3 and enc.respuestas_encuestas_participes='Los Colores') END LOS_COLORES_3,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=3 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=3 and enc.respuestas_encuestas_participes='La Información') END LA_INFORMACION_3,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=3 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=3 and enc.respuestas_encuestas_participes='Las Imágenes') END LAS_IMAGENES_3,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=3 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=3 and enc.respuestas_encuestas_participes='Nada') END NADA_3,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='1') END R1_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='2') END R2_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='3') END R3_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='4') END R4_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='5') END R5_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='6') END R6_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='7') END R7_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='8') END R8_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='9') END R9_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=4 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=4 and enc.respuestas_encuestas_participes='10') END R10_4,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=5 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=5 and enc.respuestas_encuestas_participes='Si') END SI_5,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=5 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=5 and enc.respuestas_encuestas_participes='Intermedio') END INTERMEDIO_5,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=5 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=5 and enc.respuestas_encuestas_participes='No') END NO_5,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=6 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=6 and enc.respuestas_encuestas_participes='Si') END SI_6,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=6 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=6 and enc.respuestas_encuestas_participes='No') END NO_6,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=7 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=7 and enc.respuestas_encuestas_participes='Si') END SI_7,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=7 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=7 and enc.respuestas_encuestas_participes='No') END NO_7,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=8 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=8 and enc.respuestas_encuestas_participes='Si') END SI_8,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=8 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=8 and enc.respuestas_encuestas_participes='Intermedio') END INTERMEDIO_8,
						  CASE  WHEN pre.id_preguntas_encuestas_participes=8 THEN  (select count(*) from public.encuentas_participes_detalle enc where enc.id_preguntas_encuestas_participes=pre.id_preguntas_encuestas_participes and enc.id_preguntas_encuestas_participes=8 and enc.respuestas_encuestas_participes='No') END NO_8";
				$tablas="public.preguntas_encuestas_participes pre";
				$where="1=1";
				$id="pre.id_preguntas_encuestas_participes";
	
				$resultSet=$encuestas->getCondiciones($columnas, $tablas, $where, $id);
				
				
				$total=0;
				$resultSet_cabeza=$encuestas_cabeza->getCantidad("*", "encuentas_participes_cabeza", "1=1");
				$total=(int)$resultSet_cabeza[0]->total;
	
				
				/*
				require_once 'core/EntidadBaseSQL.php';
				$db = new EntidadBaseSQL();
				
				$activos=$db->getCondiciones_SQL("COUNT(P.PARTNER_ID) as total","(select DISTINCT c.PARTNER_ID from one.PARTNER p inner join one.CONTRIBUTION c on c.PARTNER_ID=p.PARTNER_ID and c.STATE<>0 and c.STATUS<>0 where p.STATE=0 and p.STATUS<>0 group by c.PARTNER_ID having SUM(c.PERSONNEL_PAY +c.EMPLOYER_PAY) > 0 ) P", "1=1");
				$desafiliados=$db->getCondiciones_SQL("count(p.IDENTITY_CARD) as total","one.PARTNER p", "p.STATE=3 and p.STATUS<>0");
				$liquidados=$db->getCondiciones_SQL("count(p.IDENTITY_CARD) as total","one.PARTNER p", "p.STATE=5 and p.STATUS<>0");
				
				
				$count_activos=$activos[0]->total;
				$count_desafiliados=$desafiliados[0]->total;
				$count_liquidados=$liquidados[0]->total;
				
				
				$_fecha_mayor = getdate();
				$_fecha_año=$_fecha_mayor['year'];
				
				//Millones entregados por cumplimiento de liquidaciones
				$monto_liquidaciones=$db->getCondiciones_SQL("SUM(NET_VALUE_TO_PAY) as total","one.LIQUIDATION(NOLOCK) L", "YEAR(DATE_FOLDER_PAY)='$_fecha_año' AND L.[STATE] in (3, 4) AND L.[STATUS]<>0");
				
				//Créditos entregados a los partícipes
				$creditos_entregados=$db->getCondiciones_SQL("COUNT(C.CREDIT_ID) as total","(SELECT DISTINCT C.CREDIT_ID FROM ONE.CREDIT(NOLOCK) C INNER JOIN ONE.CREDIT_WORK_FLOW(NOLOCK) CWF ON C.CREDIT_ID = CWF.CREDIT_ID WHERE YEAR(CWF.ENTRANCE_DATE)='$_fecha_año' AND CWF.DEPARTMENT = 9) C", "1=1");
				
				//Millones en monto de créditos otorgados
				$monto_creditos_otorgados=$db->getCondiciones_SQL("SUM(C.AMOUNT) as total","ONE.CREDIT(NOLOCK) C", "C.CREDIT_ID IN (SELECT DISTINCT C.CREDIT_ID FROM ONE.CREDIT(NOLOCK) C INNER JOIN ONE.CREDIT_WORK_FLOW(NOLOCK) CWF ON C.CREDIT_ID = CWF.CREDIT_ID WHERE YEAR(CWF.ENTRANCE_DATE)='$_fecha_año' AND CWF.DEPARTMENT = 9)");
				
				//Millones acreditados de utilidad en las cuentas individuales
				
				
				
				$count_monto_liquidaciones=number_format($monto_liquidaciones[0]->total, 2, '.', ',');
				$count_creditos_entregados=$creditos_entregados[0]->total;
				$count_monto_creditos_otorgados=number_format($monto_creditos_otorgados[0]->total, 2, '.', ',');
				
				
				
				
				
				$this->view("paginaweb",array(
						"resultSet"=>$resultSet, "total"=>$total, "count_activos"=>$count_activos, "count_desafiliados"=>$count_desafiliados, "count_liquidados"=>$count_liquidados,
						"count_monto_liquidaciones"=>$count_monto_liquidaciones, "count_creditos_entregados"=>$count_creditos_entregados, "count_monto_creditos_otorgados"=>$count_monto_creditos_otorgados
	
				));
			
	*/
				
				
				$this->view("paginaweb",array(
						"resultSet"=>$resultSet, "total"=>$total
				));
				
	die();
		
	
	}
	
	
	
	
}
?>