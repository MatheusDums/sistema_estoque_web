-- Cria o banco de dados `sist_estoque` se ele ainda não existir,
-- com o conjunto de caracteres e collation recomendados.
CREATE DATABASE IF NOT EXISTS `sist_estoque` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Seleciona o banco de dados `sist_estoque` para usar nos comandos seguintes.
USE `sist_estoque`;

--
-- Estrutura da tabela `admin_login`
--
CREATE TABLE `admin_login` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_admin` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `empresa`
--
CREATE TABLE `empresa` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco` text COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `futuras-imp`
--
CREATE TABLE `futuras-imp` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `help`
--
CREATE TABLE `help` (
  `id_help` int(5) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `assunto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `area` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nivel` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status_help` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contato` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_help`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `login`
--
CREATE TABLE `login` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `pass` text COLLATE utf8mb4_general_ci NOT NULL,
  `token` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `notificacoes`
--
CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_general_ci NOT NULL,
  `lida` tinyint(1) DEFAULT 0,
  `criada_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `produtos`
--
CREATE TABLE `produtos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` text COLLATE utf8mb4_general_ci NOT NULL,
  `codigo` text COLLATE utf8mb4_general_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estoque` text COLLATE utf8mb4_general_ci NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` text COLLATE utf8mb4_general_ci NOT NULL,
  `categoria` text COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `recados`
--
CREATE TABLE `recados` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8mb4_general_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_general_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `criado` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura da tabela `usuarios`
--
CREATE TABLE `usuarios` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `cadastro` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` text COLLATE utf8mb4_general_ci NOT NULL,
  `token` text COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` text COLLATE utf8mb4_general_ci NOT NULL,
  `cargo` text COLLATE utf8mb4_general_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;