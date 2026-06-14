<div class="col-md-6 BLOQUE-REPORTABLE" id="{{ $id }}">
    <div class="p-4 bg-dark rounded border border-secondary">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="fw-bold">{{ $titulo }}</h5>
            <button onclick="printSection('{{ $id }}')" class="btn btn-sm btn-outline-secondary">PDF</button>
        </div>
        <table class="table table-dark table-sm">
            <thead><tr>@foreach($cols as $c)<th>{{ $c }}</th>@endforeach</tr></thead>
            <tbody>
                @foreach($datos as $d)
                <tr>
                    <td>{{ $d->name ?? $d->nombre ?? 'N/A' }}</td>
                    <td>{{ $d->email ?? $d->stock ?? '$'.number_format($d->total ?? 0, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function printSection(id) {
    let content = document.getElementById(id).innerHTML;
    let original = document.body.innerHTML;
    document.body.innerHTML = content;
    window.print();
    document.body.innerHTML = original;
}
</script>