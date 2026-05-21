<?php
    class Conexao {
        // Armazena a instância da conexão para garantir o Singleton
        private static $conn = null;

        /**
         * Estabelece ou recupera a conexão única com o banco de dados
         * @return PDO
         */
        public static function conectar() {
            if (self::$conn === null) {
                // Detecta se está em produção (Hostinger) ou local
                $is_production = isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['HTTP_HOST'] !== '127.0.0.1';

                // Prioriza variáveis de ambiente (Docker, CI, etc.)
                $env_host = getenv('DB_HOST');
                $env_dbname = getenv('DB_NAME');
                $env_user = getenv('DB_USER');
                $env_pass = getenv('DB_PASSWORD');
                $env_port = getenv('DB_PORT');

                try {
                    if ($env_host || $env_dbname || $env_user || $env_pass || $env_port) {
                        $host = $env_host ?: "localhost";
                        $dbname = $env_dbname ?: "gradly";
                        $usuario = $env_user ?: "root";
                        $senha = $env_pass ?: "";
                        $port = $env_port ?: "3306";
                    } elseif ($is_production) {
                        // DADOS DA HOSTINGER (Substitua pelos seus reais)
                        $host    = "localhost"; 
                        $dbname  = "u123456789_purple"; 
                        $usuario = "u123456789_user";
                        $senha   = "SuaSenhaSeguraAqui";
                        $port    = "3306";
                    } else {
                        // DADOS LOCAL (XAMPP / WAMP)
                        $host    = "localhost";
                        $dbname  = "gradly";
                        $usuario = "root";
                        $senha   = "12345678";
                        $port    = "3306";
                    }

                    $dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";

                    // Configurações de segurança e performance
                    $opcoes = [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false, // Melhora a segurança contra SQL Injection
                    ];

                    self::$conn = new PDO($dsn, $usuario, $senha, $opcoes);

                } catch (PDOException $e) {
                    if ($is_production) {
                        error_log("Erro de conexão: " . $e->getMessage());
                        die("Erro ao conectar ao banco de dados. Tente novamente mais tarde.");
                    } else {
                        die("Erro técnico: " . $e->getMessage());
                    }
                }
            }
            return self::$conn;
        }

        /**
         * Executa comandos SQL estáticos (sem parâmetros externos)
         * @param string $query
         * @return PDOStatement
         */
        public static function executar($query) {
            $db = self::conectar();
            return $db->query($query);
        }

        /**
         * Executa comandos SQL protegidos com Prepared Statements
         * @param string $query
         * @param array $parametros
         * @return PDOStatement
         */
        public static function executarComParametros($query, $parametros = []) {
            $db = self::conectar();
            $stmt = $db->prepare($query);

            if (!empty($parametros)) {
                foreach ($parametros as $chave => $valor) {
                    // Identificação automática do tipo de dado
                    $tipo = PDO::PARAM_STR;
                    if (is_int($valor))  $tipo = PDO::PARAM_INT;
                    if (is_bool($valor)) $tipo = PDO::PARAM_BOOL;
                    if (is_null($valor)) $tipo = PDO::PARAM_NULL;

                    $stmt->bindValue($chave, $valor, $tipo);
                }
            }

            $stmt->execute();
            return $stmt;
        }
    }
?>