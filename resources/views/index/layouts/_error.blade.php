@if (count($errors) > 0)
    layer.msg('{{ $errors->first() }}', {icon: 5});
@endif