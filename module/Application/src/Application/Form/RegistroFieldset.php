<?php

namespace Application\Form;

use Application\Entity\Registro;
use Zend\Form\Fieldset;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class RegistroFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {

        parent::__construct('registro');

        //$this->setHydrator(new ClassMethodsHydrator(false))
        // 	  ->setObject(new Registro());
        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setObject(new Registro());


        $this->setLabel('Registro');

        $this->add(array(
            'name' => 'provincia',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                //'required' => 'required',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Provincia',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'CABA' => 'CABA',
                    'BuenosAires' => 'Prov. Buenos Aires',
                ),
            )
        ));

        $array = array(
            array('nombre', 'Nombre de Organización'),
            array('localidad', 'Localidad'),
            array('direccion', 'Dirección'),
            array('cpostal', 'C. Postal'),
            array('telefono', 'Teléfono'),
            array('email', 'Correo Electrónico'),
            array('web', 'Página web'),
            array('blog', 'Blog'),
            array('rsocial', 'Redes Sociales'),
            array('referente', 'Nombre del Referente'),
            array('referentel', 'Celular del Referente'),
            array('npj', 'Nº de Inscripción'),
            array('ncuit', 'CUIT'),
            array('perfilotro', 'Detalle Otro' ),
            array('tipoOtro', 'Detalle Otro'),
            array('creado', 'Año de creación'),
                        
            array('cantIntegrantes', 'Cantidad de Integrantes'),
            array('cantMilitantes', 'Cantidad de Voluntarios Militantes'),
            array('cantProfesionales', 'Cantidad de Profesionales Rentados'),
            array('cantOcacionales', 'Cantidad de Colaboradores Ocasionales o para Proyectos Especiíficos'),
            
            array('actividadesOtro', 'Detalle Otros'),
            array('cantParticipantes', 'Cantidad Total de Participantes'),
            array('espacioInicio', 'Año de Inicio'),
            array('espacioTipoCompartido', 'Detalle con quiénes si es compartido'),
            
            array('espacioMtsCubiertos', 'Cubiertos en mts.2'),
            array('espacioMtsDescubiertos', 'Descubiertos en mts.2'),
            array('sectoresCubiertos', 'Cantidad de sectores cubiertos'),
            array('sectoresDescubiertos', 'Cantidad de sectores desubiertos'),
            array('sectoresOtro', 'Detalle Otros'),
            
            array('salaTeatroMts', 'Dimensiones en mts.2'),
            array('salaTeatroButacas', 'Cantidad de butacas'),
            array('salaCineMts', 'Dimensiones en mts.2'),
            array('salaCineButacas', 'Cantidad de butacas'),
            array('salaRadioMts', 'Dimensiones en mts.2'),
            array('salaRadioEquip', 'Detalle equipamiento'),
            array('salaGrabaMts', 'Dimensiones en mts.2'),
            array('salaGrabaEquip', 'Detalle equipamiento'),
            
            array('equipAVOtro', 'Detalle otros'),
            array('equipInformaticoOtro', 'Detalle otros'),
            array('equipSonidoOtro', 'Detalle otros'),
            array('equipEscenOtro', 'Detalle otros'),
            array('equipOtroOtro', 'Detalle otros'),
            
            array('produccionAVOtro', 'Detalle otros'),
            array('produccionRadioNombre', 'Nombre'),
            array('produccionRadioOtro', 'Detalle otros'),
            array('produccionMultimediaOtro', 'Detalle otros'),
            array('produccionGraficaOtro', 'Detalle otros'),
            
            array('talleresArtisticos', 'Talleres Artísticos Varios (detalle)'),
            array('talleresDidacticos', 'Talleres Didácticos (detalle)'),
            array('talleresComunicPopular', 'Talleres de Comunicación Popular (detalle)'),
            array('talleresOficio', 'Talleres de Oficio (detalle)'),
            array('talleresOtros', 'Detalle Otros Talleres'),
            
            array('espectaculosOtro', 'Detalle otros'),
            array('muestrasOtro', 'Detalle otros'),
            
            
            
            
           
        );

        foreach ($array as $element) {
            $this->add(array(
                'name' => $element[0],
                'options' => array(
                    'label' => $element[1],
                    'label_attributes' => array(
                        'class' => 'col-sm-2 control-label'
                    ),
                ),
                'attributes' => array(
                    'id' => $element[0],
                    'type' => 'text',
                    //'required' => 'required',
                    'class' => 'form-control'
                )
            ));
        }
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'tienePJ',
            'options' => array(
                'label' => '¿Tiene Personería Jurídica?',
                'use_hidden_element' => true,
                'checked_value' => 'si',
                'unchecked_value' => 'no'
            ),
            'attributes' => array (
                'onchange' => 'toggleTienePJ(this)',
                'class' => 'col-sm-1',
                'id' =>'tienePJ'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'wifi',
            'options' => array(
                'label' => '¿Ofrece Wifi?',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'use_hidden_element' => true,
                'checked_value' => 'si',
                'unchecked_value' => 'no'
            ),
            'attributes' => array (
                'class' => 'col-sm-1',
                'id' =>'wifi'
            )
        ));

        //
        $this->add(array(
            'name' => 'perfil',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'perfil',
                //'required' => 'required',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Perfil principal de la Organización',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'centroCultural' => 'Centro Cultural',
                    'bibliotecaPopular' => 'Biblioteca Popular',
                    'clubSocialDeportivo' => 'Club Social/Deportivo',
                    'centroComunitario' => 'Centro Comunitario',
                    'grupoComunitario' => 'Grupo Comunitario',
                    'medioComunicacionComunitario' => 'Medio de Comunicación Comunitario',
                    'orgEconomíaSocial' => 'Organización de la Economía Social',
                    'sociedadFomento' => 'Sociedad de Fomento',
                    'institucionEducativa' => 'institución Educativa',
                    'otro' => 'Otro',
                ),
            )
        ));
        
        
        $this->add(array(
            'name' => 'tipoConPJ',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'tipoConPJ',
                //'required' => 'required',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Tipo de Organización',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'cooperativa' => 'Cooperativa',
                    'mutual' => 'Mutual',
                    'asociacionCivil' => 'Asociación Civil',
                    'fundacion' => 'Fundación',
                    'comunidadesIndigenas' => 'Comunidades Indígenas',
                    'otro' => 'Otro',
                )
            )
        ));

        $this->add(array(
            'name' => 'tipoSinPJ',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'tipoSinPJ',
                //'required' => 'required',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Tipo de Organización',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'centroComunitario' => 'Centro Comunitario',
                    'academiaEscuelaArte' => 'Academina / Escuela de Artes',
                    'colectivoArtistas' => 'Colectivo de Artistas',
                    'colectivoComunicacion' => 'Colectivo de Comunicación',
                    'colectivoEducacionPopular' => 'Colectivo de Educación Popular',
                    'otro' => 'Otro',
                )
            )
        ));
        $this->add(array(
            'name' => 'alcance',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'alcance',
                //'required' => 'required',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Alcance Territorial',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'nacional' => 'Nacional',
                    'regional' => 'Regional (mas de una provincia)',
                    'provincial' => 'Provincial',
                    'municipal' => 'Municipal',
                    'barrialComunal' => 'Barrial / Comunal'
                )
            )
        ));
        
        
        $this->add(array(
            'name' => 'intervencion',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'intervencion',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Àreas de Intervención Estratégica',
                'label_attributes' => array(
                    'class' => 'col-sm-4 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'proveedorasBienesServiciosBasicos' => 'Proveedoras de Bienes y Servicios Básicos',
                    'promocionDesarrollo' => 'Promoción y Desarrollo',
                    'Investigacion' => 'Investigación',
                    'DifusionConcientizacion' => 'Difusión y Concientización',
                    'DefensaDerechos' => 'Defensa de Derechos',
                    'DesarrolloProductivo' => 'Desarrollo Productivo',
                    'Fomento' => 'Fomento',
                    'Transparencia' => 'Transparencia',
                    'Otros' => 'Otros'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'actividades',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'actividades',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Principales Actividades Impulsadas',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'talleres' => 'Talleres',
                    'capacitaciones' => 'Capacitaciones',
                    'conferencias' => 'Conferencias',
                    'charlas' => 'Charlas',
                    'espectaculos' => 'Espectáculos',
                    'recitales' => 'Recitales',
                    'muestras' => 'Muestras',
                    'exposiciones' => 'Exposiciones',
                    'ferias' => 'Ferias',
                    'festivales' => 'Festivales',
                    'econoSocial' => 'Emprendimientos de la Economía Social',
                    'informativos' => 'Emprendimientos Informativos/Comunicacionales'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'destinatarios',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'destinatarios',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Público Destinatario',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'publicoGeneral' => 'Público en General',
                    'agentesMultiplicadores' => 'Agentes Multiplicadores',
                    'orgSociales' => 'Organizaciones Sociales para el trabajo en red',
                    'ninosAdolescentesFamilia' => 'Niños y Adolescentes; Familia',
                    'jovenes' => 'Jóvenes',
                    'mayores' => 'Adultos Mayores',
                    'artistasArtesanos' => 'Artistas y Artesanos',
                    'trabajadores' => 'Trabajadores Ocupados, Trabajadores Desocupados',
                    'colectividades' => 'Colectividades',
                    'comIndigenas' => 'Comunidades Indígenas',
                    'especiales' => 'Personas con Capacidades Especiales',
                    'pobCarcelaria' => 'Población Carcelaria',
                )
            )
        ));
        
        $this->add(array(
            'name' => 'espacio',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'espacio',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Público Destinatario',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'jovenes' => 'Jóvenes',
                )
            )
        ));


        $this->add(array(
            'name' => 'descActividades',
            'options' => array(
                'label' => 'Describa las 3 mas importantes',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label'
                ),
            ),
            'attributes' => array(
                'id' => 'descActividades',
                'type' => 'textarea',
                //'required' => 'required',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'espacioInfo',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'espacioInfo',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Espacio Físico para el Desarrollo de Actividades',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'propietario' => 'Propietario',
                    'alquilado' => 'Alquilado',
                    'enComodato' => 'en Comodato'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'espacioTipoUso',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'espacioTipoUso',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Tipo de Uso',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'exclusivo' => 'En este espacio funciona solamente esta organización',
                    'compartido' => 'Funcionan otras instituciones',
                )
            )
        ));
        
        
        
        $this->add(array(
            'name' => 'sectores',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'sectores',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Sectores existentes en el espacio',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'salaReunion' => 'Sala de Reuniones',
                    'salaLectura' => 'Sala de Lectura',
                    'salaExpo' => 'Sala de Exposiciones',
                    'salaActividades' => 'Sala Taller o de Actividades',
                    'salaTeatro' => 'Sala de Teatro',
                    'salaCine' => 'Sala de Cine',
                    'sum' => 'S.U.M.',
                    'cancha' => 'Cancha deportiva',
                    'patio' => 'Patio al aire Libre',
                    'espVerde' => 'Espacio Verde',
                    'estRadio' => 'Estudio de Radio',
                    'estGrabacion' => 'Estudio de Grabación y/o TV',
                    'bar' => 'Espacio de Bar',
                )
            )
        ));
        
        $this->add(array(
            'name' => 'equipAV',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'equipAV',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Audiovisual',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'camVideoD' => 'Cámara de Video Digital',
                    'camFotoD' => 'Cámara Fotográfica Digital',
                    'pantalla' => 'Pantalla',
                    'proyector' => 'Proyector',
                    'dvd' => 'Reproductor de DVD',
                )
            )
        ));
        $this->add(array(
            'name' => 'equipInformatico',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'equipInformatico',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Informático',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'portatil' => 'Computadora Portatil',
                    'pc' => 'Computadora de Escritorio',
                    'scanner' => 'Scanner',
                    'impresora' => 'Impresora',
                )
            )
        ));
        $this->add(array(
            'name' => 'equipSonido',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'equipSonido',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'de Sonido',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'consola' => 'Consola',
                    'amplificador' => 'Amplificador',
                    'compactera' => 'Compactera',
                    'parlantes' => 'Parlantes',
                    'microfonos' => 'Micrófonos',
                )
            )
        ));
        $this->add(array(
            'name' => 'equipEscen',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'equipEscen',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Escenográfico',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'luces' => 'Luces',
                    'escenario' => 'Escenario',
                    'matCircense' => 'Material Circense',
                )
            )
        ));
        $this->add(array(
            'name' => 'equipOtro',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'equipOtro',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Miscelaneos',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'gacebos' => 'Gacebos',
                    'fotocopiadora' => 'Fotocopiadora',
                    'imprenta' => 'Imprenta',
                )
            )
        ));
        
        
        $this->add(array(
            'name' => 'internet',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'internet',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Acceso a Internet',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'sin' => 'Sin Acceso a Internet',
                    'cableRed' => 'por Cable de Red',
                    'modem' => 'por Modem',
                    'satelital' => 'por Satélite',
                    'telefono' => 'por Línea Telefónica',
                )
            )
        ));
        $this->add(array(
            'name' => 'produccionAV',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'produccionAV',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Producciones Audiovisuales',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'cortos' => 'Armado de Cortos',
                    'documentales' => 'Documentales',
                    'ficciones' => 'Ficciones',
                    'registro' => 'Registro de Actividades',
                )
            )
        ));
        $this->add(array(
            'name' => 'produccionRadio',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'produccionRadio',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Producciones Radiales',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'programa' => 'Programa',
                    'informativo' => 'Informativo',
                    'radioTeatro' => 'Radio Teatro',
                )
            )
        ));
        $this->add(array(
            'name' => 'produccionMultimedia',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'produccionMultimedia',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Producciones Multimediales',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'canalWeb' => 'Canal web',
                    'newsletter' => 'Newsletter',
                    'blogspot' => 'Blogspot',
                    'canalYoutube' => 'Canal Youtube',
                )
            )
        ));
        $this->add(array(
            'name' => 'produccionGrafica',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'produccionGrafica',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Contenidos Gráficos',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'revistas' => 'Revistas',
                    'periodicos' => 'Periódicos',
                    'libros' => 'Libros',
                )
            )
        ));
        $this->add(array(
            'name' => 'espectaculos',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'espectaculos',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Espectáculos',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'teatroComunit' => 'Teatro Comunitario',
                    'murga' => 'Murga, Comparsa y Corso',
                    'circo' => 'Circo',
                    'cine' => 'Ciclos de Cine',
                    'recitales' => 'Recitales',
                    'festivales' => 'Festivales',
                    'orquesta' => 'Orquesta Infanto-Juvenil',
                )
            )
        ));
        $this->add(array(
            'name' => 'muestras',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'muestras',
                'multiple' => 'multiple',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Muestras, Ferias, Otros',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                //'empty_option' => 'Seleccionar...',
                'value_options' => array(
                    'feriaEconSocial' => 'Feria de Economía Social',
                    'expo' => 'Exposiciones',
                    'intervenciones' => 'Intervenciones',
                    'museo' => 'Museos',
                    'itinerante' => 'Muestras Itinerantes',
                    'peña' => 'Peña',
                    'huertaOrganica' => 'Huerta Orgánica',
                )
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'nombre' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'Zend\Filter\StripTags'),
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\StringLength',
                        'options' => array(
                            'min' => 3,
                            'max' => 50,
                        ),
                    ),
                ),
            ),
            'email' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'Zend\Filter\StripTags'),
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
                'validators' => array(array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5,
                            'max' => 255,
                            'messages' => array(
                                \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email address format is invalid'
                            )
                        )
                    )
                )
            )
        );
    }

}
