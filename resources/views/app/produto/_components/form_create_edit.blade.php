@if (isset($produto->id))
    <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
        @csrf
        @method('PUT')
    @else
        <form method="post" action="{{ route('produto.store') }}">
            @csrf
@endif
<input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
@if ($errors->has('nome'))
    <span class="text-danger">{{ $errors->first('nome') }}</span>
@endif

<input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" placeholder="Descrição"
    class="borda-preta">
@if ($errors->has('descricao'))
    <span class="text-danger">{{ $errors->first('descricao') }}</span>
@endif

<input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="Peso" class="borda-preta">
@if ($errors->has('peso'))
    <span class="text-danger">{{ $errors->first('peso') }}</span>
@endif

<select name="unidade_id">
    <option value=""> <-- Selecione a unidade de medida --> </option>

    @foreach ($unidades as $unidade)
        <option value="{{ $unidade->id }}"
            {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>
            {{ $unidade->descricao }}
        </option>
    @endforeach
</select>
@if ($errors->has('unidade_id'))
    <span class="text-danger">{{ $errors->first('unidade_id') }}</span>
@endif

<button type="submit" class="borda-preta">Cadastrar</button>
</form>
