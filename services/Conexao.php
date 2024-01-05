<?php
    class Conexao {
		public function conectar() {
			$servername = "localhost"; //variável que recebe o nome ou ip do servidor
			$database = "ccbvilaalpina_sistemas"; //variável que recebe o nome da base de dados
			// $username = "ccbvilaalpina_admin"; //variável que recebe o usuário/login da conexão do servidor ou base de dados
			$username = "root"; //variável que recebe o usuário/login da conexão do servidor ou base de dados
			$password = ""; //variável que recebe a senha da conexão do servidor ou base de dados
			// $password = "vila@2023@alpina"; //variável que recebe a senha da conexão do servidor ou base de dados

			$conn = new mysqli($servername, $username, $password, $database);

			if ($conn->connect_error) {
				echo ("Erro na conexão: " . $conn->connect_error);
			} else {
				//echo "Conectado com Sucesso";
			}
		}
	}