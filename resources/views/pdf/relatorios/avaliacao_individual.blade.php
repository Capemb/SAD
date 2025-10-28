<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Avaliação Individual</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; margin: 20px; }
        h2 { text-align: center; color: #007bff; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #007bff; color: #fff; }
    </style>
</head>
<body>
    <h2>Relatório de Avaliação Individual</h2>
    <p><strong>Colaborador:</strong> {{ $avaliacao->avaliado->nome }}</p>
    <p><strong>Módulo:</strong> {{ $avaliacao->modulo->nome ?? '—' }}</p>
    <p><strong>Ciclo:</strong> {{ $avaliacao->ciclo->nome ?? '—' }}</p>
    <p><strong>Nota Final:</strong> {{ $avaliacao->nota_final }}%</p>
    <p><strong>Status:</strong> {{ ucfirst($avaliacao->status) }}</p>
</body>
</html>
