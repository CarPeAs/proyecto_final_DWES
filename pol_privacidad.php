<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['id_usuario'])){
   $id_usuario = $_SESSION['id_usuario'];
}else{
   $id_usuario = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>conocenos</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="about">

    <div class="row">

        <div class="content">

            <h1>POLÍTICA DE PRIVACIDAD</h1>

            <p> En Desarrollo Web Entorno Servidor (en adelante <strong>DWES</strong>) sabemos la importancia de 
            tratar los datos personales de nuestros clientes y usuarios de forma transparente y segura, por ello, 
            a través de nuestra política de privacidad te informamos sobre la recopilación, el procesamiento y el 
            uso de los datos personales que nos facilitas.</p>

            <p>Los términos recogidos a continuación y en especial el deber de confidencialidad serán de obligado 
            cumplimiento para todo el personal interno o externo que trabaje o pudiera trabajar con nosotros y que 
            tengan acceso a los datos que nos facilites, bien durante la navegación en nuestra Web, por la utilización
            de nuestros formularios o durante la contratación o prestación de los servicios.</p>

            <h2>1.	INFORMACIÓN AL USUARIO</h2>

                <h3>¿Quién es el responsable del tratamiento de tus datos personales?</h3>
            <p>
            Desarrollo Web Entorno Servidor  (<strong>DWES</strong>) es el RESPONSABLE del tratamiento de los datos 
            personales del USUARIO y le informa de que estos datos serán tratados de conformidad con lo dispuesto en 
            el Reglamento (UE) 2016/679, de 27 de abril (RGPD), y la Ley Orgánica 3/2018, de 5 de diciembre (LOPDGDD),
            por lo que se le facilita la siguiente información del tratamiento:

            </p>
            
                <ul>
                    <li>Datos Identificativos:</li>
                    <li>Nombre comercial: DWES</li>
                    <li>Denominación social: DWES S.L. </li>
                    <li>NIF: B- 00000000</li>
                    <li>Domicilio: Avda.  (Elche). </li>
                    <li>e-mail: info@dwes.es</li>
                </ul>

            <h3>¿Qué datos personales tratamos?</h3>

            <ul>
                <li>Datos que los usuarios nos facilitan voluntariamente</li>
                <li>Los datos procedentes de las comunicaciones que realice con nosotros.</li>
                <li>Información correspondiente a la navegación en el caso de Servicios Online, 
                    dirección IP o información derivada de cookies o dispositivos similares 
                    (para más información visita nuestra Política de Cookies).</li>
                <li>Datos que provengan de la relación contractual o precontractual que mantenga con nosotros.</li>
            </ul>

            <h3>¿Para qué tratamos tus datos personales?</h3>
            <p>a) Atención y gestión de consultas.</p>

            <p>
            Los datos personales recogidos por DWES serán objeto de tratamiento, tanto automatizado como, en su caso, convencional para poder contactar con el usuario con el fin de atender y gestionar adecuadamente los consultas realizados a “DWES” a través de sus formularios. Asimismo, DWES podrá tratar sus datos para los pedidos que se pudieran realizar en el futuro con la finalidad única de mejorar y, a su vez, poder agilizar el servicio. El tratamiento está legitimado en la ejecución de un contrato.

            En el momento de proceder a la recogida de los datos se indicará el carácter voluntario u obligatorio de los datos objeto de recogida por medio de asteriscos (*). La negativa a proporcionar los datos calificados obligatorios supondrá la no prestación o la imposibilidad de acceder al servicio para los que eran solicitados.

            El Cliente o potencial cliente declara y garantiza que toda la información que facilita a DWES a través de los distintos formularios, así como cualquier otra información personal que proporcione a DWES es verdadera, actualizada y completa, y se compromete a comunicar toda modificación o actualización en sus datos.

            </p>
            <p>b) Acciones comerciales por parte de DWES, de productos, promociones y servicios.</p>
            <p>
            De conformidad con lo establecido en la Ley 34/2002 de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico, y la Directiva 2002/58/CE te informamos de que puedes recibir comunicaciones e información de índole comercial mediante este sistema de comunicación electrónica (correos electrónicos, mensajes de respuesta automatizada de formularios y otros sistemas de comunicación) cuando nos hubiera otorgado su consentimiento o bien se trate de comunicaciones comerciales referentes a productos o servicios similares a los prestados con anterioridad por DWES.

            En el supuesto de que no desee recibir comunicaciones e informaciones de esta índole, nos lo puede notificar por esta misma vía indicando en el asunto «BAJA COMUNICACIONES COMERCIALES» para que sus datos personales sean dados de baja de nuestra base de datos. Su solicitud será accionada en un plazo máximo de 1 mes desde su envío. En el supuesto de que no recibamos contestación expresa por su parte, entenderemos que acepta y autoriza que nuestra entidad siga realizando las referidas comunicaciones. Asimismo, todas las comunicaciones electrónicas comerciales de DWES disponen del correspondiente enlace de baja automático con el fin de que puedas ejercer tu derecho de oposición en ese mismo momento.    
            </p>
            


            <h3>¿Qué nos legitima para tratar tus datos personales?</h3>

           <p>La base de la legitimación del tratamiento de Datos Personales será la que resulte de la relación contractual o precontractual o de cualquier otra que se requiera para el tratamiento de datos, tales como el consentimiento expreso o una obligación legal para el responsable del tratamiento.</p> 

            <h3>¿Durante cuánto tiempo guardaremos tus datos personales?</h3>

            <p> DWES cumplirá lo dispuesto en la normativa vigente en cuanto al deber de supresión de la información personal que haya dejado de ser necesaria para el fin o los fines para los cuales fue recabada, bloqueando la misma, con el fin de poder atender a las posibles responsabilidades derivadas del tratamiento de los datos, y sólo durante los plazos de prescripción de dichas responsabilidades. Una vez transcurran dichos plazos, se eliminará definitivamente esa información mediante métodos seguros. </p>
           

            <h3>¿A quién facilitamos tus datos personales?</h3> 

           <p>DWES no realizará cesiones, transmisiones o transferencias de datos personales, que no sean a consecuencia de una obligación legal. De existir una cesión, transmisión o transferencia de datos personales fuera de los casos anteriormente previstos, será previamente informado para que, si procede, nos conceda su consentimiento.

                Por otro lado, para llevar a cabo todas las finalidades anteriormente descritas, DWES puede contar con la colaboración de terceros proveedores de servicios que pueden tener acceso a los datos personales como consecuencia de la ejecución de los servicios contratados. En cualquier caso, DWES sigue unos criterios estrictos de selección de dichos terceros con el fin de dar cumplimiento a sus obligaciones en protección de datos y firma con ellos su correspondiente acuerdo de protección de datos, dónde estos terceros se obligan a cumplir con sus obligaciones en protección de datos, y en concreto, a cumplir con las medidas jurídicas, técnicas y organizativas, al tratamiento de los datos personales para las finalidades pactadas, y la prohibición de tratar dichos datos personales para otras finalidades o cesión a terceros.</p> 

            <h3>¿Cuáles son tus derechos?</h3>
            <p>En relación con sus derechos sobre sus datos personales, usted puede solicitar lo siguiente:</p>
            
                <ul>
                    <li>Cuando el tratamiento de su información personal se base en su consentimiento, puede retirar este consentimiento en cualquier momento; la retirada del consentimiento no afectará la legalidad del tratamiento basado en el consentimiento antes de su revocación;</li>
                    <li>Solicitar acceso a su información personal y obtener una copia de ella;</li>
                    <li>Obtener su información personal en un formato estructurado, de uso común y legible por máquina y solicitar que la transmitamos directamente a otra compañía en los casos en que su información personal sea tratada en base a su consentimiento previo o requerida para la ejecución de un contrato;</li>
                    <li>Hacer que se corrija su información personal cuando sea inexacta o incompleta;</li>
                    <li>Oponerse por motivos relacionados con su situación particular en caso de que DWES tratara su información personal en base al interés legítimo.</li>
                    <li>Derecho a que su información personal sea borrada, incluidos los enlaces, la copia o la reproducción de dicha información, según lo permitido por la ley aplicable; por ejemplo, cuando su información esté desactualizada, no sea necesaria o sea ilegal, o cuando retire su consentimiento para nuestro tratamiento basado en dicho consentimiento, o cuando se oponga con éxito a nuestro tratamiento;</li>
                    <li>Obtener la limitación del tratamiento mientras procesamos su solicitud o impugnación relativa a la exactitud de su información personal o a la legalidad del tratamiento de su información personal y nuestros intereses legítimos para tratar esta información, o si usted necesita la información personal para litigios.</li>
                </ul>
            
            <p>Datos de contacto para ejercer sus derechos:

            Si Ud. quiere interponer algún tipo de reclamación podrá dirigirse mediante solicitud a la dirección de correo electrónico establecida a tal efecto: info@dwes.es o a la dirección postal: Avda. (Elche).

            Dicha solicitud deberá contener los siguientes datos: nombre y apellidos del Usuario, domicilio a efectos de notificaciones, fotocopia del DNI o Pasaporte, y petición en que se concreta la solicitud. En el caso de representación, deberá probarse la misma mediante documento fehaciente. Asimismo, en el caso que lo estime necesario, podrá dirigirse ante la Agencia Española de Protección de Datos (www.aepd.es), en la C/ Jorge Juan, número 6, 28001 Madrid.</p>

            <h2>2.	MEDIDAS DE SEGURIDAD</h2>
                <p>
                De conformidad con lo dispuesto en las normativas vigentes en protección de datos personales, el RESPONSABLE está cumpliendo con todas las disposiciones de las normativas RGPD y LOPDGDD para el tratamiento de los datos personales de su responsabilidad, y manifiestamente con los principios descritos en el artículo 5 del RGPD, por los cuales son tratados de manera lícita, leal y transparente en relación con el interesado y adecuados, pertinentes y limitados a lo necesario en relación con los fines para los que son tratados.

                El RESPONSABLE garantiza que ha implementado políticas técnicas y organizativas apropiadas para aplicar las medidas de seguridad que establecen el RGPD y la LOPDGDD con el fin de proteger los derechos y libertades de los USUARIOS y les ha comunicado la información adecuada para que puedan ejercerlos.

                Para más información sobre las garantías de privacidad, puedes dirigirte al RESPONSABLE DWES a través del Email: info@dwes.es o a la dirección postal: Avda.  (Elche).
                </p>
            
            
            <p>Ultima actualización <strong>21/02/2023</strong></p>
            
        </div>
    </div>
</section>

<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>