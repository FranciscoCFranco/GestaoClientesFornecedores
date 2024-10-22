@if (isset($produto_detalhe->id))
    <form method="post" action="{{ route('produto-detalhe.update', ['produto_detalhe' => $produto_detalhe->id]) }}">
        @csrf
        @method('PUT')
    @else
        <form method="post" action="{{ route('produto-detalhe.store') }}">
            @csrf
@endif

<input type="text" name="produto_id" value="{{ $produto_detalhe->produto_id ?? old('produto_id') }}"
    placeholder="ID do Produto" class="borda-preta">
@if ($errors->has('produto_id'))
    <span class="text-danger">{{ $errors->first('produto_id') }}</span>
@endif

<input type="text" name="comprimento" value="{{ $produto_detalhe->comprimento ?? old('comprimento') }}"
    placeholder="Comprimento" class="borda-preta">
@if ($errors->has('comprimento'))
    <span class="text-danger">{{ $errors->first('comprimento') }}</span>
@endif

<input type="text" name="largura" value="{{ $produto_detalhe->largura ?? old('largura') }}" placeholder="Largura"
    class="borda-preta">
@if ($errors->has('largura'))
    <span class="text-danger">{{ $errors->first('largura') }}</span>
@endif

<input type="text" name="altura" value="{{ $produto_detalhe->altura ?? old('altura') }}" placeholder="Altura"
    class="borda-preta">
@if ($errors->has('altura'))
    <span class="text-danger">{{ $errors->first('altura') }}</span>
@endif

<select name="unidade_id">
    <option value=""> <-- Selecione a unidade de medida --> </option>
    @foreach ($unidades as $unidade)
        <option value="{{ $unidade->id }}"
            {{ ($produto_detalhe->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>
            {{ $unidade->descricao }}
        </option>
    @endforeach
</select>
@if ($errors->has('unidade_id'))
    <span class="text-danger">{{ $errors->first('unidade_id') }}</span>
@endif

<button type="submit" class="borda-preta">
    @if (isset($produto_detalhe->id))
        Atualizar
    @else
        Cadastrar
    @endif
</button>
</form>
