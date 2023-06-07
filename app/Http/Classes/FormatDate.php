<?php
namespace App\Http\Classes;
class FormatDate{
    //devuelve ej: 01/marzo/2017
    public static function trimestre($datetime)
    {
        $mes = date("m",strtotime($datetime));
        $mes = is_null($mes) ? date('m') : $mes;
        $trim=floor(($mes-1) / 3)+1;
        return $trim;
    }

    static function anio($fecha, $tipus=1)
    {
        $año=substr($fecha, 0, 4);
        $mes=substr($fecha, 5, 2);
        $dia=substr($fecha, 8, 2);       

        if ($fecha != '' && $tipus == 0 || $tipus == 1) {
            if ($tipus == 1) {
                $fecha = mktime(0, 0, 0, (int)$mes, (int)$dia, (int)$año); 
            }
            return date('Y', $fecha);
        }
        else {
            return 0;
        }
    }

    public static function shortDateFormat($fecha, $tipus=1) {
        $año=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $dia=substr($fecha,8,2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1)
        {

            if ($tipus == 1){ $fecha = mktime(0,0,0,(int)$mes,(int)$dia,(int)$año); }
            return date('d', $fecha).'/'.date('m',$fecha).'/'.date('Y', $fecha);
        }
        else{return 0;}
    }

    public static function shortDateFormatTime($date,$type=0)
    {
        if(($date=='') || ($date=='0000-00-00')){return '';}
        if($type==1)
        {
            $char='-';
            $charto='/';


        }
        else
        {
            $char='/';
            $charto='-';
        }

        $arr = explode(" ", $date);
        $date= $arr['0'];
        //print_r($date);
        //$time= $arr['1'].':00';
        $time= $arr['1'];
        $time = substr($time, 0, -3);

        $vector_fecha=explode($char,$date);
        $aux=$vector_fecha[2];
        $vector_fecha[2]=$vector_fecha[0];
        $vector_fecha[0]=$aux;

        $result= implode($charto,$vector_fecha).' '.$time;

        return $result;
    }

    //devuelve ej: 01 de Marzo de 2017
    static function longDateFormat_day($fecha, $tipus=1)
    {
        $año=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $dia=substr($fecha,8,2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1)
        {
            $mest = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

            if ($tipus == 1){ $fecha = mktime(0,0,0,(int)$mes,(int)$dia,(int)$año); }
            return date('d', $fecha).' de '.$mest[date('m',$fecha)-1].' de '.date('Y', $fecha);
        }
        else{return 0;}
    }


    //devuelve ej: 01 de Marzo
    static function solo_dia_mes($fecha, $tipus=1)
    {
        $año=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $dia=substr($fecha,8,2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1)
        {
            $mest = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

            if ($tipus == 1){ $fecha = mktime(0,0,0,(int)$mes,(int)$dia,(int)$año); }
            return date('d', $fecha).' de '.$mest[date('m',$fecha)-1];
        }
        else{return 0;}
    }


    public static function formatDates($date,$type=0)
    {
        if(($date=='') || ($date=='0000-00-00')){return '';}
        if($type==1)
        {
            $char='-';
            $charto='/';
        }
        else
        {
            $char='/';
            $charto='-';
        }

        $vector_fecha=explode($char,$date);
        $aux=$vector_fecha[2];
        $vector_fecha[2]=$vector_fecha[0];
        $vector_fecha[0]=$aux;
        return implode($charto,$vector_fecha);
    }

    //dd/mm/yyyy
    static function dia_mes_anio($fecha, $tipus=1)
    {
        $año=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $dia=substr($fecha,8,2);
       //echo (int)$mes."----------------------"; exit();

        if ($fecha != '' && $tipus == 0 || $tipus == 1)
        {

            if ($tipus == 1){ $fecha = mktime(0,0,0,(int)$mes,(int)$dia,(int)$año); }
            return date('d', $fecha).'/'.date('m',$fecha).'/'.date('Y', $fecha);
        }
        else{return 0;}
    }


}

?>
