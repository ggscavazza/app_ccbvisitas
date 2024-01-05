<?php
    class Igreja {
        public $table_prefix;
        private Conexao $conn;

        public function criarIgreja($dados) {
            $busca_id = $this->buscarUmaIgreja($dados);
            
            if ($busca_id === false) {
                $bd = new $this->conn;
                $bd->conectar();

                if (gettype($dados) == 'array') {                    
                    $colunas_inserir = "";
                    $valores_inserir = "";
                    $ultima_chave = array_key_last($dados);
                    
                    foreach ($dados as $coluna => $valor) {
                        $colunas_inserir .= "{$coluna}, ";
                        $valores_inserir .= "'{$valor}', ";                        
                    }
                    
                    $colunas_inserir .= "status";
                    $valores_inserir .= "'1'";
                    

                    $updt = "INSERT INTO {$this->table_prefix}_igrejas ({$colunas_inserir}) VALUES ({$valores_inserir})";

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

        public function editarIgreja($id, $dados) {
            $busca_id = $this->buscarUmaIgreja($id);
            
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

                    $updt = "UPDATE {$this->table_prefix}_igrejas SET {$campos_editar} WHERE id='{$id}'";

                    $bd->query($updt);
                    $bd->close();

                    return true;
                } else {
                    return false;
                }
            }
        }

        public function inativarIgreja($id) {
            $busca_id = $this->buscarUmaIgreja($id);
            
            if ($busca_id === false) {   
                return false;
            } else {
                $bd = new $this->conn;
                $bd->conectar();

                $updt = "UPDATE {$this->table_prefix}_igrejas SET status='0' WHERE id='{$id}'";

                $bd->query($updt);
                $bd->close();

                return true;                
            }
        }

        public function buscarIgreja() {
            $bd = new $this->conn;
            $bd->conectar();
            
            $sql = "SELECT * FROM {$this->table_prefix}_igrejas";
            
            $query = $bd->query($sql);
            $num = $bd->num_rows($query);

            if ($num > 0) {
                $bd->close();

                return $query;
            } else {
                $bd->close();

                return false;
            }
        }

        public function buscarUmaIgreja($id=null, $dados=null) {
            $bd = new $this->conn;
            $bd->conectar();
            
            if (!is_null($id)) {
                $sql = "SELECT * FROM {$this->table_prefix}_igrejas WHERE id='{$id}'";
            } else {
                $nome = addslashes($dados['nome']);
                $cidade = addslashes($dados['cidade']);
                $responsavel = addslashes($dados['responsavel']);

                $sql = "SELECT * FROM {$this->table_prefix}_igrejas WHERE nome='{$nome}' AND cidade='{$cidade}' AND responsavel='{$responsavel}'";
            }            
            
            $query = $bd->query($sql);
            $num = $bd->num_rows($query);

            if ($num > 0) {
                $row = $bd->fetch_assoc($query);                
                $bd->close();

                return $row;
            } else {
                $bd->close();

                return false;
            }
        }
    }