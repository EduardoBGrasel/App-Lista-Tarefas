<?php

    require "../../app_lista_tarefas/tarefa.model.php";
    require "../../app_lista_tarefas/tarefaService.php";
    require "../../app_lista_tarefas/conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir') { //inserir novos registros

        $tarefa = new Tarefa(); //criando uma nova tarefa
        $tarefa->__set('tarefa', $_POST['tarefa']); //setando tarefa atráves do que foi recuperado no front end
    
        $conexao = new Conexao(); //fazendo a conexão com o banco de dados
    
        $tarefaService = new tarefaService($conexao, $tarefa);
        $tarefaService->inserir(); //inserir registros no banco de dados
    
        header('Location: nova_tarefa.php?inclusao=1');
    }
    else if($acao == 'recuperar') { //recuperar registros existentes
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new tarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
    }
    else if ($acao == 'atualizar') { //atualizar 
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new tarefaService($conexao, $tarefa); 
        if ($tarefaService->atualizar()) {

            if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
                header('location: index.php');
            } else {
                header('location: todas_tarefas.php');
            }
            
        }
        
    } 
    else if ($acao == 'remover') { //remover registros
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new tarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('location: index.php');
        } else {
            header('location: todas_tarefas.php');
        }
    }
    else if ($acao =='marcarRealizada') { //marcar tarefa como realizada 
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);

        $conexao = new Conexao();

        $tarefaService = new tarefaService($conexao, $tarefa);
        $tarefaService->marcaRealizada();
            if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
                header('location: index.php');
            } else {
                header('location: todas_tarefas.php');
            }
    } 
    else if ($acao == 'recupararTarefasPendentes') { //recuperar apenas as tarefas pendentes
        $tarefa = new Tarefa();
        $tarefa->__set('id_status', 1);
        $conexao = new Conexao();

        $tarefaService = new tarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperarTarefasPendentes();

    }




    
?>