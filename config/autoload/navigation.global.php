<?php
return array(
    // ...
    'navigation' => array(
         'default' => array(
             array(
                 'label' => '',
                 'route' => 'listado',
                 'icon' => 'glyphicon glyphicon-home',
                 'class'=> 'navbar-brand'
             ),
             
             array(
                 'label' => 'Tablas',
                 'route' => 'crud',
                 'resource'=>'crud',
                 'privilege' => 'index',
                 'pages' => array(
                     array(
                         'label' => 'Listar Organismos',
                         'route' => 'crud',
                         'action' => 'listar-organismos',
                        'resource'=>'crud',
                        'privilege' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt',
                         'header' => 'tablas para la solicitud',
                     ),array(
                         'label' => 'Listar formas de pedido',
                         'route' => 'crud',
                         'action' => 'listar-formas-de-pedido',
                        'resource' => 'crudplus',
                        'privilege' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt',
                     ),array(
                         'label' => 'Listar puntos de ingreso',
                         'route' => 'crud',
                         'action' => 'listar-puntos-de-ingreso',
                        'resource' => 'crudplus',
                        'privilege' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt'
                     ),array(
                         'label' => 'Listar Feriados',
                         'route' => 'crud',
                         'action' => 'listar-feriados',
                        'resource' => 'crudplus',
                        'privilege' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt'
                     )/*, array(
                         'label' => 'Listar perfiles del solicitante',
                         'route' => 'crud',
                         'action' => 'listar-perfiles',
                        'resource'=>'crud',
                        'privilege' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt',
                         'header' => 'tablas para el solicitante',
                     ), array(
                         'label' => 'Listar profesión/ocupación del solicitante',
                         'route' => 'crud',
                         'action' => 'listar-profesion',
                        'resource'=>'crud',
                        'privilege' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt'
                     )*/
                 )
             ),
             
             
             array(
                 'label' => 'Administración',
                 'route' => 'usuarios',
                 'resource'=>'usuarios',
                 'privilege' => 'index',
                 'pages' => array(
                     array(
                         'label' => 'Listar Usuarios',
                         'route' => 'usuarios',
                         'action' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt',
                     ),array(
                         'label' => 'Crear Usuario',
                         'route' => 'usuarios',
                         'action' => 'crear',
                        'resource'=>'usuarios',
                        'privilege' => 'crear',
                         'icon'  => 'glyphicon glyphicon-pencil',
                         //'divider' => TRUE,
                     )/*,array(
                         'label' => 'Listar Roles',
                         'route' => 'roles',
                         'action' => 'index',
                        'resource'=>'roles',
                        'privilege' => 'index',
                         'icon'  => 'glyphicon glyphicon-list-alt',
                     ),array(
                         'label' => 'Crear Rol',
                         'route' => 'roles',
                         'action' => 'crear',
                        'resource'=>'roles',
                        'privilege' => 'crear',
                         'icon'  => 'glyphicon glyphicon-pencil'
                     )*/
                 )
             ),
             array (
                 'label' => 'Pendientes',
                 'route' => 's',
                 'resource'=>'crud',
                 'privilege' => 'index',
                 'icon' => 'glyphicon glyphicon-warning-sign')
         )
     )
);
