<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório Geral de Avaliações</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #2c3e50; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Relatório Geral de Avaliações</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Colaborador</th>
                <th>Módulo</th>
                <th>Ciclo</th>
                <th>Avaliador</th>
                <th>Nota Final</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avaliacoes as $index => $a)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->avaliado?->nome ?? '-' }}</td>
                    <td>{{ $a->modulo?->nome ?? '-' }}</td>
                    <td>{{ $a->ciclo?->nome ?? '-' }}</td>
                    <td>{{ $a->avaliador?->nome ?? '-' }}</td>
                    <td>{{ number_format($a->nota_final, 1) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="footer"><strong>Média geral:</strong> {{ $mediaGeral }}%</p>
</body>
</html>
