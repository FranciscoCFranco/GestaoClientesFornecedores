{{ $slot }}
<form action="{{ route('site.contato') }}" method="post">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
    @if ($errors->has('nome'))
        <div style="color: red;">{{ $errors->first('nome') }}</div>
    @endif
    <br>

    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone"
        class="{{ $classe }}">
    @if ($errors->has('telefone'))
        <div style="color: red;">{{ $errors->first('telefone') }}</div>
    @endif
    <br>

    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
    @if ($errors->has('email'))
        <div style="color: red;">{{ $errors->first('email') }}</div>
    @endif
    <br>

    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        @foreach ($motivo_contatos as $key => $motivo_contato)
            <option value="{{ $motivo_contato->id }}"
                {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : '' }}>
                {{ $motivo_contato->motivo_contato }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('motivo_contatos_id'))
        <div style="color: red;">{{ $errors->first('motivo_contatos_id') }}</div>
    @endif
    <br>

    <textarea name="mensagem" class="{{ $classe }}">{{ old('mensagem') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    @if ($errors->has('mensagem'))
        <div style="color: red;">{{ $errors->first('mensagem') }}</div>
    @endif
    <br>

    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>
