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
        5 => 'Outros: estudantes, estagiários etc',
        6 => 'Não informado'
    ],
    'STATUS' => [
        0  => 'Não detectável (negativo)'  ,
        1  => 'Positivo',
        4  => 'Tratamento',
        5  => 'Recuperado',
        6  => 'Óbito',
        7  => 'Aguardando Resultado',
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
        7   => 'OUTROS',
        8   => 'não informado'
    ],

    'EXAM_STATUS' => [
        0 => 'Hospital',
        2 => 'Laboratorio',
        3 => 'Locais de Coleta Movel',
        4 => 'USB / UPA',
        5 => 'Secretaria da Saúde',
        1 => 'Lar',
    ],

    'populacao_camboriu' => 82.989,
];







