@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<meta name="_token" content="{{ csrf_token() }}"/>

<body class="hold-transition login-page">

<div class="row">
    <div class="container">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title" >
                HABEAS DATA Y TRATAMIENTO DE DATOS
</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
             
              <!-- /.box-body -->
             <div class="box-footer">
               
<textarea cols="100" rows="30" style="overflow:auto" readonly="readonly"> 
Habeas data y tratamiento de datos.

AUTORIZACIÓN ENVÍO COMUNICACIONES Y REPORTES 

Autorizo para que CLEANAPPS envíe a la dirección de correo electrónico aquí registrada, las comunicaciones y reportes de tipo legal y comercial que así requiera. En caso de no contar con este dato, podrá ser enviada a la dirección de contacto física. 

AUTORIZACIÓN TRATAMIENTO DATOS PERSONALES 

La protección y el buen manejo de la información personal de sus clientes son muy importantes para CLEANAPPS, por cuanto la misma le permite atender de mejor manera las necesidades que ellos tienen, así como cumplir con las obligaciones a su cargo. Es por ello que CLEANAPPS ha diseñado políticas y procedimientos que en conjunto con la presente autorización permiten hacer uso de sus datos personales conforme a la ley. Así, lo invitamos a leer cuidadosamente el siguiente texto mediante el cual autoriza el tratamiento de su información personal. 1. En relación con mis Datos Personales: ¿Para qué se utilizará mi información? Por vía de este documento, en mi calidad de titular de la información o representante legal del mismo, autorizo a CLEANAPPS a dar tratamiento a mis datos personales para: 1) El desarrollo de su objeto social y de la relación contractual que nos vincula, lo que supone el ejercicio de sus derechos y deberes dentro de los que están, sin limitarse a ellos, la atención de mis solicitudes, la generación de facturas, la realización de actividades de cobranza, entre otros; 2) La administración de los servicios comercializados a través de CLEANAPPS de los que soy titular; 3) La estructuración de ofertas comerciales y la remisión de información comercial sobre servicios a través de los canales o medios que CLEANAPPS establezca para tal fin; 4) La adopción de medidas tendientes a la prevención de actividades ilícitas. Así mismo, CLEANAPPS  podrá transferir mis datos personales a otros países, con el fin de posibilitar la realización de las finalidades previstas en la presente autorización. ¿Quiénes están autorizados para utilizar mi información? La presente autorización se hace extensiva a quien represente los derechos de CLEANAPPS, a quien éste contrate para el ejercicio de los mismos o a quien éste ceda sus derechos, sus obligaciones o su posición contractual a cualquier título, en relación con los servicios de los que soy titular. Así mismo a los terceros con quien  CLEANAPPS establezca alianzas comerciales, a partir de las cuales se ofrezcan productos o servicios que puedan ser de su interés. ¿Por cuánto tiempo estará vigente esta autorización? Esta autorización permanecerá vigente, hasta tanto sea revocada y podrá ser revocada en los eventos previstos en la ley, y siempre y cuando no exista ningún tipo de relación con el CLEANAPPS. 2. En relación con la información relativa a mi comportamiento comercial, de servicios: Así mismo, en mi calidad de titular de la información o representante legal del mismo, autorizo de manera irrevocable a CLEANAPPS para que consulte, solicite, suministre, reporte, procese, obtenga, recolecte, compile, confirme, intercambie, modifique, emplee, analice, estudie, conserve, reciba y envíe toda la información que se refiere a mi comportamiento comercial, de servicios y la proveniente de terceros países de la misma naturaleza a cualquier Operador de Información debidamente constituido o entidad que maneje o administre bases de datos con fines similares a los de tales Operadores, dentro y fuera del territorio nacional, de conformidad con lo establecido en el ordenamiento jurídico. Esta autorización implica que esos datos serán registrados con el objeto de suministrar información suficiente y adecuada al mercado sobre el estado de mis actuaciones comerciales, de servicios y la proveniente de terceros países de la misma naturaleza. En consecuencia, quienes tengan acceso a esos Operadores de Información podrán conocer esa información de conformidad con la legislación vigente.

UTILIZACIÓN Y CONTRATACIÓN BIOMÉTRICA.

He sido informado sobre el sistema biométrico como herramienta de identificación, verificación y autorizó  CLEANAPPS para capturar, almacenar, consultar, enviarlas, procesarlas, tratarlas y compartirlas con terceros nacionales o extranjeros, los datos suministrados serán tratados con confidencialidad, dando cumplimiento a la ley y serán utilizados exclusivamente para las finalidades anteriormente enunciadas, el usuario tiene derecho a conocer, actualizar y rectificar la información y podrá solicitar en cualquier momento que no se utilice la información con fines de mercadeo  y/o promoción de productos o servicios.

ORIGEN DE FONDOS

Declaro que los recursos usados en CLEANAPPS  provienen de actividades lícitas y no realizaré movimientos en CLEANAPPS o sus filiales nacionales o extranjeras a favor de personas relacionadas  con dichas actividades.




 </textarea>

                <button onclick="window.close();" type="submit" class="btn btn-info pull-right">Salir</button>
              </div>
              <!-- /.box-footer -->
       
          </div>
<br>
    
    <!-- <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a> -->

</div>




    @include('layouts.partials.scripts_auth')
    <script src="{{ asset('/js/servicios.js')}}" type="text/javascript"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
