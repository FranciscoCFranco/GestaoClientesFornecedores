@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Editar Produto</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">

            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{ route('produto.update', $produto->id) }}">
                    @csrf
                    @method('PUT')

                    <input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome"
                        class="borda-preta">
                    @if ($errors->has('nome'))
                        <span class="text-danger">{{ $errors->first('nome') }}</span>
                    @endif

                    <input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}"
                        placeholder="Descrição" class="borda-preta">
                    @if ($errors->has('descricao'))
                        <span class="text-danger">{{ $errors->first('descricao') }}</span>
                    @endif

                    <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="Peso"
                        class="borda-preta">
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

                    <button type="submit" class="borda-preta">Atualizar</button>
                </form>

            </div>

        </div>

    </div>

@endsection
