<?php

return [
			'class' => 'yii\db\Connection',
			'dsn' => 'pgsql:host=127.0.0.1;dbname=lambda;port=5432',
			'username' => 'ifw',
			'password' => 'mYyTcVm4jMtkXCXE2ZCcBno',
			'charset' => 'utf8',
                        'attributes' => [
                                
                                PDO::ATTR_ORACLE_NULLS  => PDO::NULL_TO_STRING,
                            ],
			'schemaMap' => [
				'pgsql'=> [
					'class' => 'yii\db\pgsql\Schema',
					'defaultSchema' => 'public'
				],
			],
			'on afterOpen' => function ($event) {
				//$event->sender->createCommand("SET search_path TO communication;")->execute();
			},
];


