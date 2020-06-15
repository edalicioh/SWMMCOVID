<?php

return [
    'TYPE_COMPANY' => [
        'ADMIN' => 0,
        'PREFEITORA' => 1,
        'EMPRESA' => 2,
        'DEFESA_CIVIL' => 3,
    ],
    'WORK_STATUS' => [
        0 => 'Segurança privada/pública',
		1 => 'Servidor Público demais áreas',
		2 => 'Sáude Pública Municipal',
        3 => 'Autonomos',
        4 => 'Trabalhador da iniciativa privada',
		4 => 'Outros: estudantes, estagiários etc',
    ],
    'STATUS' => [
        0  => 'Não detectável (negativo)'  ,
        1  => 'Positivo'    ,
        2  => 'Tratamento Uti'      ,
        3  => 'Tratamento Enfermaria',
        4  => 'Tratamento Monitoramento domiciliar',
        5  => 'Recuperado',
        6  => 'Óbito',
    ],

    'ATTENDANCES' => [
        1 => 'Não Detectável',
        2 => 'Confirmado',
        3 => 'Aguardando Resultado',
        4 => 'Outros'
    ],

    'POSSIBLE_LOCATION' => [
        0   => 'NIR',
        1   => 'VIAGEM INTERNACIONAL',
        2   => 'VIAGEM DOMÉSTICA',
        3   => 'CONTATO COM CONTAMINADO FORA DA CIDADE',
        4   => 'CONTATO COM PESSOA QUE VEIO DO EXTERIOR',
        5   => 'LOCAL DE TRABALHO',
        6   => 'EVENTO / SHOW',
        7   => 'OUTROS'
    ],

    'EXAM_STATUS' => [
        0 => 'Hospital',
        1 => 'Lar',
        2 => 'Laboratorio'
    ]
];







