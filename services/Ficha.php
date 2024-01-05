<?php
    class Ficha {
        public $table_prefix;
        private Conexao $conn;

        public function criarFicha($dados) {
            $busca_id = $this->buscarUmaFicha($dados);
            
            if ($busca_id === false) {   
                $bd = new $this->conn;
                $bd->conectar();

                if (gettype($dados) == 'array') {                    
                    $colunas_inserir = "";
                    $valores_inserir = "";
                    $ultima_chave = array_key_last($dados);
                    
                    foreach ($dados as $coluna => $valor) {
                        if ($coluna != $ultima_chave) {
                            $colunas_inserir .= "{$coluna}, ";
                            $valores_inserir .= "'{$valor}', ";
                        } else {                            
                            $colunas_inserir .= "{$coluna}";
                            $valores_inserir .= "'{$valor}'";
                        }
                    }
                    
                    $colunas_inserir .= "status";
                    $valores_inserir .= "'1'";
                    

                    $updt = "INSERT INTO {$this->table_prefix}_fichas ({$colunas_inserir}) VALUES ({$valores_inserir})";

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

        public function editarFicha($id, $dados) {
            $busca_id = $this->buscarUmaFicha($id);
            
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

                    $updt = "UPDATE {$this->table_prefix}_fichas SET {$campos_editar} WHERE id='{$id}'";

                    $bd->query($updt);
                    $bd->close();

                    return true;
                } else {
                    return false;
                }
            }
        }

        public function inativarFicha($id) {
            $busca_id = $this->buscarUmaFicha($id);
            
            if ($busca_id === false) {   
                return false;
            } else {
                $bd = new $this->conn;
                $bd->conectar();

                $updt = "UPDATE {$this->table_prefix}_fichas SET status='0' WHERE id='{$id}'";

                $bd->query($updt);
                $bd->close();

                return true;                
            }
        }

        public function buscarFichas() {
            $bd = new $this->conn;
            $bd->conectar();
            
            $sql = "SELECT * FROM {$this->table_prefix}_fichas";
            
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

        public function buscarUmaFicha($id) {
            $bd = new $this->conn;
            $bd->conectar();
            
            $sql = "SELECT * FROM {$this->table_prefix}_fichas WHERE id='{$id}'";
                        
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