# PetMatch - Rede Social de Pets

## 🐾 Sobre o Projeto

O **PetMatch** é uma rede social inovadora desenvolvida especificamente para pets e seus tutores, implementando um sistema de "match" similar ao Tinder, mas focado em criar conexões entre animais de estimação para amizades, passeios e eventos sociais.

Este projeto foi desenvolvido como trabalho semestral para a disciplina de **Desenvolvimento Web** com PHP Laravel.

## ✨ Funcionalidades Principais

### 🔐 Sistema de Autenticação
- Registro e login seguro de usuários
- Controle de acesso baseado em perfis (BAC/RBAC)
- Middleware de segurança personalizado

### 🐕 Gestão de Pets
- Cadastro completo de pets com fotos
- Upload e otimização automática de imagens
- Validações robustas de dados
- Perfis detalhados com preferências

### 💕 Sistema de Match
- Algoritmo de compatibilidade inteligente
- Interface tipo "Tinder" para pets
- Detecção automática de matches mútuos
- Notificações de novos matches

### 📱 Feed Social
- Postagens com fotos e vídeos
- Sistema de comentários e curtidas
- Feed cronológico com paginação
- Validação de conteúdo

### 📅 Eventos Sociais
- Criação de eventos para pets
- Integração com API ViaCEP
- Busca por proximidade geográfica
- Gestão de participantes

### 💬 Chat em Tempo Real
- Comunicação entre tutores com match
- Histórico de mensagens
- Validações de segurança
- Interface responsiva

### 📊 Dashboard Administrativo
- Estatísticas em tempo real
- Relatórios detalhados
- Gráficos e visualizações
- Ferramentas de moderação

### 📊 Dashboard Tutor
- Estatísticas em tempo real
- Relatórios detalhados
- Gráficos e visualizações
- Ferramentas de moderação

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8.1+ com Laravel 10.x
- **Frontend:** Blade Templates, Alpine.js, Bootstrap
- **Banco de Dados:** SQLite (desenvolvimento), MySQL/PostgreSQL (produção)
- **Autenticação:** Laravel Breeze
- **APIs:** ViaCEP para validação de endereços
- **Processamento:** Intervention Image para otimização
- **Testes:** PHPUnit para testes automatizados

## 📋 Requisitos Atendidos

### ✅ Casos de Uso (7/7 implementados)
- [x] Criar perfil do pet
- [x] Realizar match com outros pets
- [x] Publicar no feed de fotos e vídeos
- [x] Criar evento
- [x] Interagir com postagens (comentar/curtir)
- [x] Conversar via chat
- [x] Gerenciar usuários e conteúdo (administrador)

### ✅ Entidades (6+ implementadas)
- [x] Usuario (tutor, admin)
- [x] Pet
- [x] Postagem
- [x] Comentario
- [x] Evento
- [x] Match (PetMatch)
- [x] Mensagem
- [x] Perfil

### ✅ Relacionamentos
- [x] Relacionamentos 1:1 (Usuario → Perfil)
- [x] Relacionamentos 1:N (Usuario → Pet, Pet → Postagem, etc.)
- [x] Relacionamentos N:N (Pet ↔ Pet via PetMatch)

### ✅ Autenticação
- [x] Controle de acesso BAC/RBAC
- [x] Perfis de usuário (tutor, administrador)
- [x] Middleware de autorização
- [x] Validações de segurança

### ✅ Funcionalidades Adicionais
- [x] Integração com API ViaCEP
- [x] Upload e manipulação de imagens
- [x] Dashboard com gráficos e relatórios
- [x] Filtros de busca avançada
- [x] Validações de formulários

## 📊 Métricas de Qualidade
- ✅ **Segurança:** 
- ✅ **Responsividade:** Mobile-first

*Trabalho Semestral - PHP Laravel - 2025*
