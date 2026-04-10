CREATE DATABASE gradly;
USE gradly;

-- =========== TABELA BASE (HERANÇA) ==============
CREATE TABLE user(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    senha VARCHAR(255),
    dataCadastro DATETIME
);

-- ============= INSTITUIÇÃO ============
CREATE TABLE Instituicao_ensino(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    cnpj VARCHAR(20),
    endereco VARCHAR(255),
    telefone VARCHAR(20)
);

-- =========== GRUPO ==============
CREATE TABLE grupo(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    descricao TEXT,
    dataCriacao DATETIME
);

-- =========== ORIENTADOR ==============
CREATE TABLE orientador(
    id INT PRIMARY KEY,
    areaAtuacao VARCHAR(255),
    titulacao VARCHAR(100),
    FOREIGN KEY (id) REFERENCES user(id)
);

-- =========== ADMINISTRADOR ==============
CREATE TABLE administrador(
    id INT PRIMARY KEY,
    nivelAcesso INT,
    FOREIGN KEY (id) REFERENCES user(id)
);

-- ============ COORDENADOR =============
CREATE TABLE coordenador(
    id INT PRIMARY KEY,
    departamento VARCHAR(255),
    instituicao_id INT,
    FOREIGN KEY (id) REFERENCES user(id),
    FOREIGN KEY (instituicao_id) REFERENCES Instituicao_ensino(id)
);

-- =========== PROJETO TCC ==============
CREATE TABLE projeto_tcc(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    descricao TEXT,
    objetivo TEXT,
    temas VARCHAR(255),
    areas VARCHAR(255),
    estado VARCHAR(50),
    orientador_id INT,
    FOREIGN KEY (orientador_id) REFERENCES orientador(id)
);

-- ========== ALUNO ===============
CREATE TABLE aluno(
    id INT PRIMARY KEY,
    matricula VARCHAR(50),
    curso VARCHAR(100),
    grupo_id INT,
    projeto_id INT,
    FOREIGN KEY (id) REFERENCES user(id),
    FOREIGN KEY (grupo_id) REFERENCES grupo(id),
    FOREIGN KEY (projeto_id) REFERENCES projeto_tcc(id)
);

-- ============ DOCUMENTO =============
CREATE TABLE documento(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    conteudo TEXT,
    dataCriacao DATETIME,
    versao INT,
    projeto_id INT,
    FOREIGN KEY (projeto_id) REFERENCES projeto_tcc(id)
);

-- ============ TAREFA =============
CREATE TABLE tarefa(
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao TEXT,
    estado VARCHAR(50),
    dataInicio DATE,
    dataFim DATE,
    responsavel_id INT,
    projeto_id INT,
    FOREIGN KEY (responsavel_id) REFERENCES aluno(id),
    FOREIGN KEY (projeto_id) REFERENCES projeto_tcc(id)
);

-- ============ COMENTÁRIO =============
CREATE TABLE comentario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    texto TEXT,
    data_criacao DATETIME,
    autor_id INT,
    documento_id INT,
    FOREIGN KEY (autor_id) REFERENCES user(id),
    FOREIGN KEY (documento_id) REFERENCES documento(id)
);

-- =========== REFERÊNCIAS ==============
CREATE TABLE referencias(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    autor VARCHAR(255),
    ano INT,
    tipo VARCHAR(50),
    projeto_id INT,
    FOREIGN KEY (projeto_id) REFERENCES projeto_tcc(id)
);

USE gradly;

-- ================= INSTITUICOES =================
INSERT INTO Instituicao_ensino (id, nome, cnpj, endereco, telefone) VALUES
(1, 'PUCPR', '12345678000101', 'Curitiba - PR', '41999990001'),
(2, 'UTFPR', '12345678000102', 'Curitiba - PR', '41999990002'),
(3, 'UFPR',  '12345678000103', 'Curitiba - PR', '41999990003'),
(4, 'FATEC', '12345678000104', 'São Paulo - SP', '11999990004'),
(5, 'UNINTER', '12345678000105', 'Curitiba - PR', '41999990005');


-- ================= USERS =================
INSERT INTO user (id, nome, email, senha, dataCadastro) VALUES
(1, 'Carlos Silva', 'carlos@gradly.com', '123', NOW()),
(2, 'Maria Souza', 'maria@gradly.com', '123', NOW()),
(3, 'Joao Pereira', 'joao@gradly.com', '123', NOW()),
(4, 'Ana Costa', 'ana@gradly.com', '123', NOW()),
(5, 'Pedro Lima', 'pedro@gradly.com', '123', NOW());


