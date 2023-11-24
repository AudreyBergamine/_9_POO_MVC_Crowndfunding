<!-- PARTE 1

Eu preciso desenvolver um programa em PHP no modelo MVC de acordo com esse enunciado: (Leia com atenção e sem pressa)

ATIVIDADE 71 - MODELO DE NEGÓCIO PLATAFORMA DE CROWDFUNDING

A criação de um projeto de banco de dados para atender às necessidades de uma
Plataforma de Crowdfunding. E é fundamental:
- Gerenciar projetos (Adm e Criador)
- Gerenciar contribuições (Adm e Criador)
- Gerenciar informações financeiras (Adm e Criador)
- Gerenciar Comunicação entre criadores de projetos e apoiadores (Adm e Criador)

Principais requisitos:
- Permitir que os usuários se cadastrem como criadores de projetos ou apoiadores. 
Os detalhes do cadastro podem incluir nome, informações de contato, perfil social e preferências de notificação.

- Criadores de projetos devem poder criar, editar e gerenciar seus projetos na plataforma. 
Isso inclui a descrição do projeto, metas financeiras, prazos, recompensas para apoiadores e atualizações do projeto.

- Permitir que os apoiadores façam contribuições financeiras para os projetos. 
Isso envolve processamento seguro de pagamentos por meio de gateways de pagamento.

Muitas campanhas de crowdfunding oferecem recompensas aos apoiadores. 
O sistema deve registrar as recompensas selecionadas pelos apoiadores e rastrear a distribuição
dessas recompensas pelos criadores de projetos.

A plataforma deve facilitar a comunicação entre criadores de projetos e apoiadores, 
incluindo mensagens diretas, atualizações do projeto e fóruns de discussão.

Criadores de projetos e apoiadores devem ter acesso a painéis de controle personalizados, 
onde podem acompanhar o progresso de projetos, contribuições, mensagens e recompensas.

A plataforma pode fornecer análises de dados para criadores de projetos, incluindo métricas de desempenho, 
como o número de contribuições, origem dos apoiadores e alcance das campanhas. 

Dado o manuseio de informações financeiras, a segurança dos dados é essencial. (Login)
O sistema deve incluir medidas rigorosas de segurança.

A plataforma deve estar em conformidade com regulamentações financeiras e fiscais
e registrar informações relevantes para relatórios fiscais. 

A plataforma pode permitir que os usuários compartilhem projetos em suas redes sociais para ampliar o alcance
e o engajamento.

Manter um histórico completo de transações financeiras, atualizações de projetos e comunicações é importante para 
referência futura e conformidade com regulamentações.


Em resumo, um sistema de banco de dados bem projetado para uma Plataforma de Crowdfunding é fundamental para a 
gestão eficaz de projetos, contribuições financeiras e comunicação entre criadores de projetos e apoiadores. 

Ele não apenas facilita o funcionamento da plataforma, mas também fornece informações valiosas
para melhorar a experiência do usuário e aumentar o sucesso das campanhas de crowdfunding.




Para esse projeto, montei essa estrutura: 
projeto-crowdfunding/
|-- controllers/
|   |-- AdminController.php
|   |-- CreatorController.php
|   |-- HomeController.php
|-- models/
|   |-- User.php
|   |-- Project.php
|   |-- Contribution.php
|   |-- Reward.php
|-- views/
|   |-- admin/
|       |-- dashboard.php
|       |-- projects.php
|       |-- contributions.php
|   |-- creator/
|       |-- dashboard.php
|       |-- create_project.php
|       |-- project_details.php
|   |-- user/
|       |-- register.php
|       |-- login.php
|   |-- shared/
|       |-- header.php
|       |-- footer.php
|-- config/
|   |-- database.php
|-- public/
|   |-- css/
|   |-- js/
|-- index.php
|-- .htaccess




Vou te mostrar meu código, mas vou dividir em algumas partes pois ele é muito grande, 
ao final eu te aviso que te mostrei tudo, veja se encontra possíveis erros no código pois não está funcionando,
Segue todos os códigos:

-->