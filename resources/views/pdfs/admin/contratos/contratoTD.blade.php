<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PDF</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- STILE -->
        <style>
            /**
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 0cm 0cm;
            }
            /** Defina ahora los márgenes reales de cada página en el PDF **/

            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');

            body {
                margin-top: 2.5cm;
                margin-left: 2.5cm;
                margin-right: 2.5cm;
                margin-bottom: 2.5cm;
                /* font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; */

                font-family: 'Roboto', sans-serif;

                text-align: justify;

                font-size: 11px;
            }

            p{
                line-height: 1.5em;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 2cm;
                left: 2cm;
                right: 2cm;
                height: 4cm;
            }
            /** Definir las reglas del pie de página **/
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
            }
            main{
                line-height:180%;
            }

            .font-15{
                font-size: 15px;
            }

            .font-17{
                font-size: 17px;
            }

            .font-family-bof{
                font-family: 'Baskerville Old Face';
            }

            dt{
                font-size: 17px;
                padding-bottom: 1em;
                text-decoration: underline;
            }

            dd{
                font-size: 15px;
            }

            .text p{
                font-size: 15px;
            }

            .text-underline-blue{
                color: cornflowerblue;
                text-decoration: underline;
                font-weight: bold;
            }

            .wrapper {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

        </style>
    </head>
    <body>
        <div class="contenido">
            <p class="font-15">
                <span class="font-weight-bold">CONTRATO DE TRABAJO POR TIEMPO DETERMINADO</span> QUE CELEBRAN POR UNA PARTE, LA EMPRESA <span class="text-underline-blue"> @isset($user->company) {{$user->company->nombre_de_la_compañia}} @else COMPAÑIA @endisset</span>, <span class="font-weight-bold">REPRESENTADA EN ESTE ACTO POR EL C.</span> <span class="text-underline-blue">APODERADO LEGAL</span>, DESIGNADA EN LO SUCESIVO COMO <span class="font-weight-bold">“LA EMPRESA”</span>, Y POR OTRA PARTE EL C. <span class="text-underline-blue"> @isset($user->name) {{$user->name}} @else COLABORADOR @endisset</span>, POR SU PROPIO DERECHO, A QUIEN SE LE DENOMINARA <span class="font-weight-bold">“EL TRABAJADOR”</span>, AL TENOR DE LAS SIGUIENTES:
            </p>

            <hr class="border-secondary">
            <p class="font-17 font-weight-bold text-center">DECLARACIONES:</p>
            <hr class="border-secondary">

            <dl>
                <dt>I. DECLARA LA EMPRESA, por conducto de su representante legal:</dt>
                    <dd>
                        <p>a) Que es una Sociedad Civil Mexicana, constituida conforme a las Leyes mexicanas.</p>
                        <p>b) Que cuenta con las facultades necesarias para obligar a su representada en los términos de este contrato, las cuales bajo protesta de decir verdad manifiesta que no le han sido revocadas, limitadas ni modificadas en modo alguno.</p>
                        <p>c) Que cuenta con Registro Federal de Contribuyente (RFC) número <span class="text-underline-blue">RFC EMPRESA</span> y número de Registro Patronal ante el Instituto Mexicano del Seguro Social (IMSS) <span class="text-underline-blue">REGISTRO PATRONAL</span>.</p>
                        <p>d) Que tiene su domicilio ubicado en <span class="text-underline-blue">DOMICILIO EMPRESA</span>, en la ciudad de Tijuana, Baja California.</p>
                    </dd>
                <dt>II. DECLARA EL TRABAJADOR:</dt>
                    <dd>
                        <p>
                            a) Que es <span class="text-underline-blue">NACIONALIDAD </span>, de <span class="text-underline-blue"> @isset($user->fecha_de_nacimiento) {{$edad}} @else EDAD @endisset </span> años de edad, de sexo <span class="text-underline-blue"> @isset($user->curp) @if(substr($user->curp, -8, 1) == 'M') FEMENINO @else @if(substr($user->curp, -8, 1) == 'H') MASCULINO @endif @endif @else GENERO @endisset</span>, de estado civil <span class="text-underline-blue">E. CIVIL</span>, con Clave Única de Registro de Población (CURP) <span class="text-underline-blue"> @isset($user->curp) {{$user->curp}} @else CURP @endisset</span>, con Registro Federal de Contribuyentes (R.F.C.) <span class="text-underline-blue"> @isset($user->rfc) {{$user->rfc}} @else RFC @endisset </span>; y con domicilio en <span class="text-underline-blue">DIRECCION</span>.
                            Este domicilio lo señala <span class="font-weight-bold">“EL TRABAJADOR”</span> para todos los efectos legales y a menos que notifique el cambio del mismo, aquel será considerado como su último domicilio.
                        </p>
                        <p>
                            b) Que conoce perfectamente bien la forma en que opera <span class="font-weight-bold">“LA EMPRESA”</span> y la necesidad de contratar trabajadores temporales y que la vigencia del presente contrato atiende a la naturaleza del trabajo a prestar, por lo que está sujeta a la fecha de conclusión de los trabajos señalados en la declaración I, inciso e), la cual por el momento está programada para el día <span class="text-underline-blue">90 días después de su contratación</span>, por lo que sabe y acepta que la vigencia de presente contrato concluye el mismo día de terminación de los trabajos descritos en la declaración I inciso e) del presente contrato.
                        </p>
                        <p>
                            c) Que es apto y competente, además de que tiene la experiencia y habilidades necesarias para prestar sus servicios personales bajo la subordinación de <span class="font-weight-bold">“LA EMPRESA”</span>, en los términos del presente contrato y que no adolece de ninguna incapacidad física o mental por lo que acepta expresamente la responsabilidad.
                        </p>
                    </dd>
            </dl>
            <p class="font-17">Expuesto lo anterior, las partes otorgan las siguientes:</p>
            <hr class="border-secondary">
            <p class="font-17 font-weight-bold text-center">C L Á U S U L A S:</p>
            <hr class="border-secondary">

            <div class="text">
                <p>
                    <span class="font-weight-bold">PRIMERA</span>.- Convienen <span class="font-weight-bold">“LAS PARTES”</span> que el presente contrato se celebra <span class="font-weight-bold">por tiempo determinado</span>, dada la naturaleza del trabajo a prestar y tendrá vigencia única y exclusivamente durante el tiempo que dure la prestación de los servicios señalados en la declaración I, inciso e) del presente instrumento, mismos que están programados para concluir el día <span class="text-underline-blue">90 días después de su contratación</span>.
                </p>
                <p>
                    En el supuesto de que llegada la fecha de vencimiento del presente contrato, <span class="font-weight-bold">“LA EMPRESA”</span> subsista la materia del trabajo para la cual <span class="font-weight-bold">“EL TRABAJADOR”</span> es contratado, éste continuará prestando sus servicios, única y exclusivamente hasta la conclusión o terminación de la misma. Así mismo, para el caso de que la materia del trabajo contratado concluyera en una fecha anterior a la programada y señalada en la presente cláusula, <span class="font-weight-bold">“EL TRABAJADOR”</span> está de acuerdo en que la vigencia del presente contrato se ajustará a dicha fecha de conclusión de los servicios a prestar, por lo que la relación de trabajo concluirá en esa misma fecha.
                </p>
                <p>
                    <span class="font-weight-bold">SEGUNDA</span>.- Conviene <span class="font-weight-bold">“EL TRABAJADOR”</span> en prestar bajo la dirección y subordinación exclusiva de <span class="font-weight-bold">“LA EMPRESA”</span>, sus servicios personales por el tiempo que sea necesaria la prestación de los servicios, de acuerdo a lo señalado en la declaración I, inciso e) del presente instrumento, desempeñando el puesto de <span class="text-underline-blue"> @isset($user->puesto) {{$user->puesto}} @else PUESTO CONTRATADO @endisset</span>, consistente en las actividades que le sea solicitada por la empresa. Y realizar las funciones que de una manera enunciativa más no limitativa se encuentran expresadas en la descripción de puesto que se anexa al presente contrato y que forma parte integral del mismo, subordinado jurídicamente a <span class="font-weight-bold">“LA EMPRESA”</span>.
                </p>
                <p>
                    <span class="font-weight-bold">TERCERA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> se compromete a prestar sus servicios con esmero y eficiencia en el lugar ubicado en <span class="text-underline-blue">DIRECCION EMPRESA</span>, o en cualquier otro donde <span class="font-weight-bold">“LA EMPRESA”</span> desempeñe actividades relacionadas con la naturaleza del trabajo contratado y requiera de los servicios de <span class="font-weight-bold">“EL TRABAJADOR”</span>.
                </p>
                <p>
                    <span class="font-weight-bold">CUARTA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> y <span class="font-weight-bold">“LA EMPRESA”</span> convienen que la jornada de trabajo será de las 07:00:00 horas a las 17:00:00 horas de lunes a viernes, se concederá <span class="font-weight-bold">“EL TRABAJADOR”</span> una hora de las 12:00:00 horas a las 13:00:00 horas, para que éste pueda salir a tomar sus alimentos y descansar, por lo que no será considerado como tiempo efectivo dentro de la jornada legal, teniendo la libertad <span class="font-weight-bold">“EL TRABAJADOR”</span> de salir fuera de las instalaciones de <span class="font-weight-bold">“LA EMPRESA”</span> a tomar sus alimentos y descansar. Los días sábados la jornada comprenderá de las 07:00:00 horas a las 12:00:00 horas, teniendo como descanso semanal los días domingo de cada semana. Las partes acuerdan que el horario y turno de <span class="font-weight-bold">“EL TRABAJADOR”</span> será determinado y podrá ser cambiado por <span class="font-weight-bold">“LA EMPRESA”</span> de acuerdo con su programa de trabajo.
                </p>
                <p>
                    Las partes están conformes en que <span class="font-weight-bold">“LA EMPRESA”</span> tendrá derecho de distribuir y repartir la jornada laboral de conformidad con el artículo 59 de la Ley Federal del Trabajo y el Reglamento Interior de Trabajo vigente en <span class="font-weight-bold">“LA EMPRESA”</span>, a fin de permitir a <span class="font-weight-bold">“EL TRABAJADOR”</span> el reposo del sábado por la tarde o cualquier modalidad equivalente. Establecida una modalidad, ésta podrá ser cambiada por “LA EMPRESA” de acuerdo a sus necesidades laborales.
                </p>
                <p>
                    <span class="font-weight-bold">“EL TRABAJADOR”</span> reconoce que <span class="font-weight-bold">“LA EMPRESA”</span> pudiera tener la necesidad de reasignar el lugar de trabajo de su personal de acuerdo con las necesidades de la prestación del servicio, por lo que está de acuerdo que se le cambie de lugar de trabajo cuando lo requieran las necesidades de <span class="font-weight-bold">“LA EMPRESA”</span>, sin que ello implique cambio o disminución de condiciones de trabajo.
                </p>
                <p>
                    Convienen ambas partes que <span class="font-weight-bold">“LA EMPRESA”</span> únicamente reconocerá tiempo extraordinario siempre y cuando haya solicitud <span class="font-weight-bold">“EL TRABAJADOR”</span>, por su jefe inmediato, por escrito y cuando las circunstancias del trabajo así lo requieran, el tiempo extra se pagará de conformidad con la Ley Federal del Trabajo, contra la entrega de las ordenes escritas y la justificación de haber trabajado tiempo extra a que se refiere tal orden.
                </p>
                <p>
                    Cuando se aumente la jornada de trabajo, los servicios prestados durante el tiempo excedente a la jornada legal contratada, se considerarán como tiempo extraordinario. Tales servicios nunca podrán exceder de 3 (tres) horas diarias, ni de 3 (tres) veces en una semana.
                </p>
                <p>
                    <span class="font-weight-bold">QUINTA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> percibirá por los servicios que preste en los términos de este contrato, un Salario Diario de $ <span class="text-underline-blue"> @isset($user->salario_legal) {{$user->salario_legal}} @else SALARIO LEGAL @endisset </span> <span class="font-weight-bold">pesos  00/100 Moneda Nacional</span>, por jornada legal, los cuales serán pagados los días <span class="font-weight-bold">SABADO</span> de cada semana, dando su consentimiento <span class="font-weight-bold">“EL TRABAJADOR”</span>, para que el pago de su salario pueda efectuársele por medio de depósito en cuenta bancaria, tarjeta de débito, transferencias o cualquier otro medio electrónico, conforme lo señala el artículo 101 de la Ley Federal del Trabajo.
                </p>
                <p>
                    <span class="font-weight-bold">SEXTA</span>.- <span class="font-weight-bold">“LA EMPRESA”</span> se compromete a capacitar y adiestrar al <span class="font-weight-bold">“TRABAJADOR”</span> en base a los planes y programas existentes en <span class="font-weight-bold">“LA EMPRESA”</span> de conformidad al artículo 153, fracciones de la “A” a la “X”, de la Ley Federal del Trabajo; <span class="font-weight-bold">“EL TRABAJADOR”</span> se compromete a sujetarse a los cursos que se programen para tal efecto, obligándose a asistir puntualmente  a los  cursos,  sesiones  de grupos  y  demás  actividades que  le señale  <span class="font-weight-bold">“LA  EMPRESA”</span> y que  forman  parte  del  proceso  de  capacitación  y adiestramiento;  a atender las indicaciones de las personas que impartan la capacitación y adiestramiento y cumplir con los programas respectivos  y presentar  los  exámenes  de  evaluación  de  conocimientos   y  aptitud  que  sean requeridos.
                </p>
                <p>
                    <span class="font-weight-bold">SÉPTIMA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> conviene en someterse a los reconocimientos médicos que ordene <span class="font-weight-bold">“LA EMPRESA”</span> en los términos de la fracción X del artículo 134 de la Ley Federal de
                </p>
                <p>
                    Trabajo, en el entendido de que el médico que practique dicho examen será designado y retribuido por <span class="font-weight-bold">“LA EMPRESA”</span>.
                </p>
                <p>
                    <span class="font-weight-bold">OCTAVA</span>.- <span class="font-weight-bold">“LA EMPRESA”</span> inscribirá al <span class="font-weight-bold">“TRABAJADOR”</span> en el Instituto Mexicano del Seguro Social, por lo que las partes se sujetarán en lo relativo a riesgos profesionales, enfermedades no profesionales y demás prestaciones relativas a las disposiciones de la Ley del Seguro Social, quedando en consecuencia liberada <span class="font-weight-bold">“LA EMPRESA”</span> de todas las responsabilidades que por riesgos profesionales le impone la Ley Federal del Trabajo, de conformidad con el artículo 60 del Ordenamiento Jurídico mencionado.
                </p>
                <p>
                    <span class="font-weight-bold">NOVENA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> reconoce que será responsable en caso de pérdida de herramientas, útiles o enseres que le sean entregados por <span class="font-weight-bold">“LA EMPRESA”</span> para el desempeño de sus labores, previo escrito de entrega y de recibido de las mismas, comprometiéndose a dar buen uso a las mismas, por lo que tendrá la responsabilidad de su valor ante <span class="font-weight-bold">“LA EMPRESA”</span>.
                </p>
                <p>
                    <span class="font-weight-bold">“LA EMPRESA”</span> reconoce que <span class="font-weight-bold">“EL TRABAJADOR”</span> no será responsables del desgaste natural de los útiles y herramientas debido al uso normal de ellas. Si resulta alguna responsabilidad para <span class="font-weight-bold">“EL TRABAJADOR”</span>, quien acordara con <span class="font-weight-bold">“LA EMPRESA”</span> el descuento adecuado y si no hay acuerdo se conviene en deducir del salario del <span class="font-weight-bold">“TRABAJADOR”</span> el 30% sobre el excedente del salario mínimo sucesivamente hasta liquidar el adeudo.
                </p>
                <p>
                    <span class="font-weight-bold">DÉCIMA</span>.- Por cada seis días consecutivos de labores, <span class="font-weight-bold">“EL TRABAJADOR”</span> tendrá derecho a un día de descanso con goce de sueldo. El día de descanso semanal será fijado por <span class="font-weight-bold">“LA EMPRESA”</span> de acuerdo a su programa de producción. En caso de que <span class="font-weight-bold">“EL TRABAJADOR”</span> preste sus servicios en los días de descanso semanal, independientemente del salario que le corresponda por el descanso, recibirá salario doble por el servicio prestado.
                </p>
                <p>
                    <span class="font-weight-bold">DÉCIMA PRIMERA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> percibirá por concepto de vacaciones una remuneración  proporcionada  al tiempo de servicios prestados, con una prima del 25% (veinticinco por ciento) sobre los salarios correspondientes a las mismas, teniendo en cuenta el término de la relación de trabajo con arreglo a lo dispuesto en los artículos 76, 79 y 80 de la Ley Federal del Trabajo.
                </p>
                <p>
                    También percibirá un aguinaldo proporcional al tiempo trabajado, y en caso que el contrato se vuelva indefinido recibirá el equivalente a 15 días de salario por el año trabajado, conforme al párrafo segundo del artículo 87 de dicha Ley.
                </p>
                <p>
                    <span class="font-weight-bold">DÉCIMA SEGUNDA</span>.- <span class="font-weight-bold">“LA EMPRESA”</span> se compromete a proporcionar a <span class="font-weight-bold">“EL TRABAJADOR”</span> los días de descanso obligatorio que establece la Ley Federal del Trabajo y que coincidan con la duración del presente contrato.
                </p>
                <p>
                    <span class="font-weight-bold">DÉCIMA TERCERA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> manifiesta que con esta fecha recibió de <span class="font-weight-bold">“LA EMPRESA”</span> un ejemplar del presente contrato con el cual está conforme con las condiciones aquí convenidas.
                </p>
                <p>
                    <span class="font-weight-bold">DÉCIMA CUARTA</span>.- <span class="font-weight-bold">“EL TRABAJADOR”</span> manifiesta haber recibido de <span class="font-weight-bold">“LA EMPRESA”</span> y leído un ejemplar del Reglamento Interior de Trabajo vigente en <span class="font-weight-bold">“LA EMPRESA”</span>, el cual se compromete a observar y cumplir debidamente.
                </p>
                <p>
                    <span class="font-weight-bold">DÉCIMA QUINTA</span>. Ambas partes convienen en que, llegada la fecha de vencimiento de la vigencia de este contrato, señalada en la cláusula PRIMERA del mismo o, en su caso, la fecha de conclusión de los trabajos para los cuales es contratado <span class="font-weight-bold">“EL TRABAJADOR”</span>, se dará por terminado el presente contrato, sin necesidad de aviso ni de ningún otro requisito y cesarán todos sus efectos, por lo que el trabajador únicamente tendrá derecho al pago de su finiquito laboral que comprenderá Aguinaldo, Vacaciones y prima vacacional de manera proporcional al tiempo trabajado.
                </p>
                <p>
                    Lo anterior, con excepción de que se verifique el supuesto previsto en el párrafo segundo de la cláusula PRIMERA del presente contrato, en cuyo caso, el presente contrato concluirá una vez que se hayan concluido o terminado los trabajos señalados en la declaración, I, inciso e) del mismo, sin necesidad de aviso ni de ningún otro requisito y cesarán todos sus efectos, por lo que el trabajador únicamente tendrá derecho al pago de su finiquito laboral que comprenderá aguinaldo, vacaciones y prima vacacional de manera proporcional al tiempo trabajado.
                </p>
                <p>
                    Para constancia se extiende y firma el presente contrato por duplicado, en la ciudad de Tijuana, Baja California, el día <span class="text-underline-blue">@isset($user->fecha_de_ingreso) {{$user->fecha_de_ingreso->format('j \d\e F \d\e\l Y')}}@else FECHA CONTRATACION @endisset</span>.
                </p>
            </div>
            <div class="text-center pt-4">
                <div style="position: absolute; left: 150px;">
                    <p class="font-weight-bold pb-5">"LA EMPRESA":</p>
                    __________________________
                    <p class="text-underline-blue p-0">
                        @isset($user->company)
                            {{$user->company->nombre_de_la_compañia}}
                        @else
                            EMPRESA
                        @endisset
                    </p>
                </div>
                <div style="position: absolute; right: 150px;">
                    <p class="font-weight-bold pb-5">"EL TRABAJADOR":</p>
                    __________________________
                    <p class="text-underline-blue p-0">
                        @isset($user->name)
                            {{$user->name}}
                        @else
                            COLABORADOR
                        @endisset
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
