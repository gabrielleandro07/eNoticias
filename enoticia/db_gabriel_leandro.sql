
-- Banco de dados: `db_gabriel_leandro`
--
drop database if exists db_gabriel_leandro;
create database db_gabriel_leandro;
use db_gabriel_leandro;
-- --------------------------------------------------------

--
-- Estrutura da tabela `administracao`
--

CREATE TABLE `administracao` (
  `id_adminis` int(11) NOT NULL,
  `titulo_adminis` varchar(45) DEFAULT NULL,
  `conteudo_adminis` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id_contato` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `assunto` varchar(45) NOT NULL,
  `consideracoes` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contato`
--
-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `titulo_noticia` varchar(80) DEFAULT NULL,
  `conteudo_noticia` varchar(240) NOT NULL,
  `imagem_noticia` varchar(50) DEFAULT NULL,
  `slide_noticia` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descricao`, `ativo`) VALUES
(1, 'Admin', 1),
(2, 'Basico', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `senha`
--

CREATE TABLE `senha` (
  `id_senha` int(11) NOT NULL,
  `dt_inclusao` datetime DEFAULT NULL,
  `dt_expiracao` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `ds_senha_cripto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `senha`
--

INSERT INTO `senha` (`id_senha`, `dt_inclusao`, `dt_expiracao`, `id_usuario`, `ds_senha_cripto`) VALUES
(1, '2019-06-17 16:00:02', '2019-08-17 17:32:48', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(18, '2019-07-07 16:18:04', '2019-09-05 16:18:04', 40, '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nm_usuario` varchar(255) NOT NULL,
  `ds_usuario` varchar(255) NOT NULL,
  `dt_inclusao` datetime NOT NULL,
  `fl_ativo` smallint(6) NOT NULL DEFAULT 1,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nm_usuario`, `ds_usuario`, `dt_inclusao`, `fl_ativo`, `id_perfil`) VALUES
(1, 'Gabriel Leandros', 'admin', '2019-06-17 16:16:27', 1, 1),
(40, 'Usuario Basico', 'basico', '2019-07-07 16:18:04', 1, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administracao`
--
ALTER TABLE `administracao`
  ADD PRIMARY KEY (`id_adminis`);

--
-- Índices para tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices para tabela `senha`
--
ALTER TABLE `senha`
  ADD PRIMARY KEY (`id_senha`),
  ADD KEY `fK_usuario` (`id_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `un_ds_usuario` (`ds_usuario`),
  ADD KEY `fk_perfil` (`id_perfil`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `senha`
--
ALTER TABLE `senha`
  MODIFY `id_senha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `senha`
--
ALTER TABLE `senha`
  ADD CONSTRAINT `fK_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