-- ================= GRUPOS =================
INSERT INTO grupo (id, nome, descricao, dataCriacao) VALUES
(1, 'Grupo IA', 'Pesquisa em Inteligência Artificial', NOW()),
(2, 'Grupo Web', 'Desenvolvimento Web', NOW()),
(3, 'Grupo Mobile', 'Aplicações Mobile', NOW()),
(4, 'Grupo Dados', 'Ciência de Dados', NOW()),
(5, 'Grupo Segurança', 'Segurança da Informação', NOW());


-- ================= ORIENTADORES =================
INSERT INTO orientador (id, areaAtuacao, titulacao) VALUES
(1, 'Inteligência Artificial', 'Doutor'),
(2, 'Desenvolvimento Web', 'Mestre'),
(3, 'Mobile', 'Doutor'),
(4, 'Banco de Dados', 'Mestre'),
(5, 'Segurança', 'Doutor');


-- ================= ADMINISTRADORES =================
INSERT INTO administrador (id, nivelAcesso) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 2),
(5, 1);


-- ================= COORDENADORES =================
INSERT INTO coordenador (id, departamento, instituicao_id) VALUES
(1, 'Engenharia de Software', 1),
(2, 'Sistemas de Informação', 2),
(3, 'Ciência da Computação', 3),
(4, 'Tecnologia', 4),
(5, 'Computação', 5);


-- ================= PROJETOS =================
INSERT INTO projeto_tcc (id, titulo, descricao, objetivo, temas, areas, estado, orientador_id) VALUES
(1, 'Sistema de IA', 'Projeto de IA', 'Criar IA', 'IA', 'Tecnologia', 'Em andamento', 1),
(2, 'Sistema Web', 'Projeto Web', 'Criar sistema web', 'Web', 'Tecnologia', 'Em andamento', 2),
(3, 'App Mobile', 'Projeto Mobile', 'Criar app', 'Mobile', 'Tecnologia', 'Planejado', 3),
(4, 'Banco de Dados', 'Projeto BD', 'Criar BD', 'Dados', 'Tecnologia', 'Em andamento', 4),
(5, 'Segurança Web', 'Projeto Segurança', 'Criar sistema seguro', 'Segurança', 'Tecnologia', 'Planejado', 5);


-- ================= ALUNOS =================
INSERT INTO aluno (id, matricula, curso, grupo_id, projeto_id) VALUES
(1, '2023001', 'Engenharia de Software', 1, 1),
(2, '2023002', 'Sistemas de Informação', 2, 2),
(3, '2023003', 'Ciência da Computação', 3, 3),
(4, '2023004', 'Engenharia de Software', 4, 4),
(5, '2023005', 'Sistemas de Informação', 5, 5);


-- ================= DOCUMENTOS =================
INSERT INTO documento (id, titulo, conteudo, dataCriacao, versao, projeto_id) VALUES
(1, 'Documento IA', 'Conteudo IA', NOW(), 1, 1),
(2, 'Documento Web', 'Conteudo Web', NOW(), 1, 2),
(3, 'Documento Mobile', 'Conteudo Mobile', NOW(), 1, 3),
(4, 'Documento BD', 'Conteudo BD', NOW(), 1, 4),
(5, 'Documento Segurança', 'Conteudo Segurança', NOW(), 1, 5);


-- ================= TAREFAS =================
INSERT INTO tarefa (id, descricao, estado, dataInicio, dataFim, responsavel_id, projeto_id) VALUES
(1, 'Criar modelo IA', 'Em andamento', '2026-01-01', '2026-06-01', 1, 1),
(2, 'Criar frontend', 'Em andamento', '2026-01-01', '2026-06-01', 2, 2),
(3, 'Criar app', 'Planejado', '2026-01-01', '2026-06-01', 3, 3),
(4, 'Criar banco', 'Em andamento', '2026-01-01', '2026-06-01', 4, 4),
(5, 'Criar segurança', 'Planejado', '2026-01-01', '2026-06-01', 5, 5);


-- ================= COMENTARIOS =================
INSERT INTO comentario (id, texto, data_criacao, autor_id, documento_id) VALUES
(1, 'Muito bom', NOW(), 1, 1),
(2, 'Precisa melhorar', NOW(), 2, 2),
(3, 'Ok', NOW(), 3, 3),
(4, 'Revisar', NOW(), 4, 4),
(5, 'Aprovado', NOW(), 5, 5);


-- ================= REFERENCIAS =================
INSERT INTO referencias (id, titulo, autor, ano, tipo, projeto_id) VALUES
(1, 'Livro IA', 'Autor A', 2020, 'Livro', 1),
(2, 'Livro Web', 'Autor B', 2021, 'Livro', 2),
(3, 'Livro Mobile', 'Autor C', 2022, 'Livro', 3),
(4, 'Livro BD', 'Autor D', 2023, 'Livro', 4),
(5, 'Livro Segurança', 'Autor E', 2024, 'Livro', 5);