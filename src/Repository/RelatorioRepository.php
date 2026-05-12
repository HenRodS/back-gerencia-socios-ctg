<?php

namespace Repository;

use Database\Database;
use PDO;

class RelatorioRepository
{
    private $connection;

    public function __construct()
    {
        //obtém a conexão
        $this->connection = Database::getConnection();
    }

    public function getTotalSocios(): array
    {
        //executa a consulta no banco
        $stmt = $this->connection->prepare("SELECT COUNT(*) as total_socios FROM socios");
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return ['total_socios' => $row ? (int)$row['total_socios'] : 0];
    }

    public function getResumoFinanceiro(): array
    {
        //executa a consulta para pagamentos
        $stmtPagamentos = $this->connection->prepare("SELECT SUM(valor_pago) as total_pago FROM pagamentos");
        $stmtPagamentos->execute();
        $rowPagamentos = $stmtPagamentos->fetch(PDO::FETCH_ASSOC);
        $total_pago = $rowPagamentos && $rowPagamentos['total_pago'] !== null ? (float)$rowPagamentos['total_pago'] : 0.0;

        //executa a consulta para mensalidades
        $stmtMensalidades = $this->connection->prepare("SELECT SUM(valor) as total FROM mensalidades");
        $stmtMensalidades->execute();
        $rowMensalidades = $stmtMensalidades->fetch(PDO::FETCH_ASSOC);
        $total_mensalidades = $rowMensalidades && $rowMensalidades['total'] !== null ? (float)$rowMensalidades['total'] : 0.0;

        return [
            'total_valor_pago' => $total_pago,
            'total_valor_mensalidades' => $total_mensalidades
        ];
    }

    public function getSociosInadimplentes(): array
    {
        // Obtém sócios que têm mensalidades não pagas
        $stmt = $this->connection->prepare("
            SELECT DISTINCT s.id, s.nome_completo, s.cpf, s.status, COUNT(m.id) as mensalidades_nao_pagas
            FROM socios s
            INNER JOIN mensalidades m ON s.id = m.socio_id
            WHERE m.status != 'Pago'
            GROUP BY s.id, s.nome_completo, s.cpf, s.status
            ORDER BY s.nome_completo
        ");
        $stmt->execute();
        
        $inadimplentes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $inadimplentes[] = [
                'id' => (int)$row['id'],
                'nome' => $row['nome_completo'],
                'cpf' => $row['cpf'],
                'status' => $row['status'],
                'mensalidades_nao_pagas' => (int)$row['mensalidades_nao_pagas']
            ];
        }
        
        return [
            'total_inadimplentes' => count($inadimplentes),
            'socios_inadimplentes' => $inadimplentes
        ];
    }

    public function getReceitaMensal(): array
    {
        // Obtém a receita agrupada por mês/ano dos pagamentos
        $stmt = $this->connection->prepare("
            SELECT 
                DATE_FORMAT(data_pagamento, '%Y-%m') as mes,
                COUNT(*) as total_pagamentos,
                SUM(valor_pago) as total_receita
            FROM pagamentos
            GROUP BY DATE_FORMAT(data_pagamento, '%Y-%m')
            ORDER BY mes DESC
        ");
        $stmt->execute();
        
        $receitas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $receitas[] = [
                'mes' => $row['mes'],
                'total_pagamentos' => (int)$row['total_pagamentos'],
                'total_receita' => (float)$row['total_receita']
            ];
        }
        
        // Calcula total geral
        $total_geral = array_sum(array_column($receitas, 'total_receita'));
        
        return [
            'total_geral_receita' => $total_geral,
            'quantidade_meses' => count($receitas),
            'receita_por_mes' => $receitas
        ];
    }

    public function getQuantidadeSociosAtivosInativos(): array
    {
        // Obtém a quantidade de sócios ativos e inativos
        $stmt = $this->connection->prepare("
            SELECT status, COUNT(*) as quantidade
            FROM socios
            GROUP BY status
        ");
        $stmt->execute();
        
        $totais = [
            'Ativo' => 0,
            'Inativo' => 0
        ];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $totais[$row['status']] = (int)$row['quantidade'];
        }
        
        return [
            'total_socios' => $totais['Ativo'] + $totais['Inativo'],
            'socios_ativos' => $totais['Ativo'],
            'socios_inativos' => $totais['Inativo'],
            'percentual_ativos' => $totais['Ativo'] + $totais['Inativo'] > 0 ? 
                round(($totais['Ativo'] / ($totais['Ativo'] + $totais['Inativo'])) * 100, 2) : 0,
            'percentual_inativos' => $totais['Ativo'] + $totais['Inativo'] > 0 ? 
                round(($totais['Inativo'] / ($totais['Ativo'] + $totais['Inativo'])) * 100, 2) : 0
        ];
    }
}
