<?php
    class Usuario {
        public $table_prefix;
        private Conexao $conn;

        public function criarNovoUsuario ($dados) {
            $busca_id = $this->buscarUmUsuario($dados);
            
            if ($busca_id === false) {   
                $bd = new $this->conn;
                $bd->conectar();

                if (gettype($dados) == 'array') {
                    $token = "";                    
                    $colunas_inserir = "";
                    $valores_inserir = "";
                    $ultima_chave = array_key_last($dados);
                    
                    foreach ($dados as $coluna => $valor) {
                        $colunas_inserir .= "{$coluna}, ";
                        $valores_inserir .= "'{$valor}', ";

                        if ($coluna == "email" || $coluna == "login" || $coluna == "senha") {
                            $token .= "{$valor}";
                        }
                    }
                    
                    $token = md5($token.date('YmdHis'));

                    $colunas_inserir .= "token, status";
                    $valores_inserir .= "'{$token}', '1'";
                    

                    $updt = "INSERT INTO {$this->table_prefix}_usuarios ({$colunas_inserir}) VALUES ({$valores_inserir})";

                    $bd->query($updt);
                    $bd->close();

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function editarUsuario ($token, $dados) {
            $busca_id = $this->buscarUmUsuario($token);
            
            if ($busca_id === false) {   
                return false;
            } else {
                $bd = new $this->conn;
                $bd->conectar();

                if (gettype($dados) == 'array') {                    
                    $campos_editar = "";
                    $ultima_chave = array_key_last($dados);
                    
                    foreach ($dados as $coluna => $valor) {
                        if ($coluna != $ultima_chave) {
                            $campos_editar .= "`{$coluna}`='{$valor}', ";
                        } else {
                            $campos_editar .= "`{$coluna}`='{$valor}'";
                        }
                    }

                    $updt = "UPDATE {$this->table_prefix}_usuarios SET {$campos_editar} WHERE id='{$busca_id}'";

                    $bd->query($updt);
                    $bd->close();

                    return true;
                } else {
                    return false;
                }
            }
        }

        public function inativarUsuario ($token) {
            $busca_id = $this->buscarUmUsuario($token);
            
            if ($busca_id === false) {   
                return false;
            } else {
                $bd = new $this->conn;
                $bd->conectar();

                $updt = "UPDATE {$this->table_prefix}_usuarios SET status='0' WHERE id='{$busca_id}'";

                $bd->query($updt);
                $bd->close();

                return true;                
            }
        }

        public function buscarUsuario() {
            $bd = new $this->conn;
            $bd->conectar();
            
            $sql = "SELECT * FROM {$this->table_prefix}_usuarios";
            
            $query = $bd->query($sql);
            $num = $bd->num_rows($query);

            if ($num > 0) {
                $row = $bd->fetch_assoc($query);

                $id = $row['id'];
                $bd->close();

                return $id;
            } else {
                $bd->close();

                return false;
            }
        }

        public function buscarUmUsuario ($token=null, $dados=null) {
            $bd = new $this->conn;
            $bd->conectar();
            
            if (!is_null($token)) {
                $sql = "SELECT * FROM {$this->table_prefix}_usuarios WHERE token='{$token}'";
            } else {
                $email = addslashes($dados['email']);
                $login = md5($dados['login']);

                $sql = "SELECT * FROM {$this->table_prefix}_usuarios WHERE email='{$email}' AND login='{$login}'";
            }
            
            $query = $bd->query($sql);
            $num = $bd->num_rows($query);

            if ($num > 0) {
                $row = $bd->fetch_assoc($query);

                $id = $row['id'];
                $bd->close();

                return $id;
            } else {
                $bd->close();

                return false;
            }
        }
    }