-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 02-Nov-2022 às 22:47
-- Versão do servidor: 10.9.1-MariaDB-log
-- versão do PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `id_type_categorie` int(11) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `id_type_categorie`, `cat_name`, `status`) VALUES
(8, 1, 'COMPONENTES', 1),
(9, 1, 'TOUCH/DISPLAY', 1),
(10, 1, 'FLEX', 1),
(11, 1, 'BOTÕES', 1),
(12, 1, 'BATERIAS', 1),
(13, 1, 'CÂMERAS', 1),
(14, 1, 'CONECTORES', 1),
(15, 2, 'FERRAMENTAS', 1),
(16, 2, 'ALICATES', 1),
(17, 2, 'COLAS', 1),
(18, 2, 'LIMPEZA', 1),
(19, 2, 'PARAFUSOS', 1),
(20, 2, 'FIOS DE SOLDA', 1),
(21, 2, 'EQUIPAMENTOS', 1),
(22, 1, 'teste', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` varchar(3000) NOT NULL,
  `contato` varchar(45) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contact`
--

INSERT INTO `contact` (`contact_id`, `first_name`, `last_name`, `email`, `text`, `contato`, `created`) VALUES
(1, 'OnlineITtuts', 'Tutorials', 'admin@onlineittuts.com', 'We Are Learning Php', NULL, '2022-11-02 22:06:00'),
(5, 'italo', 'silva', 'wanessa2s@hotmail.com', 'sajfhksfjhgsfjhskdf', '92984595008', '2022-11-02 22:17:25'),
(6, 'italo', 'silva', 'wanessa2s@hotmail.com', 'kashfjsdhfsdf', '92984595008', '2022-11-02 22:22:51'),
(7, 'italo', 'silva', 'italo.silva@itegam.org.br', 'ksfjhsdfsdf', '92984595008', '2022-11-02 22:27:54'),
(8, 'italo', 'silva', 'italo.computation@gmail.com', 'fgjfhajfhsteste56', '92984595008', '2022-11-02 22:46:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `category_name` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `MRP` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`p_id`, `category_name`, `product_name`, `MRP`, `price`, `qty`, `img`, `description`, `status`) VALUES
(8, 9, 'Touch+Display Oppo A74 4G 6.67\"', 137382, 72.99, 1, 'Touch Display Oppo A74 4G 6.43 Preto.jpg', 'Touch+Display Asus Zenfone 7/ZS670KS 6.67\" Preto\r\n\r\n- Garantia de defeito de fabricação\r\n- Transporte em embalagem segura\r\n- Qualidade: Original', 1),
(9, 9, 'Touch+Display Asus Zenfone 7 6.67\"', 137068, 179.89, 1, 'TouchDisplay Asus Zenfone ZS670KS 6.67 Preto.jpg', 'Touch+Display Asus Zenfone 7/ZS670KS 6.67\" Preto\r\n\r\n- Garantia de defeito de fabricação\r\n- Transporte em embalagem segura\r\n- Qualidade: Original', 1),
(10, 12, 'Bateria Samsung Galaxy Core 2', 129918, 32.15, 1, 'Bateria Para Samsung Galaxy Core EB-BG355BBE.jpg', 'Modelo	GALAXY CORE 2 \r\nRef: G355/EB-BG355BBE', 1),
(11, 12, 'Bateria Alcatel Alcatel 3 2019', 5021560, 27.45, 1, '5021565.jpg', 'Bateria Alcatel 3 2019 (5053)\r\nRef: TLP034F1 ', 1),
(13, 8, 'CHARGING BOARD XIAOMI REDMI 6 PRO', 126590, 28.91, 1, '126590.jpg', 'CHARGING BOARD XIAOMI MI A2 LITE,REDMI 6 PRO', 1),
(14, 11, 'BOTÃO HOME + FLEX IPHONE 6 PLUS PRETO', 151975, 14.99, 1, '151975.jpg', 'BOTÃO HOME + FLEX IPHONE 6 PLUS PRETO', 1),
(15, 13, 'CAMERA TRASEIRA HUAWEI MATE 10 PRO', 129907, 21.99, 1, '129907.jpg', 'CAMERA TRASEIRA HUAWEI MATE 10 PRO', 1),
(16, 14, 'FPC CONECTOR IPAD MINI / MINI 2', 121285, 6.69, 1, 's-l500.jpg', 'FPC CONECTOR IPAD MINI / MINI 2', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `type_categories`
--

CREATE TABLE `type_categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `type_categories`
--

INSERT INTO `type_categories` (`id`, `cat_name`, `status`) VALUES
(1, 'ELETRÔNICA', 1),
(2, 'INFORMÁTICA', 1),
(3, 'SERVIÇOS DE REPARAÇÃO', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'Admin', '123456', 'geral@chipmatica.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_type_categorie_idx` (`id_type_categorie`);

--
-- Índices para tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Índices para tabela `type_categories`
--
ALTER TABLE `type_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `type_categories`
--
ALTER TABLE `type_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_id_type_categorie` FOREIGN KEY (`id_type_categorie`) REFERENCES `type_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
