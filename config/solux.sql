/*
Created: 07/02/2016
Modified: 28/05/2016
Project: Erp
Model: PostgreSQL 9.4
Database: PostgreSQL 9.4
*/


-- Create tables section -------------------------------------------------

-- Table cad_loja

CREATE TABLE "cad_loja"(
 "loja_id" Smallserial NOT NULL,
 "razao" Character varying(60) NOT NULL,
 "fantasia" Character(30) NOT NULL,
 "cnpj" Character(13) NOT NULL,
 "ie" Character varying(12) NOT NULL,
 "telefone" Character(8),
 "logradouro" Character varying(60) NOT NULL,
 "numero" Smallint,
 "bairro" Character varying(60) NOT NULL,
 "municipio" Smallint NOT NULL,
 "cep" Character(8) NOT NULL,
 "estado" Smallint NOT NULL,
 "num_loja" Smallint NOT NULL,
 "mix" Character varying(20) NOT NULL,
 "crt" Smallint NOT NULL,
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_loja"."loja_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "cad_loja"."razao" IS 'Razão social'
;
COMMENT ON COLUMN "cad_loja"."fantasia" IS 'Nome fantasia'
;
COMMENT ON COLUMN "cad_loja"."cnpj" IS 'Cnpj da loja'
;
COMMENT ON COLUMN "cad_loja"."ie" IS 'Inscrição estadual da loja'
;
COMMENT ON COLUMN "cad_loja"."telefone" IS 'Número do telefone da loja'
;
COMMENT ON COLUMN "cad_loja"."logradouro" IS 'Endereço da loja

'
;
COMMENT ON COLUMN "cad_loja"."numero" IS 'Numero do endereço da loja'
;
COMMENT ON COLUMN "cad_loja"."bairro" IS 'Bairro da loja'
;
COMMENT ON COLUMN "cad_loja"."cep" IS 'Código do cep da loja'
;
COMMENT ON COLUMN "cad_loja"."num_loja" IS 'Numero da loja'
;
COMMENT ON COLUMN "cad_loja"."mix" IS 'Nome da tabela mix de loja'
;
COMMENT ON COLUMN "cad_loja"."crt" IS 'Código do regime tributário'
;
COMMENT ON COLUMN "cad_loja"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_loja"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_loja

ALTER TABLE "cad_loja" ADD CONSTRAINT "PK_cad_loja" PRIMARY KEY ("loja_id")
;

-- Table cad_produto

CREATE TABLE "cad_produto"(
 "produto_id" Serial NOT NULL,
 "plu" Integer NOT NULL,
 "sku_id" Integer NOT NULL,
 "ativo" Boolean,
 "descricao" Character varying(60) NOT NULL,
 "desc_resumida" Character varying(22) NOT NULL,
 "ncm_id" Integer NOT NULL,
 "secao_id" Smallint NOT NULL,
 "grupo_id" Smallint NOT NULL,
 "subgrupo_id" Smallint NOT NULL,
 "fornecedor_id" Integer NOT NULL,
 "grade_id" Integer,
 "embalagem_id" Smallint NOT NULL,
 "unidade_id" Smallint NOT NULL,
 "tipo_produto_id" Smallint NOT NULL,
 "icms_nf_entrada_id" Smallint NOT NULL,
 "icms_nf_saida_id1" Smallint NOT NULL,
 "icms_pdv_id1" Smallint NOT NULL,
 "pis_entrada_id" Smallint NOT NULL,
 "pis_saida_id" Smallint NOT NULL,
 "cofins_entrada_id" Smallint NOT NULL,
 "cofins_saida_id" Smallint NOT NULL,
 "ipi_entrada_id" Smallint NOT NULL,
 "ipi_saida_id1" Smallint NOT NULL,
 "mva_st" Numeric(10,3),
 "peso_liquido" Numeric(10,3),
 "peso_bruto" Numeric(10,3),
 "estoque_min" Numeric(10,3) NOT NULL,
 "estoque_ideal" Numeric(10,3),
 "curva_abc" Boolean,
 "carga_pdv" Boolean,
 "prod_balanca" Boolean,
 "permite_frac" Boolean,
 "permite_preco" Boolean,
 "data_cadastro" Date NOT NULL,
 "data_altera" Time with time zone,
 "cest_id" Integer NOT NULL,
 "pis_entrada_id1" Smallint NOT NULL,
 "pis_saida_id1" Smallint NOT NULL,
 "cofins_entrada_id1" Smallint NOT NULL,
 "cofins_saida_id1" Smallint NOT NULL,
 "icms_pdv_id" Smallint NOT NULL,
 "icms_nf_entrada_id1" Smallint NOT NULL,
 "icms_nf_saida_id" Smallint NOT NULL,
 "ipi_entrada_id1" Smallint NOT NULL,
 "ipi_saida_id" Smallint NOT NULL
)
;
COMMENT ON COLUMN "cad_produto"."produto_id" IS 'Chave gerada sequencialmente'
;
COMMENT ON COLUMN "cad_produto"."plu" IS 'Codigo interno do produto'
;
COMMENT ON COLUMN "cad_produto"."sku_id" IS 'Chave de referencia do codigo de barras utilizado'
;
COMMENT ON COLUMN "cad_produto"."ativo" IS 'Situacao do produto'
;
COMMENT ON COLUMN "cad_produto"."descricao" IS 'Descricao do produto'
;
COMMENT ON COLUMN "cad_produto"."desc_resumida" IS 'Descricao resumida para ser usada no pdv e balanca'
;
COMMENT ON COLUMN "cad_produto"."ncm_id" IS 'Classificacao fiscal do produto'
;
COMMENT ON COLUMN "cad_produto"."secao_id" IS 'Chave de referencia da secao utilizada'
;
COMMENT ON COLUMN "cad_produto"."grupo_id" IS 'Chave de referencia do grupo utilizado'
;
COMMENT ON COLUMN "cad_produto"."subgrupo_id" IS 'Chave de referencia di subgrupo utilizado'
;
COMMENT ON COLUMN "cad_produto"."grade_id" IS 'Chave da grade de produtos utilizada'
;
COMMENT ON COLUMN "cad_produto"."embalagem_id" IS 'Embalagem do produto'
;
COMMENT ON COLUMN "cad_produto"."unidade_id" IS 'Chave de referencia da unidade utilizada'
;
COMMENT ON COLUMN "cad_produto"."tipo_produto_id" IS 'Tipo de produto utilizado conforme tabela de tipos de produto do sped'
;
COMMENT ON COLUMN "cad_produto"."icms_nf_entrada_id" IS 'Chave de referecia do cst de icms utilizado para entrada de nota'
;
COMMENT ON COLUMN "cad_produto"."icms_pdv_id1" IS 'Tributacao para o pdv'
;
COMMENT ON COLUMN "cad_produto"."pis_entrada_id" IS 'Pis de entrada'
;
COMMENT ON COLUMN "cad_produto"."pis_saida_id" IS 'Pis de saida'
;
COMMENT ON COLUMN "cad_produto"."cofins_entrada_id" IS 'Cofins de entrada'
;
COMMENT ON COLUMN "cad_produto"."cofins_saida_id" IS 'Cofins de saida'
;
COMMENT ON COLUMN "cad_produto"."ipi_entrada_id" IS 'Ipi de entrada'
;
COMMENT ON COLUMN "cad_produto"."ipi_saida_id1" IS 'Ipi de saida'
;
COMMENT ON COLUMN "cad_produto"."mva_st" IS 'Valor do mva quando for st'
;
COMMENT ON COLUMN "cad_produto"."peso_liquido" IS 'Peso líquido da mercadoria a ser usado na emissão de nota'
;
COMMENT ON COLUMN "cad_produto"."peso_bruto" IS 'Peso bruto do produto a ser usado na emissao de nota'
;
COMMENT ON COLUMN "cad_produto"."estoque_min" IS 'Quantidade de estoque minimo'
;
COMMENT ON COLUMN "cad_produto"."curva_abc" IS 'Entra na curva abc de vendas'
;
COMMENT ON COLUMN "cad_produto"."carga_pdv" IS 'Envia carga para o pdv'
;
COMMENT ON COLUMN "cad_produto"."prod_balanca" IS 'Envia produto para balanca/ flag de produtos pesado'
;
COMMENT ON COLUMN "cad_produto"."permite_frac" IS 'Permite venda fracionada'
;
COMMENT ON COLUMN "cad_produto"."permite_preco" IS 'Permite alteracao de preco pelo pdv'
;
COMMENT ON COLUMN "cad_produto"."data_cadastro" IS 'Data de cadastro do produto'
;
COMMENT ON COLUMN "cad_produto"."data_altera" IS 'Data de alteracao do produto'
;

-- Add keys for table cad_produto

ALTER TABLE "cad_produto" ADD CONSTRAINT "PK_cad_produto" PRIMARY KEY ("produto_id","subgrupo_id","secao_id","grupo_id","unidade_id","icms_pdv_id1","sku_id","icms_nf_saida_id1","fornecedor_id","icms_nf_entrada_id","tipo_produto_id","ncm_id","ipi_entrada_id","pis_entrada_id","pis_saida_id","cofins_entrada_id","cofins_saida_id","ipi_saida_id1","cest_id","pis_entrada_id1","pis_saida_id1","cofins_entrada_id1","cofins_saida_id1","icms_pdv_id","icms_nf_entrada_id1","icms_nf_saida_id","ipi_entrada_id1","ipi_saida_id")
;

-- Table cad_secao

CREATE TABLE "cad_secao"(
 "secao_id" Smallserial NOT NULL,
 "descricao" Character varying(50) NOT NULL,
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_secao"."secao_id" IS 'chave primaria da secao'
;
COMMENT ON COLUMN "cad_secao"."descricao" IS 'Descricao da secao'
;
COMMENT ON COLUMN "cad_secao"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_secao"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_secao

ALTER TABLE "cad_secao" ADD CONSTRAINT "PK_cad_secao" PRIMARY KEY ("secao_id")
;

ALTER TABLE "cad_secao" ADD CONSTRAINT "Attribute1" UNIQUE ("descricao")
;

-- Table cad_grupo

CREATE TABLE "cad_grupo"(
 "grupo_id" Smallserial NOT NULL,
 "descricao" Character varying(50) NOT NULL,
 "secao_id" Smallint NOT NULL,
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_grupo"."grupo_id" IS 'Chave primaria do grupo'
;
COMMENT ON COLUMN "cad_grupo"."descricao" IS 'Descricao do grupo'
;
COMMENT ON COLUMN "cad_grupo"."secao_id" IS 'Seção ao qual o grupo pertence'
;
COMMENT ON COLUMN "cad_grupo"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_grupo"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_grupo

ALTER TABLE "cad_grupo" ADD CONSTRAINT "PK_cad_grupo" PRIMARY KEY ("grupo_id","secao_id")
;

-- Table cad_subgrupo

CREATE TABLE "cad_subgrupo"(
 "subgrupo_id" Smallserial NOT NULL,
 "descricao" Character varying(50) NOT NULL,
 "secao_id" Smallint NOT NULL,
 "grupo_id" Smallint NOT NULL,
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_subgrupo"."subgrupo_id" IS 'Chave primaria do subgrupo'
;
COMMENT ON COLUMN "cad_subgrupo"."descricao" IS 'Descrição do subgrupo'
;
COMMENT ON COLUMN "cad_subgrupo"."secao_id" IS 'Seção ao qual o subgrupo pertence'
;
COMMENT ON COLUMN "cad_subgrupo"."grupo_id" IS 'Grupo ao qual o subgrupo pergtence'
;
COMMENT ON COLUMN "cad_subgrupo"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_subgrupo"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_subgrupo

ALTER TABLE "cad_subgrupo" ADD CONSTRAINT "PK_cad_subgrupo" PRIMARY KEY ("subgrupo_id","secao_id","grupo_id")
;

-- Table cad_unidade

CREATE TABLE "cad_unidade"(
 "unidade_id" Smallserial NOT NULL,
 "codigo" Character varying(10) NOT NULL,
 "descricao" Character varying(20) NOT NULL,
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_unidade"."unidade_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "cad_unidade"."codigo" IS 'Codigo da unidade'
;
COMMENT ON COLUMN "cad_unidade"."descricao" IS 'Descriçao da unidade'
;
COMMENT ON COLUMN "cad_unidade"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_unidade"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_unidade

ALTER TABLE "cad_unidade" ADD CONSTRAINT "PK_cad_unidade" PRIMARY KEY ("unidade_id")
;

ALTER TABLE "cad_unidade" ADD CONSTRAINT "codigo31" UNIQUE ("codigo")
;

ALTER TABLE "cad_unidade" ADD CONSTRAINT "descricao1" UNIQUE ("descricao")
;

-- Table cad_pis

CREATE TABLE "cad_pis"(
 "pis_id" Smallserial NOT NULL,
 "codigo" Character(2) NOT NULL,
 "descricao" Character varying(50) NOT NULL,
 "aliquota" Numeric(4,3),
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_pis"."pis_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "cad_pis"."codigo" IS 'Codigo do cst de pis'
;
COMMENT ON COLUMN "cad_pis"."descricao" IS 'descrição do cst de pis'
;
COMMENT ON COLUMN "cad_pis"."aliquota" IS 'Aliquota de pis'
;
COMMENT ON COLUMN "cad_pis"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_pis"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_pis

ALTER TABLE "cad_pis" ADD CONSTRAINT "PK_cad_pis" PRIMARY KEY ("pis_id")
;

ALTER TABLE "cad_pis" ADD CONSTRAINT "codigo" UNIQUE ("codigo")
;

ALTER TABLE "cad_pis" ADD CONSTRAINT "Attribute21" UNIQUE ("descricao")
;

-- Table cad_cofins

CREATE TABLE "cad_cofins"(
 "cofins_id" Smallserial NOT NULL,
 "codigo" Character(2) NOT NULL,
 "descricao" Character varying(50) NOT NULL,
 "aliquota" Numeric(4,3),
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_cofins"."cofins_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "cad_cofins"."codigo" IS 'Codigo cofins'
;
COMMENT ON COLUMN "cad_cofins"."descricao" IS 'Descrição do cst de cofins'
;
COMMENT ON COLUMN "cad_cofins"."aliquota" IS 'Aliquota de cofins'
;
COMMENT ON COLUMN "cad_cofins"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_cofins"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_cofins

ALTER TABLE "cad_cofins" ADD CONSTRAINT "PK_cad_cofins" PRIMARY KEY ("cofins_id")
;

ALTER TABLE "cad_cofins" ADD CONSTRAINT "codigo12" UNIQUE ("codigo")
;

ALTER TABLE "cad_cofins" ADD CONSTRAINT "Attribute2" UNIQUE ("descricao")
;

-- Table cad_ean

CREATE TABLE "cad_ean"(
 "sku_id" Serial NOT NULL,
 "sku" Character varying(14) NOT NULL,
 "plu_id" Integer NOT NULL,
 "ativo" Boolean NOT NULL,
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_ean"."sku_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "cad_ean"."sku" IS 'Codigo de barras do plu'
;
COMMENT ON COLUMN "cad_ean"."plu_id" IS 'Plu associado ao codigo de barras'
;
COMMENT ON COLUMN "cad_ean"."ativo" IS 'Sku em uso'
;
COMMENT ON COLUMN "cad_ean"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_ean"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_ean

ALTER TABLE "cad_ean" ADD CONSTRAINT "PK_cad_ean" PRIMARY KEY ("sku_id")
;

ALTER TABLE "cad_ean" ADD CONSTRAINT "sku" UNIQUE ("sku")
;

-- Table cad_icms

CREATE TABLE "cad_icms"(
 "icms_id" Smallserial NOT NULL,
 "codigo" Character varying(50) NOT NULL,
 "cst" Character(2),
 "tributacao" Character varying(2),
 "csosn" Character(3),
 "origem" Character(1) NOT NULL,
 "aliquota" Numeric(4,2) NOT NULL,
 "base" Numeric(10,2),
 "mod_icms" Smallint,
 "aliquota_st" Numeric(4,2),
 "base_st" Numeric(10,2),
 "mod_icms_st" Smallint,
 "uso" Smallint NOT NULL,
 "texto_nf_id" Character varying(255),
 "cod_tributacao_pdv" Character varying(4),
 "cfop" Character(5),
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_icms"."icms_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "cad_icms"."codigo" IS 'Código do icms para selecção de uso'
;
COMMENT ON COLUMN "cad_icms"."cst" IS 'CST de icms do produto'
;
COMMENT ON COLUMN "cad_icms"."tributacao" IS 'Codigo da tributação T: tributado, NT: não tributado, ST: situação tributária, I: isento, D: diferido, S: substituição tributaria'
;
COMMENT ON COLUMN "cad_icms"."csosn" IS 'Código para simples nacional'
;
COMMENT ON COLUMN "cad_icms"."origem" IS 'Origem do produto'
;
COMMENT ON COLUMN "cad_icms"."aliquota" IS 'Aliquota de icms'
;
COMMENT ON COLUMN "cad_icms"."base" IS 'Base de redução'
;
COMMENT ON COLUMN "cad_icms"."mod_icms" IS 'Modalidade do icms, para efeito de calculo na emissão de nota'
;
COMMENT ON COLUMN "cad_icms"."aliquota_st" IS 'Aliquota de ST'
;
COMMENT ON COLUMN "cad_icms"."base_st" IS 'Base do ST'
;
COMMENT ON COLUMN "cad_icms"."mod_icms_st" IS 'Modalidade do icms st'
;
COMMENT ON COLUMN "cad_icms"."uso" IS 'Define o uso para entrado ou saida. 1: Entrada e Saida, 2: Entrada, 3: Saida, 4: Pdv
'
;
COMMENT ON COLUMN "cad_icms"."texto_nf_id" IS 'Código do texto a ser usado na emissão da nota'
;
COMMENT ON COLUMN "cad_icms"."cod_tributacao_pdv" IS 'Codigo de tributação usado no ecf.'
;
COMMENT ON COLUMN "cad_icms"."cfop" IS 'Cfop para uso na saida de venda pdv, usado no sped icms'
;
COMMENT ON COLUMN "cad_icms"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_icms"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_icms

ALTER TABLE "cad_icms" ADD CONSTRAINT "PK_cad_icms" PRIMARY KEY ("icms_id")
;

ALTER TABLE "cad_icms" ADD CONSTRAINT "descricao11" UNIQUE ("codigo")
;

-- Table cad_fornecedor

CREATE TABLE "cad_fornecedor"(
 "fornecedor_id" Serial NOT NULL,
 "tipo" Character(1) NOT NULL,
 "cnpj_cpf" Character varying(14) NOT NULL,
 "ie_rg" Character varying(20) NOT NULL,
 "ie_st" Character varying(20),
 "razao" Character varying(60) NOT NULL,
 "fantasia" Character varying(40) NOT NULL,
 "crt" Smallint,
 "cep" Character(8),
 "logradouro" Character varying(60),
 "numero" Smallint,
 "complemento" Character varying(20),
 "bairro" Character varying(60),
 "cidade" Integer,
 "uf" Smallint,
 "contato" Character varying(60),
 "observacao" Character varying(255),
 "email" Character varying(50),
 "suframa" Character varying(20),
 "centro_custo_id" Smallint,
 "telefone" Character(8),
 "ramal" Character varying(10),
 "celular" Character varying(9),
 "ativo" Boolean NOT NULL,
 "data_cadastro" Date,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_fornecedor"."fornecedor_id" IS 'Chave primaria, o valor da chave de ser alteradom para iniciar em 1'
;
COMMENT ON COLUMN "cad_fornecedor"."tipo" IS 'Tipo de pesso, j:  juridica, f: fisica'
;
COMMENT ON COLUMN "cad_fornecedor"."cnpj_cpf" IS 'Código do cnpj/cpf'
;
COMMENT ON COLUMN "cad_fornecedor"."ie_rg" IS 'Inscrição estadual/Rg'
;
COMMENT ON COLUMN "cad_fornecedor"."ie_st" IS 'Inscrição estadual substituição triubutaria'
;
COMMENT ON COLUMN "cad_fornecedor"."razao" IS 'Razão social'
;
COMMENT ON COLUMN "cad_fornecedor"."fantasia" IS 'Nome fantasia'
;
COMMENT ON COLUMN "cad_fornecedor"."crt" IS 'Código do regime tributário'
;
COMMENT ON COLUMN "cad_fornecedor"."cep" IS 'Cep do endereço do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."logradouro" IS 'Enderço do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."numero" IS 'Numero do endereço do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."complemento" IS 'Nome do complemento do endereço'
;
COMMENT ON COLUMN "cad_fornecedor"."bairro" IS 'Nome do bairro do endereço do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."cidade" IS 'Codigo da cidade do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."uf" IS 'Código da unidade federal do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."contato" IS 'Nome do contato do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."observacao" IS 'Observação sobre o fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."email" IS 'email do fornecedor'
;
COMMENT ON COLUMN "cad_fornecedor"."suframa" IS 'Inscrição no suframa'
;
COMMENT ON COLUMN "cad_fornecedor"."centro_custo_id" IS 'Centro de custo'
;
COMMENT ON COLUMN "cad_fornecedor"."telefone" IS 'Numero do telefone'
;
COMMENT ON COLUMN "cad_fornecedor"."ramal" IS 'Número do ramal'
;
COMMENT ON COLUMN "cad_fornecedor"."celular" IS 'Número do celular'
;
COMMENT ON COLUMN "cad_fornecedor"."ativo" IS 'Ativo sim/não'
;
COMMENT ON COLUMN "cad_fornecedor"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_fornecedor"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_fornecedor

ALTER TABLE "cad_fornecedor" ADD CONSTRAINT "PK_cad_fornecedor" PRIMARY KEY ("fornecedor_id")
;

-- Table tab_crt

CREATE TABLE "tab_crt"(
 "crt_id" Smallserial NOT NULL,
 "codigo" Smallint NOT NULL,
 "descricao" Character varying(40)
)
;
COMMENT ON COLUMN "tab_crt"."crt_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "tab_crt"."codigo" IS 'Codigo do regime tributário'
;
COMMENT ON COLUMN "tab_crt"."descricao" IS 'Nome do regime tributario'
;

-- Add keys for table tab_crt

ALTER TABLE "tab_crt" ADD CONSTRAINT "PK_tab_crt" PRIMARY KEY ("crt_id")
;

-- Table tab_tipo_produto

CREATE TABLE "tab_tipo_produto"(
 "tipo_produto_id" Smallserial NOT NULL,
 "codigo" Smallint NOT NULL,
 "descricao" Character varying(40) NOT NULL
)
;
COMMENT ON COLUMN "tab_tipo_produto"."tipo_produto_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "tab_tipo_produto"."codigo" IS 'Código do tipo de produto'
;
COMMENT ON COLUMN "tab_tipo_produto"."descricao" IS 'Descrição do tipo de produto'
;

-- Add keys for table tab_tipo_produto

ALTER TABLE "tab_tipo_produto" ADD CONSTRAINT "PK_tab_tipo_produto" PRIMARY KEY ("tipo_produto_id")
;

ALTER TABLE "tab_tipo_produto" ADD CONSTRAINT "descricao" UNIQUE ("descricao")
;

ALTER TABLE "tab_tipo_produto" ADD CONSTRAINT "codigo1" UNIQUE ("codigo")
;

-- Table cad_ncm

CREATE TABLE "cad_ncm"(
 "ncm_id" Serial NOT NULL,
 "codigo" Character varying(20) NOT NULL,
 "ncm" Character(10) NOT NULL,
 "ex_tipi" Smallint,
 "descricao" Character varying(255) NOT NULL,
 "nat" Character(3),
 "pis_entrada_id" Smallint NOT NULL,
 "pis_saida_id" Smallint NOT NULL,
 "cofins_entrada_id" Smallint NOT NULL,
 "cofins_saida_id" Smallint NOT NULL,
 "icms_pdv_id" Smallint NOT NULL,
 "icms_nf_entrada_id" Smallint NOT NULL,
 "icms_nf_saida_id" Smallint NOT NULL,
 "ipi_entrada_id" Smallint NOT NULL,
 "ipi_saida_id" Smallint NOT NULL,
 "mva_st" Numeric(10,3),
 "cest_id" Integer NOT NULL,
 "data_cadastro" Date,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_ncm"."ncm_id" IS 'Chame primaria'
;
COMMENT ON COLUMN "cad_ncm"."codigo" IS 'Descrição de uso'
;
COMMENT ON COLUMN "cad_ncm"."ncm" IS 'Código ncm'
;
COMMENT ON COLUMN "cad_ncm"."ex_tipi" IS 'Código da exeção da tipi'
;
COMMENT ON COLUMN "cad_ncm"."nat" IS 'Código da natureza da operação'
;
COMMENT ON COLUMN "cad_ncm"."pis_entrada_id" IS 'Pis para venda'
;
COMMENT ON COLUMN "cad_ncm"."pis_saida_id" IS 'Pis de saida'
;
COMMENT ON COLUMN "cad_ncm"."cofins_entrada_id" IS 'Cofins de entrada'
;
COMMENT ON COLUMN "cad_ncm"."cofins_saida_id" IS 'Cofins de saida'
;
COMMENT ON COLUMN "cad_ncm"."icms_pdv_id" IS 'icms para ecf
'
;
COMMENT ON COLUMN "cad_ncm"."icms_nf_entrada_id" IS 'Icms de entrada para nf'
;
COMMENT ON COLUMN "cad_ncm"."icms_nf_saida_id" IS 'Icms de saida para nf'
;
COMMENT ON COLUMN "cad_ncm"."ipi_entrada_id" IS 'IPI de entrada'
;
COMMENT ON COLUMN "cad_ncm"."ipi_saida_id" IS 'Ipi de saida'
;
COMMENT ON COLUMN "cad_ncm"."mva_st" IS 'Valor do mv quando for st'
;
COMMENT ON COLUMN "cad_ncm"."data_cadastro" IS 'Data de cadastro'
;
COMMENT ON COLUMN "cad_ncm"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_ncm

ALTER TABLE "cad_ncm" ADD CONSTRAINT "PK_cad_ncm" PRIMARY KEY ("ncm_id","cest_id","pis_entrada_id","pis_saida_id","cofins_entrada_id","cofins_saida_id","icms_pdv_id","icms_nf_entrada_id","icms_nf_saida_id","ipi_entrada_id","ipi_saida_id")
;

-- Table cad_ipi

CREATE TABLE "cad_ipi"(
 "ipi_id" Smallserial NOT NULL,
 "codigo" Character(2) NOT NULL,
 "descricao" Character varying(60) NOT NULL,
 "aliquota" Numeric(4,2),
 "data_cadastro" Date NOT NULL,
 "data_altera" Date
)
;
COMMENT ON COLUMN "cad_ipi"."ipi_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "cad_ipi"."codigo" IS 'Codigo da situção usado(IPI)'
;
COMMENT ON COLUMN "cad_ipi"."descricao" IS 'Descrição do IPI'
;
COMMENT ON COLUMN "cad_ipi"."aliquota" IS 'Aliquota de IPI'
;
COMMENT ON COLUMN "cad_ipi"."data_cadastro" IS 'Dada de cadastro'
;
COMMENT ON COLUMN "cad_ipi"."data_altera" IS 'Data de alteração'
;

-- Add keys for table cad_ipi

ALTER TABLE "cad_ipi" ADD CONSTRAINT "PK_cad_ipi" PRIMARY KEY ("ipi_id")
;

-- Table tab_cst_pis

CREATE TABLE "tab_cst_pis"(
 "cst_pis_id" Smallserial NOT NULL,
 "codigo" Character(2) NOT NULL,
 "descricao" Character varying(50) NOT NULL
)
;
COMMENT ON COLUMN "tab_cst_pis"."cst_pis_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "tab_cst_pis"."codigo" IS 'Código do cst de pis'
;
COMMENT ON COLUMN "tab_cst_pis"."descricao" IS 'Descrição do cst de pis'
;

-- Add keys for table tab_cst_pis

ALTER TABLE "tab_cst_pis" ADD CONSTRAINT "PK_tab_cst_pis" PRIMARY KEY ("cst_pis_id")
;

-- Table tab_cst_cofins

CREATE TABLE "tab_cst_cofins"(
 "cst_cofins_id" Smallserial NOT NULL,
 "codigo" Character(2) NOT NULL,
 "descricao" Character varying(50) NOT NULL
)
;
COMMENT ON COLUMN "tab_cst_cofins"."cst_cofins_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "tab_cst_cofins"."codigo" IS 'Codigo do cst de cofins'
;
COMMENT ON COLUMN "tab_cst_cofins"."descricao" IS 'Descrição do cst de cofins'
;

-- Add keys for table tab_cst_cofins

ALTER TABLE "tab_cst_cofins" ADD CONSTRAINT "PK_tab_cst_cofins" PRIMARY KEY ("cst_cofins_id")
;

-- Table tab_cest

CREATE TABLE "tab_cest"(
 "cest_id" Serial NOT NULL,
 "ncm" Character varying(10) NOT NULL,
 "cest" Character(9) NOT NULL,
 "descricao" Character varying(255) NOT NULL
)
;
COMMENT ON COLUMN "tab_cest"."cest_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "tab_cest"."ncm" IS 'Código ncm'
;
COMMENT ON COLUMN "tab_cest"."cest" IS 'Código cest'
;
COMMENT ON COLUMN "tab_cest"."descricao" IS 'Descrição do codigo cest'
;

-- Add keys for table tab_cest

ALTER TABLE "tab_cest" ADD CONSTRAINT "PK_tab_cest" PRIMARY KEY ("cest_id")
;

-- Table tab_cst_icms

CREATE TABLE "tab_cst_icms"(
 "cst_icms_id" Smallserial NOT NULL,
 "codigo" Character varying(3) NOT NULL,
 "descricao" Character varying(50) NOT NULL
)
;
COMMENT ON COLUMN "tab_cst_icms"."codigo" IS 'Código de Tributação pelo ICMS'
;
COMMENT ON COLUMN "tab_cst_icms"."descricao" IS 'Descrição da tributação'
;

-- Add keys for table tab_cst_icms

ALTER TABLE "tab_cst_icms" ADD CONSTRAINT "PK_tab_cst_icms" PRIMARY KEY ("cst_icms_id")
;

-- Table tab_origem

CREATE TABLE "tab_origem"(
 "origem_id" Smallserial NOT NULL,
 "codigo" Character varying(2),
 "descricao" Bigint
)
;
COMMENT ON COLUMN "tab_origem"."origem_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "tab_origem"."codigo" IS 'Origem da mercadoria'
;
COMMENT ON COLUMN "tab_origem"."descricao" IS 'Descrição da origem'
;

-- Add keys for table tab_origem

ALTER TABLE "tab_origem" ADD CONSTRAINT "PK_tab_origem" PRIMARY KEY ("origem_id")
;

-- Table tab_cst_ipi

CREATE TABLE "tab_cst_ipi"(
 "cst_ipi_id" Smallserial NOT NULL,
 "codigo" Character(2) NOT NULL,
 "descricao" Character varying(40) NOT NULL
)
;
COMMENT ON COLUMN "tab_cst_ipi"."cst_ipi_id" IS 'Chave primária'
;
COMMENT ON COLUMN "tab_cst_ipi"."codigo" IS 'Código do cst de ipi'
;
COMMENT ON COLUMN "tab_cst_ipi"."descricao" IS 'Descrição do cst de ipi'
;

-- Add keys for table tab_cst_ipi

ALTER TABLE "tab_cst_ipi" ADD CONSTRAINT "PK_tab_cst_ipi" PRIMARY KEY ("cst_ipi_id")
;

-- Table tab_cidade

CREATE TABLE "tab_cidade"(
 "cidade_id" Serial NOT NULL,
 "codigo" Integer NOT NULL,
 "cidade" Character varying(40) NOT NULL,
 "uf" Smallint NOT NULL
)
;
COMMENT ON COLUMN "tab_cidade"."cidade_id" IS 'Chave primária'
;
COMMENT ON COLUMN "tab_cidade"."codigo" IS 'Código da cidade'
;
COMMENT ON COLUMN "tab_cidade"."cidade" IS 'Nome da cidade'
;
COMMENT ON COLUMN "tab_cidade"."uf" IS 'Codigo do estado'
;

-- Add keys for table tab_cidade

ALTER TABLE "tab_cidade" ADD CONSTRAINT "PK_tab_cidade" PRIMARY KEY ("cidade_id")
;

-- Table tab_estado

CREATE TABLE "tab_estado"(
 "estado_id" Smallserial NOT NULL,
 "codigo" Smallint NOT NULL,
 "estado" Character varying(40) NOT NULL,
 "uf" Character(2) NOT NULL
)
;
COMMENT ON COLUMN "tab_estado"."estado_id" IS 'Chave primaria'
;
COMMENT ON COLUMN "tab_estado"."codigo" IS 'Código do estado'
;
COMMENT ON COLUMN "tab_estado"."estado" IS 'Nome do estado'
;
COMMENT ON COLUMN "tab_estado"."uf" IS 'Unidade federal'
;

-- Add keys for table tab_estado

ALTER TABLE "tab_estado" ADD CONSTRAINT "PK_tab_estado" PRIMARY KEY ("estado_id")
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE "cad_subgrupo" ADD CONSTRAINT "cad_grupo_cad_subgrupo" FOREIGN KEY ("grupo_id", "secao_id") REFERENCES "cad_grupo" ("grupo_id", "secao_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_subgrupo_cad_produto" FOREIGN KEY ("subgrupo_id", "secao_id", "grupo_id") REFERENCES "cad_subgrupo" ("subgrupo_id", "secao_id", "grupo_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_grupo" ADD CONSTRAINT "cad_secao_cad_grupo" FOREIGN KEY ("secao_id") REFERENCES "cad_secao" ("secao_id") ON DELETE CASCADE ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_unidade_cad_produto" FOREIGN KEY ("unidade_id") REFERENCES "cad_unidade" ("unidade_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_ean_cad_produto" FOREIGN KEY ("sku_id") REFERENCES "cad_ean" ("sku_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_icms_cad_produto" FOREIGN KEY ("icms_nf_saida_id1") REFERENCES "cad_icms" ("icms_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_icms_cad_produto_6" FOREIGN KEY ("icms_pdv_id1") REFERENCES "cad_icms" ("icms_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_fornecedor_cad_produto" FOREIGN KEY ("fornecedor_id") REFERENCES "cad_fornecedor" ("fornecedor_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_icms_cad_produto_8" FOREIGN KEY ("icms_nf_entrada_id") REFERENCES "cad_icms" ("icms_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_tipo_produto_cad_produto" FOREIGN KEY ("tipo_produto_id") REFERENCES "tab_tipo_produto" ("tipo_produto_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_ncm_cad_produto" FOREIGN KEY ("ncm_id", "cest_id", "pis_entrada_id1", "pis_saida_id1", "cofins_entrada_id1", "cofins_saida_id1", "icms_pdv_id", "icms_nf_entrada_id1", "icms_nf_saida_id", "ipi_entrada_id1", "ipi_saida_id") REFERENCES "cad_ncm" ("ncm_id", "cest_id", "pis_entrada_id", "pis_saida_id", "cofins_entrada_id", "cofins_saida_id", "icms_pdv_id", "icms_nf_entrada_id", "icms_nf_saida_id", "ipi_entrada_id", "ipi_saida_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_ipi_cad_produto" FOREIGN KEY ("ipi_entrada_id") REFERENCES "cad_ipi" ("ipi_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_pis_cad_produto" FOREIGN KEY ("pis_entrada_id") REFERENCES "cad_pis" ("pis_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_pis_cad_produto_13" FOREIGN KEY ("pis_saida_id") REFERENCES "cad_pis" ("pis_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_cofins_cad_produto" FOREIGN KEY ("cofins_entrada_id") REFERENCES "cad_cofins" ("cofins_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_cofins_cad_produto_15" FOREIGN KEY ("cofins_saida_id") REFERENCES "cad_cofins" ("cofins_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_produto" ADD CONSTRAINT "cad_ipi_cad_produto_16" FOREIGN KEY ("ipi_saida_id1") REFERENCES "cad_ipi" ("ipi_id") ON DELETE RESTRICT ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship1" FOREIGN KEY ("cest_id") REFERENCES "tab_cest" ("cest_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship2" FOREIGN KEY ("pis_entrada_id") REFERENCES "cad_pis" ("pis_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship3" FOREIGN KEY ("pis_saida_id") REFERENCES "cad_pis" ("pis_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship4" FOREIGN KEY ("cofins_entrada_id") REFERENCES "cad_cofins" ("cofins_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship5" FOREIGN KEY ("cofins_saida_id") REFERENCES "cad_cofins" ("cofins_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship6" FOREIGN KEY ("icms_pdv_id") REFERENCES "cad_icms" ("icms_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship7" FOREIGN KEY ("icms_nf_entrada_id") REFERENCES "cad_icms" ("icms_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship8" FOREIGN KEY ("icms_nf_saida_id") REFERENCES "cad_icms" ("icms_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship9" FOREIGN KEY ("ipi_entrada_id") REFERENCES "cad_ipi" ("ipi_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "cad_ncm" ADD CONSTRAINT "Relationship10" FOREIGN KEY ("ipi_saida_id") REFERENCES "cad_ipi" ("ipi_id") ON DELETE NO ACTION ON UPDATE NO ACTION
;





