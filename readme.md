# PhpDocker

Um sistema que preza pelos melhores padrões de desenvolvimento em ambiente PHP, agrupando diversas concepções em consenso entre os desenvolvedores, como namespaces, uso de variáveis de ambiente (dotenv), padrão MVC, entre outros.

---

## 🏗️ Infraestrutura (Docker)

O projeto utiliza o **Docker Compose** para orquestrar o ambiente de desenvolvimento, garantindo que todos os colaboradores utilizem a mesma versão de software e configurações.

### Serviços (Docker Compose)
Os contêineres comunicam-se através de uma rede isolada do tipo **bridge**:

* **APP:** Executa o PHP na versão `8.2-fpm-bookworm`.
* **NGINX:** Servidor web utilizando a versão `1.25.4-alpine`.
* **Mysql:** Banco de dados relacional na versão `8.3.0`.

### Persistência e Configuração (Volumes)
O diretório `/docker` no projeto é responsável por gerenciar as configurações e persistência:
* `/mysql/data`: Armazenamento persistente dos dados do banco.
* `/nginx/conf.d/default.conf`: Arquivo de configuração de rotas e servidor do Nginx.
* `/php/Dockerfile`: Definições de build customizadas para o ambiente PHP.

---

## 🛠️ Arquitetura do Software

A aplicação foi construída seguindo o padrão **MVC (Model-View-Controller)** para garantir a separação de responsabilidades e facilitar a manutenção.

### 🎨 View (Apresentação)
Focada na experiência do usuário e interface responsiva:
* **Jquery:** Manipulação dinâmica do DOM e requisições assíncronas.
* **Bootstrap:** Framework CSS para design responsivo e componentes visuais.

### 🕹️ Controller (Lógica de Controle)
Gerencia o fluxo de dados e as regras de negócio:
* **JWT OAuth:** Implementação de autenticação segura e autorização.
* **League Render View:** Utilização de pacotes da "The League" para gerenciamento e renderização de templates.
* **PhpDotenv:** Gestão de variáveis de ambiente para maior segurança das credenciais.

### 🗃️ Model (Camada de Dados)
Responsável pela estrutura e persistência das informações:
* **POO & Herança:** Uso de Programação Orientada a Objetos com classes herdando de uma `Model` base.
* **Conexão DB:** Utilização de **PDO** para segurança contra SQL Injection, com configurações extraídas do arquivo `.env`.

---

> **Nota:** Este projeto visa ser uma base sólida para aplicações PHP modernas e escaláveis.